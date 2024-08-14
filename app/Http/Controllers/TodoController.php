<?php

namespace App\Http\Controllers;

use App\Exports\TodosExport;
use App\Models\Departemen;
use App\Models\DepartmenUser;
use App\Models\Karyawan;
use App\Models\Notification;
use App\Models\Todo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', '');
        $pic = $request->get('pic', '');
        $dep_code = $request->get('dep_code', '');

        // Inisialisasi query berdasarkan level pengguna
        if (session('level') == 3 || session('level') == 4) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            $query = Todo::whereIn('dep_code', $departemenIds);
            $departemenList = Departemen::whereIn('dep_code', $departemenIds)->get();
        } elseif (session('level') == 5) {
            $query = Todo::where('pic', session('nik'));
        } else {
            $query = Todo::query();
            $departemenList = Departemen::all();
        }

        // Filter berdasarkan status jika diberikan
        if ($status != '') {
            $query->where('status', $status);
        }

        // Filter berdasarkan PIC jika diberikan
        if ($pic != '') {
            $query->where('pic', $pic);
        }

        // Filter berdasarkan departemen jika diberikan
        if ($dep_code != '') {
            $query->where('dep_code', $dep_code);
        }

        // Ambil data todo dengan relasi karyawan dan departemen
        $todos = $query->with(['karyawan', 'departemen'])->orderBy('created_at', 'desc')->paginate(10);

        // Olah data todo untuk mendapatkan komentar dan progres
        foreach ($todos as $todo) {
            // Pisahkan komentar pada field `comment_dephead`
            $comments = array_map('trim', explode("\n", $todo->comment_dephead));

            // Pisahkan update pada field `update_pic`
            $updates = array_map('trim', explode("\n", $todo->update_pic));

            $progress = [];
            foreach ($updates as $update) {
                if (strpos($update, '.') !== false) {
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

            // Tambahkan komentar dan progres ke masing-masing todo
            $todo->comments = $comments;
            $todo->progress = $progress;
        }

        // Ambil data karyawan dan departemen untuk dropdown
        $karyawan = Karyawan::all();
         // Ambil semua departemen

        // Kembalikan view dengan data yang diperlukan
        return view('todo.index', compact('todos', 'status', 'pic', 'dep_code', 'karyawan', 'departemenList'));
    }

    function request(Request $request){
        $status = $request->get('status', '');
        $pic = $request->get('pic', '');
        $dep_code = $request->get('dep_code', '');
        $departemenList = Departemen::all();
        $karyawan = Karyawan::all();
        $query = Todo::where('req_status','request');

        // Filter berdasarkan status jika diberikan
        if ($status != '') {
            $query->where('status', $status);
        }

        // Filter berdasarkan PIC jika diberikan
        if ($pic != '') {
            $query->where('pic', $pic);
        }

        // Filter berdasarkan departemen jika diberikan
        if ($dep_code != '') {
            $query->where('dep_code', $dep_code);
        }

        $todos = $query->with(['karyawan', 'departemen'])->orderBy('updated_at', 'desc')->paginate(10);

        // Olah data todo untuk mendapatkan komentar dan progres
        foreach ($todos as $todo) {
            // Pisahkan komentar pada field `comment_dephead`
            $comments = array_map('trim', explode("\n", $todo->comment_dephead));

            // Pisahkan update pada field `update_pic`
            $updates = array_map('trim', explode("\n", $todo->update_pic));

            $progress = [];
            foreach ($updates as $update) {
                if (strpos($update, '.') !== false) {
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

            // Tambahkan komentar dan progres ke masing-masing todo
            $todo->comments = $comments;
            $todo->progress = $progress;
        }

        return view('todo.request', compact('todos','status', 'pic', 'dep_code', 'karyawan', 'departemenList'));
    }

    function create()
    {
        return view('todo.create', [
            'departemen' => Departemen::all(),
            'karyawan' => Karyawan::all(),
        ]);
    }

    function store(Request $request)
    {
        // Validasi data
        $data = $request->validate([
            'dep_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'relatedpic' => ['array'], // Array
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        // Menetapkan status
        $data['status'] = 2;

        // Jika tidak ada relatedpic, set ke array kosong
        $data['relatedpic'] = $data['relatedpic'] ?? [];

        // Simpan data ke database
        $todo = Todo::create($data);

        Notification::create([
            'user_id' => $request->pic,
            'todo_id' => $todo->id,
            'message' => $request->working_list
        ]);

        // Redirect dengan pesan sukses
        return redirect('/todo/index')->with('success', 'Berhasil menambah todo');
    }

    function filterStatus(Request $request)
    {

        $pic = $request->get('pic');
        $status = $request->get('status');
        $nik = session('nik');
        $level = session('level');

        // Menentukan query dasar berdasarkan level pengguna
        $query = Todo::query();

        if ($level == 3 || $level == 4) {
            // Manager dan Kepala Departemen: Filter berdasarkan kode departemen
            $departemenIds = DepartmenUser::where('nik', $nik)->pluck('dep_code');
            $query->whereIn('dep_code', $departemenIds);
        } elseif ($level == 5) {
            // Employee: Filter berdasarkan PIC
            $query->where('pic', $nik);
        }

        // Filter status
        if ($status == 1) {
            $query->where('status', 1);
        } elseif ($status == 2) {
            $query->where('status', 2);
        } elseif ($status == 3) {
            $query->where('status', 3);
        }

        // Mengurutkan dan mengambil data tugas dengan pagination
        $todos = $query->orderBy('deadline', 'asc')->paginate(10);

        // Memproses setiap todo untuk menambahkan komentar dan progres
        foreach ($todos as $todo) {
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
        $karyawan = Karyawan::all();
        return view('todo.index', compact('todos', 'status', 'karyawan', 'pic'));
    }

    function edit(Todo $todo)
    {
        // Pastikan relatedpic adalah array
        if (is_string($todo->relatedpic)) {
            $todo->relatedpic = json_decode($todo->relatedpic, true) ?? [];
        } else {
            $todo->relatedpic = $todo->relatedpic ?? [];
        }

        if (session('level') == 1 || session('level') == 2) {
            return view('todo.edit', [
                'todo' => $todo,
                'departemen' => Departemen::all(),
                'karyawan' => Karyawan::all(),
            ]);
        } else {
            return view('todo.editPic', [
                'todo' => $todo,
                'departemen' => Departemen::all(),
                'karyawan' => Karyawan::all(),
            ]);
        }
    }

    function update(Request $request, Todo $todo)
    {
        // Validasi input
        $data = $request->validate([
            'dep_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'relatedpic' => 'array|nullable',
            'deadline' => ['required'],
            'complete_date' => ['nullable', 'date'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        // Tentukan status
        if ($data['complete_date'] != null) {
            if ($data['complete_date'] > $data['deadline']) {
                $data['status'] = 1; // Status jika complete_date setelah deadline
            } else {
                $data['status'] = 3; // Status jika complete_date sebelum atau sama dengan deadline
            }
        } else {
            // Tentukan status default jika complete_date null
            $data['status'] = $todo->status == 2 ? 2 : 2; // Jika status sebelumnya adalah 2, tetap 2
        }

        // Update data todo
        $todo->update($data);
        return redirect('/todo/index')->with('success', 'Berhasil mengubah todo');
    }

    function updatePIC(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'update_pic' => ['nullable'],
        ]);

        if ($todo->status == 3 && $data['update_pic'] != null) {
            // Jika status sudah 3 dan update_pic terisi, tetap 3
            $data['status'] = 3;
        } elseif ($todo->status == 2 && $data['update_pic'] != null) {
            // Jika update_pic terisi, tetap 2
            $data['status'] = 2;
        } elseif ($data['update_pic'] == null) {
            // Jika update_pic kosong, tetap 1
            $data['status'] = 2;
        } else {
            $data['status'] = 2;
        }

        $todo->update($data);
        return redirect('/todo/index')->with('success', 'Berhasil mengubah todo');
    }

    function destroy(Todo $todo)
    {
        Notification::where('todo_id', $todo->id)->delete();
        $todo->delete();
        return back()->with('success', 'Berhasil menghapus todo');
    }

    function export(Request $request)
    {
        $status = $request->get('status');
        $dep_code = $request->get('dep_code');
        $pic = $request->get('pic');
        return Excel::download(new TodosExport($status,$dep_code,$pic), 'todo.xlsx');
    }

    function requestActionPic(Todo $todo){
        if($todo->req_status == null || $todo->req_status == 'rejected'){
            $todo->req_status = 'request';
            $todo->update();
            return back()->with('success', 'Berhasil mengirim request');
        }
        if($todo->req_status == 'request'){
            return back()->withErrors(['req_status' => 'Request sudah dikirim ke todo ini']);
        }
        if($todo->req_status == 'approved'){
            return back()->withErrors(['req_status' => 'Status todo sudah selesai']);
        }
    }

    function approve(Todo $todo){
        $todo->req_status = 'approved';
        $todo->complete_date = Carbon::now();
        if($todo->complete_date > $todo->deadline){
            $todo->status = 1;
        }else{
            $todo->status = 3;
        }

        $todo->update();
        return back()->with('success','Berhasil men-Approve todo');
    }

    function reject(Request $request, Todo $todo){
        $reject = $request->validate([
            'comment_update' => ['nullable'],
        ]);

        $reject['req_status'] = 'rejected';

        $todo->update($reject);
        return redirect('/todo/request')->with('success','Berhasil reject request');
    }

}
