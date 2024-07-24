<?php

namespace App\Http\Controllers;

use App\Models\RelatedPic;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RelatedPicController extends Controller
{
    function index(){
        return view('relatedpic.index',[
            'relatedpic' => RelatedPic::paginate(5)
        ]);
    }

    function create(){
        return view('relatedpic.create');
    }

    function store(Request $request){
        try{
            $data = $request->validate([
                'nik' => ['required','unique:relatedpic'],
                'nama' => ['required'],
            ]);

            RelatedPic::create($data);
            return redirect('/relatedpic/index')->with('success','Berhasil menambah Related PIC');
        }catch(ValidationException $e){
            if($e->validator->errors()->has('nik')){
                return back()->withErrors(['nik' => 'NIK sudah terdaftar'])->withInput();
            }
        }
    }

    function edit(RelatedPic $relatedpic){
        return view('relatedpic.edit',[
            'relatedpic' => $relatedpic
        ]);
    }

    function update(Request $request, RelatedPic $relatedpic){
        try{
            $data = $request->validate([
                'nik' => ['required',Rule::unique('relatedpic')->ignore($relatedpic->id_relatedpic,'id_relatedpic')],
                'nama' => ['required'],
            ]);

            $relatedpic->update($data);
            return redirect('/relatedpic/index')->with('success','Berhasil mengubah Related PIC');
        }catch(ValidationException $e){
            if($e->validator->errors()->has('nik')){
                return back()->withErrors(['nik' => 'NIK sudah terdaftar'])->withInput();
            }
        }
    }

    function destroy(RelatedPic $relatedpic){
        $cek = Todo::where('id_relatedpic', $relatedpic->id_relatedpic)->first();
        if ($cek) {
            return back()->withErrors(['id_relatedpic' => 'ID Related PIC digunakan pada todo'])->withInput();
        } else {
            $relatedpic->delete();
            return back()->with('success','Berhasil menghapus relaed PIC');
        }
    }
}
