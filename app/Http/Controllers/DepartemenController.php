<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DepartemenController extends Controller
{
    function index(){
        return view("departemen.index",[
            'departemen' => Departemen::paginate(5)
        ]);
    }

    function create(){
        return view("departemen.create");
    }

    function store(Request $request){
        try{
            $data = $request->validate([
                'dep_code' => ['required','unique:departemen'],
                'departemen' => ['required'],
                'nik_atasan' => ['required'],
            ]);

            Departemen::create($data);
            return redirect('/departemen/index')->with('success','Berhasil menambah departemen');
        }catch(ValidationException $e){
            // Periksa apakah error disebabkan oleh NIK yang sudah ada
            if ($e->validator->errors()->has('dep_code')) {
                return back()->withErrors(['dep_code' => 'Departemen Code sudah terdaftar!'])->withInput();
            }
        }
    }

    function edit(Departemen $departemen){
        return view('departemen.edit',[
            'departemen' => $departemen
        ]);
    }

    function update(Request $request, Departemen $departemen){
        try{
            $data = $request->validate([
                'dep_code' => ['required', Rule::unique('departemen')->ignore($departemen->id)],
                'departemen' => ['required'],
                'nik_atasan' => ['required'],
            ]);

            $departemen->update($data);
            return redirect('/departemen/index')->with('success','Berhasil mengubah departemen');
        }catch(ValidationException $e){
            // Periksa apakah error disebabkan oleh NIK yang sudah ada
            if ($e->validator->errors()->has('dep_code')) {
                return back()->withErrors(['dep_code' => 'Departemen Code sudah terdaftar!'])->withInput();
            }
        }
    }

    function destroy(Departemen $departemen){
        $cek = Karyawan::where('dep_code', $departemen->dep_code)->first();
        if ($cek) {
            return back()->withErrors(['dep_code' => 'Departemen code digunakan oleh karyawan'])->withInput();
        } else {
            // Hapus departemen jika tidak ada karyawan yang menggunakannya
            $departemen->delete();
            return back()->with('success', 'Berhasil menghapus departemen');
        }
    }
}
