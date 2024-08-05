<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmenUser;
use App\Models\Departemen;
use App\Models\Karyawan;
use Illuminate\Validation\ValidationException;

class DepartemenUserController extends Controller
{
    function index(){
        return view('departemen-user.index',[
            'departemenUser' => DepartmenUser::paginate(10),
        ]);
    }

    function create(){
        return view('departemen-user.create',[
            'departemen' => Departemen::all(),
            'karyawan' => Karyawan::all(),
        ]);
    }

    function store(Request $request){
        try{
            $data = $request->validate([
                'nik' => ['required'],
                'dep_code' => ['required'],
            ]);

            DepartmenUser::create($data);
            return redirect('/departemen_user/index')->with('success', 'Berhasil menambahkan departemen user');
        }catch(ValidationException $e){
            return back()->withErrors($request->validator->errors())->withInput();
        }
    }

    function edit(DepartmenUser $departemenUser){
        return view('departemen-user.edit',[
            'departemenUser' => $departemenUser,
            'departemen' => Departemen::all(),
            'karyawan' => Karyawan::all(),
        ]);
    }
    function update(Request $request, DepartmenUser $departemenUser){
        try{
            $data = $request->validate([
                'nik' => ['required'],
                'dep_code' => ['required'],
            ]);

            $departemenUser->update($data);
            return redirect('/departemen_user/index')->with('success', 'Berhasil merubah data departemen user');
        }catch(ValidationException $e){
            return back()->withErrors($request->validator->errors())->withInput();
        }
    }

    function destroy(DepartmenUser $departemenUser){
        $departemenUser->delete();
        return redirect('/departemen_user/index')->with('success', 'Berhasil menghapus data departemen user');
    }
}
