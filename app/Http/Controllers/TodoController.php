<?php

namespace App\Http\Controllers;

use App\Exports\TodosExport;
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
        if(session('level') == 3){
            $todo = Todo::where('pic', session('nik'))->orderBy('created_at','desc')->paginate(10);
        }else{
            $todo = Todo::orderBy('created_at', 'desc')->paginate(10);
        }

        $status = null;
        return view('todo.index', compact('todo','status'));
    }

    function create()
    {
        return view('todo.create', [
            'terminal' => Terminal::all(),
            'karyawan' => Karyawan::all(),
            'relatedpic' => RelatedPic::all(),
        ]);
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'terminal_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'id_relatedpic' => ['required'],
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        $data['status'] = 1;
        Todo::create($data);
        return redirect('/todo/index')->with('success', 'Berhasil menambah todo');
    }

    function filterStatus(Request $request){
        $status = $request->get('status');
        if($status == 1){
            $todo = Todo::where('status', 1)->orderBy('deadline', 'asc')->paginate(10);
        } elseif($status == 2){
            $todo = Todo::where('status', 2)->orderBy('deadline', 'asc')->paginate(10);
        } elseif($status == 3){
            $todo = Todo::where('status', 3)->orderBy('deadline', 'asc')->paginate(10);
        } else{
            $todo = Todo::orderBy('deadline', 'desc')->paginate(10);
        }
        return view('todo.index', compact('todo','status'));
    }

    function edit(Todo $todo)
    {
        if(session('level') == 1){
            return view('todo.edit', [
                'todo' => $todo,
                'terminal' => Terminal::all(),
                'karyawan' => Karyawan::all(),
                'relatedpic' => RelatedPic::all(),
            ]);
        }else{
            return view('todo.editPic', [
                'todo' => $todo,
                'terminal' => Terminal::all(),
                'karyawan' => Karyawan::all(),
                'relatedpic' => RelatedPic::all(),
            ]);

        }
    }

    function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'terminal_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'id_relatedpic' => ['required'],
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        if($data['complete_date'] != null){
            $data['status'] = 3;
        }elseif($todo->status == 2){
            $data['status'] = 2;
        }else{
            $data['status'] = 1;
        }

        $todo->update($data);
        return redirect('/todo/index')->with('success', 'Berhasil mengubah todo');
    }

    function updatePIC(Request $request, Todo $todo){
        $data = $request->validate([
            'terminal_code' => ['required'],
            'working_list' => ['required'],
            'pic' => ['required'],
            'id_relatedpic' => ['required'],
            'deadline' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        if ($todo->status == 3 && $data['update_pic'] != null) {
            // Jika status sudah 3 dan update_pic terisi, tetap 3
            $data['status'] = 3;
        } elseif ($todo->status == 1 && $data['update_pic'] != null) {
            // Jika status 1 dan update_pic terisi, ubah menjadi 2
            $data['status'] = 2;
        } else {
            // Jika update_pic kosong, tetap 1
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

    function export(Request $request){
        $status = $request->get('status');
        return Excel::download(new TodosExport($status), 'todo.xlsx');
    }
}
