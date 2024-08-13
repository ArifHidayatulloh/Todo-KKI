<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Departemen;
use App\Models\DepartmenUser;
use App\Models\Terminal;
use App\Models\RelatedPic;
use App\Models\Todo;
use Carbon\Carbon;

class IndexController extends Controller
{
    function login()
    {
        return view("login");
    }

    function loginAction(Request $request)
    {
        $request->validate([
            'nik' => ['required'],
            'password' => ['required', 'string'],
        ]);

        $karyawan = Karyawan::where('nik', $request->nik)->first();

        if ($karyawan && Hash::check($request->password, $karyawan->password)) {
            $dibuat = Carbon::parse($karyawan->created_at)->format('d m Y');
            session([
                'id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'nik' => $karyawan->nik,
                'deep_code' => $karyawan->dep_code,
                'level' => $karyawan->level,
                'dibuat' => $dibuat
            ]);
            return redirect('/dashboard');
        } else {
            return back()->withErrors(['gagal' => 'Email atau Password tidak valid'])->withInput();
        }
    }

    function dashboard()
    {
        $departemens = Departemen::count();
        $karyawans = Karyawan::count();
        // $terminals = Terminal::count();
        // $relatedPIC = RelatedPIC::count();

        $oneWeekLater = Carbon::now()->addWeek();
        $nik = session('nik');
        $level = session('level');
        if ($level == 3 || $level == 4) {
            $departemenIds = DepartmenUser::where('nik', $nik)->pluck('dep_code');
            $deadlineAsc = Todo::where('status', 2)
                ->whereIn('dep_code', $departemenIds)
                ->where('deadline', '<', $oneWeekLater)
                ->orderBy('deadline', 'asc')
                ->get();

            $outstanding = Todo::where('status', 1)->whereIn('dep_code', $departemenIds)->count();
            $onProgres = Todo::where('status', 2)->whereIn('dep_code', $departemenIds)->count();
            $done = Todo::where('status', 3)->whereIn('dep_code', $departemenIds)->count();
            $todosProgres = $onProgres;
            $todosDone = $done;
            $todosOutstanding = $outstanding;
        } elseif ($level == 5) {
            // Data deadline terdekat
            $deadlineAsc = Todo::where('status', 2)
            ->where('pic', session('nik'))
            ->where('deadline', '<', $oneWeekLater)
            ->orderBy('deadline', 'asc')
            ->get();
            $outstanding = Todo::where('status', 1)->where('pic', session('nik'))->count();
            $onprogres = Todo::where('status', 2)->where('pic', session('nik'))->count();
            $done = Todo::where('status', 3)->where('pic', session('nik'))->count();
            $todosProgres = $onprogres;
            $todosDone = $done;
            $todosOutstanding = $outstanding;
        } else {
            $deadlineAsc = Todo::where('status',  2)
                ->where('deadline', '<', $oneWeekLater)
                ->orderBy('deadline', 'asc')
                ->get();

            $outstanding = Todo::where('status', 1)->count();
            $onprogres = Todo::where('status', 2)->count();
            $done = Todo::where('status', 3)->count();
            $todosProgres = $onprogres;
            $todosDone = $done;
            $todosOutstanding = $outstanding;
        }

        foreach ($deadlineAsc as $todo) {
            // Memecah string comment_dephead menjadi array berdasarkan baris baru
            $comments = array_map('trim', explode("\n", $todo->comment_dephead));

            // Memecah string update_pic menjadi array berdasarkan baris baru
            $updates = array_map('trim', explode("\n", $todo->update_pic));

            // Mengelompokkan update berdasarkan nomor tugas
            $progress = [];
            foreach ($updates as $update) {
                // Periksa apakah elemen mengandung titik dan deskripsi
                if (strpos($update, '.') !== false) {
                    // Menghapus spasi ekstra di sekitar nomor dan deskripsi
                    $update = trim($update);
                    list($num, $desc) = explode('.', $update, 2);
                    $num = trim($num);
                    $desc = trim($desc);
                    if (!isset($progress[$num])) {
                        $progress[$num] = [];
                    }
                    $progress[$num][] = $desc;
                }
            }

            // Menyimpan hasil pemecahan ke dalam objek todo
            $todo->comments = $comments;
            $todo->progress = $progress;
        }

        return view('dashboard', [
            'departemens' => $departemens,
            'karyawans' => $karyawans,
            // 'terminals' => $terminals,
            // 'relatedPIC' => $relatedPIC,
           'todoProgres' => $todosProgres,
           'todoDone' => $todosDone,
           'todoOutstanding' => $todosOutstanding,
            'deadlineAsc' => $deadlineAsc,
        ]);
    }

    function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
