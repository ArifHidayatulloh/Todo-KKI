<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\RelatedPic;
use App\Models\Terminal;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function index()
    {

        if(session('level') == 3){
            $todo = Todo::where('pic', session('nik'))->paginate(5);
        }else{
            $todo = Todo::paginate(5);
        }
        return view('todo.index', compact('todo'));
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
            'status' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        Todo::create($data);
        return redirect('/todo/index')->with('success', 'Berhasil menambah todo');
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
            'status' => ['required'],
            'complete_date' => ['nullable'],
            'comment_dephead' => ['required'],
            'update_pic' => ['nullable'],
        ]);

        $todo->update($data);
        return redirect('/todo/index')->with('success', 'Berhasil mengubah todo');
    }

    function destroy(Todo $todo)
    {
        $todo->delete();
        return back()->with('success', 'Berhasil menghapus todo');
    }
}
