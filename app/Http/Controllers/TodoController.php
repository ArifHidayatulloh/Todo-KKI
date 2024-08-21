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
        $sortField = $request->input('sort_field', 'deadline'); // Default ke 'deadline'
        $sortOrder = $request->input('sort_order', 'asc'); // Default ke ascending

        // Inisialisasi query berdasarkan level pengguna
        if (session('level') == 1) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            if ($departemenIds->isNotEmpty()) {
                $karyawanIds = DepartmenUser::whereIn('dep_code', $departemenIds)->pluck('nik');
                $karyawan = Karyawan::whereIn('nik', $karyawanIds)->get();
                $query = Todo::whereIn('dep_code', $departemenIds);
                $departemenList = Departemen::whereIn('dep_code', $departemenIds)->get();
            } else {
                $query = Todo::query();
                $departemenList = Departemen::all();
                // Ambil data karyawan dan departemen untuk dropdown
                $karyawan = Karyawan::all();
            }
        } elseif (session('level') == 3 || session('level') == 4) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            $query = Todo::whereIn('dep_code', $departemenIds);
            $departemenList = Departemen::whereIn('dep_code', $departemenIds)->get();
            $karyawan = Karyawan::all();
        } elseif (session('level') == 5) {
            $query = Todo::where('pic', session('nik'));
            $karyawan = Karyawan::all();
            $departemenList = Departemen::all();
        } else {
            $query = Todo::query();
            $departemenList = Departemen::all();
            // Ambil data karyawan dan departemen untuk dropdown
            $karyawan = Karyawan::all();
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

        // Tentukan pengurutan berdasarkan field yang dipilih
        if ($sortField === 'created_at') {
            $query->orderBy('created_at', $sortOrder);
        } else {
            $query->orderBy('deadline', $sortOrder);
        }

        // Ambil data todo dengan relasi karyawan dan departemen
        $todos = $query->with(['karyawan', 'departemen'])->paginate(10);

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


        // Ambil semua departemen

        // Kembalikan view dengan data yang diperlukan
        return view('todo.index', compact('todos', 'status', 'pic', 'dep_code', 'karyawan', 'departemenList', 'sortField', 'sortOrder'));
    }

    function request(Request $request)
    {
        $status = $request->get('status', '');
        $pic = $request->get('pic', '');
        $dep_code = $request->get('dep_code', '');
        $departemenList = Departemen::all();
        $karyawan = Karyawan::all();

        // Inisialisasi query untuk hanya mengambil Todo dengan req_status 'request'
        $query = Todo::query()->where('req_status', '=', 'request');

        if (session('level') == 1) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            if ($departemenIds->isNotEmpty()) {
                $query->whereIn('dep_code', $departemenIds);
                $departemenList = Departemen::whereIn('dep_code', $departemenIds)->get();
            }
        }

        // Filter berdasarkan PIC jika diberikan
        if (!empty($pic)) {
            $query->where('pic', '=', $pic);
        }

        // Filter berdasarkan departemen jika diberikan
        if (!empty($dep_code)) {
            $query->where('dep_code', '=', $dep_code);
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

        return view('todo.request', compact('todos', 'status', 'pic', 'dep_code', 'karyawan', 'departemenList'));
    }

    function create()
    {
        if (session('level') == 1) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            if ($departemenIds->isNotEmpty()) {
                return view('todo.create', [
                    'departemen' => Departemen::whereIn('dep_code', $departemenIds)->get(),
                    'karyawan' => Karyawan::all(),
                ]);
            } else {
                return view('todo.create', [
                    'departemen' => Departemen::all(),
                    'karyawan' => Karyawan::all(),
                ]);
            }
        } else {
            return view('todo.create', [
                'departemen' => Departemen::all(),
                'karyawan' => Karyawan::all(),
            ]);
        }
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


    function edit(Todo $todo)
    {
        // Pastikan relatedpic adalah array
        if (is_string($todo->relatedpic)) {
            $todo->relatedpic = json_decode($todo->relatedpic, true) ?? [];
        } else {
            $todo->relatedpic = $todo->relatedpic ?? [];
        }

        if (session('level') == 1) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            if ($departemenIds != null) {
                return view('todo.create', [
                    'todo' => $todo,
                    'departemen' => Departemen::whereIn('dep_code', $departemenIds)->get(),
                    'karyawan' => Karyawan::all(),
                ]);
            } else {
                return view('todo.create', [
                    'todo' => $todo,
                    'departemen' => Departemen::all(),
                    'karyawan' => Karyawan::all(),
                ]);
            }
        } elseif (session('level') == 2) {
            return view('todo.editPic', [
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

        // Cek apakah user level 1 dan memiliki daftar departemen
        if (session('level') == 1) {
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');

            // Jika user memiliki daftar departemen dan dep_code tidak ditentukan di request
            if ($departemenIds->isNotEmpty() && empty($dep_code)) {
                $dep_code = $departemenIds->toArray();
            }
        }

        return Excel::download(new TodosExport($status, $dep_code, $pic), 'todo.xlsx');
    }

    function requestActionPic(Todo $todo)
    {
        if ($todo->req_status == null || $todo->req_status == 'rejected') {
            $todo->req_status = 'request';
            $todo->update();
            return back()->with('success', 'Berhasil mengirim request');
        }
        if ($todo->req_status == 'request') {
            return back()->withErrors(['req_status' => 'Request sudah dikirim ke todo ini']);
        }
        if ($todo->req_status == 'approved') {
            return back()->withErrors(['req_status' => 'Status todo sudah selesai']);
        }
    }

    function approve(Todo $todo)
    {
        $todo->req_status = 'approved';
        $todo->complete_date = Carbon::now();
        if ($todo->complete_date > $todo->deadline) {
            $todo->status = 1;
        } else {
            $todo->status = 3;
        }

        $todo->update();
        return back()->with('success', 'Berhasil men-Approve todo');
    }

    function reject(Request $request, Todo $todo)
    {
        $reject = $request->validate([
            'comment_update' => ['nullable'],
        ]);

        $reject['req_status'] = 'rejected';

        $todo->update($reject);
        return redirect('/todo/request')->with('success', 'Berhasil reject request');
    }
}
