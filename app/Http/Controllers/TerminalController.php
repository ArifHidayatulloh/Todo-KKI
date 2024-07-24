<?php

namespace App\Http\Controllers;

use App\Models\RelatedPic;
use App\Models\Terminal;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TerminalController extends Controller
{
    function index(){
        return view("terminal.index",[
            'terminal' => Terminal::paginate(5)
        ]);
    }

    function create(){
        return view('terminal.create');
    }

    function store(Request $request){
        try{
            $data = $request->validate([
                'terminal_code' => ['required', 'unique:terminal'],
                'nm_terminal' => ['required'],
            ]);

            Terminal::create($data);
            return redirect('/terminal/index')->with('success','Berhasil menambah terminal');
        }catch(ValidationException $e){
            if($e->validator->errors()->has('terminal_code' )){
                return back()->withErrors(['terminal_code' => 'Terminal code sudah terdaftar'])->withInput();
            }
        }
    }

    function edit(Terminal $terminal){
        return view('terminal.edit',[
            'terminal' => $terminal
        ]);
    }

    function update(Request $request, Terminal $terminal){
        try{
            $data = $request->validate([
                'terminal_code' => ['required',Rule::unique('terminal')->ignore($terminal->id)],
                'nm_terminal' => ['required'],
            ]);

            $terminal->update($data);
            return redirect('/terminal/index')->with('success','Berhasil menambah terminal');
        }catch(ValidationException $e){
            if($e->validator->errors()->has('terminal_code' )){
                return back()->withErrors(['terminal_code' => 'Terminal code sudah terdaftar'])->withInput();
            }
        }
    }

    function destroy(Terminal $terminal){
        $cek = Todo::where('terminal_code', $terminal->terminal_code)->first();
        if ($cek) {
            return back()->withErrors(['terminal_code' => 'Terminal code digunakan pada todo'])->withInput();
        } else {
            $terminal->delete();
            return back()->with('success', 'Berhasil menghapus terminal');
        }

    }
}
