<?php

namespace App\Http\Controllers;

use App\Exports\TodosExport;
use App\Models\Departemen;
use App\Models\DepartmenUser;
use App\Models\Karyawan;
use App\Models\RelatedPic;
use App\Models\Terminal;
use App\Models\Todo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TodoController extends Controller
{
    function index()
    {
        if(session('level') == 2 || session('level') == 3){
            $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
            $todos = Todo::whereIn('dep_code', $departemenIds)->orderBy('created_at', 'desc')->paginate(10);
        }
        elseif (session('level') == 4) {
            $todos = Todo::where('pic', session('nik'))->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $todos = Todo::orderBy('created_at', 'desc')->paginate(10);
        }

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

        $status = null;
        return view('todo.index', compact('todos', 'status'));
    }

    function create()
    {
        return view('todo.create', [
            'departemen' => Departemen::all(),
            'karyawan' => Karyawan::all(),
            'relatedpic' => RelatedPic::all(),
        ]);
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'dep_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'relatedpic1' => ['required'],
            'relatedpic2' => ['nullable'],
            'relatedpic3' => ['nullable'],
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);


        $data['status'] = 1;
        // dd($data);
        Todo::create($data);
        return redirect('/todo/index')->with('success', 'Berhasil menambah todo');
    }

    function filterStatus(Request $request)
    {
        $status = $request->get('status');
        if ($status == 1) {
            $todos = Todo::where('status', 1)->orderBy('deadline', 'asc')->paginate(10);
        } elseif ($status == 2) {
            $todos = Todo::where('status', 2)->orderBy('deadline', 'asc')->paginate(10);
        } elseif ($status == 3) {
            $todos = Todo::where('status', 3)->orderBy('deadline', 'asc')->paginate(10);
        } else {
            $todos = Todo::orderBy('deadline', 'desc')->paginate(10);
        }

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
        return view('todo.index', compact('todos', 'status'));
    }

    function edit(Todo $todo)
    {
        if (session('level') == 1) {
            return view('todo.edit', [
                'todo' => $todo,
                'departemen' => Departemen::all(),
                'karyawan' => Karyawan::all(),
                'relatedpic' => RelatedPic::all(),
            ]);
        } else {
            return view('todo.editPic', [
                'todo' => $todo,
                'departemen' => Departemen::all(),
                'karyawan' => Karyawan::all(),
                'relatedpic' => RelatedPic::all(),
            ]);
        }
    }

    function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'dep_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'relatedpic1' => ['required'],
            'relatedpic2' => ['nullable'],
            'relatedpic3' => ['nullable'],
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        if ($data['complete_date'] != null) {
            $data['status'] = 3;
        } elseif ($todo->status == 2) {
            $data['status'] = 2;
        } else {
            $data['status'] = 1;
        }

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
        } elseif ($todo->status == 1 && $data['update_pic'] != null) {
            // Jika status 1 dan update_pic terisi, ubah menjadi 2
            $data['status'] = 2;
        } elseif ($todo->status == 2 && $data['update_pic'] != null) {
            // Jika update_pic terisi, tetap 2
            $data['status'] = 2;
        }elseif($data['update_pic'] == null){
            // Jika update_pic kosong, tetap 1
            $data['status'] = 1;
        }else{
            $data['status'] = 1;
        }

        $todo->update($data);
        return redirect('/todo/index')->with('success', 'Berhasil mengubah todo');
    }

    function destroy(Todo $todo)
    {
        $todo->delete();
        return back()->with('success', 'Berhasil menghapus todo');
    }

    function export(Request $request)
    {
        $status = $request->get('status');
        return Excel::download(new TodosExport($status), 'todo.xlsx');
    }
}
