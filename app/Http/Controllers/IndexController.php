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
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $karyawan = Karyawan::where('email', $request->email)->first();

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
        if($level == 2 || $level == 3){
            $departemenIds = DepartmenUser::where('nik', $nik)->pluck('dep_code');
            $deadlineAsc = Todo::whereIn('status',[1,2])
                ->whereIn('dep_code',$departemenIds)
                ->where('deadline', '<', $oneWeekLater)
                ->orderBy('deadline','asc')
                ->get();

            $outstanding = Todo::where('status',1)->whereIn('dep_code',$departemenIds)->count();
            $onProgres = Todo::where('status',2)->whereIn('dep_code',$departemenIds)->count();
            $todos = $outstanding-$onProgres;
        }
        elseif ($level == 4) {
            // Data deadline terdekat
            $deadlineAsc = Todo::whereIn('status', [1, 2])
                ->where('pic', session('nik'))
                ->where('deadline', '<', $oneWeekLater)
                ->orderBy('deadline', 'asc')
                ->get();
            $outstanding = Todo::where('status', 1)->where('pic', session('nik'))->count();
            $onprogres = Todo::where('status', 2)->where('pic', session('nik'))->count();
            $todos = $outstanding + $onprogres;
        } else {
            $deadlineAsc = Todo::whereIn('status', [1, 2])
                ->where('deadline', '<', $oneWeekLater)
                ->orderBy('deadline', 'asc')
                ->get();

            $outstanding = Todo::where('status', 1)->count();
            $onprogres = Todo::where('status', 2)->count();
            $todos = $outstanding + $onprogres;
        }

        return view('dashboard', [
            'departemens' => $departemens,
            'karyawans' => $karyawans,
            // 'terminals' => $terminals,
            // 'relatedPIC' => $relatedPIC,
            'todos' => $todos,
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
