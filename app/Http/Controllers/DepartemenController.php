<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\DepartmenUser;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DepartemenController extends Controller
{
    function index(Request $request)
    {
        $search = $request->input('search');

        $departemen = Departemen::query()->when($search, function ($query, $search) {
            return $query->where('dep_code', 'LIKE', "%{$search}%")->orWhere('departemen', 'LIKE', "%{$search}%");
        })->paginate(10);
        return view("departemen.index", compact("departemen"));
    }

    function create()
    {
        return view("departemen.create");
    }

    function store(Request $request)
    {
        try {
            $data = $request->validate([
                'dep_code' => ['required', 'unique:departemen'],
                'departemen' => ['required'],
            ]);

            Departemen::create($data);
            return redirect('/departemen/index')->with('success', 'Berhasil menambah departemen');
        } catch (ValidationException $e) {
            // Periksa apakah error disebabkan oleh dep_code yang sudah ada
            if ($e->validator->errors()->has('dep_code')) {
                return back()->withErrors(['dep_code' => 'Departemen Code sudah terdaftar!'])->withInput();
            }
        }
    }

    function edit(Departemen $departemen)
    {
        return view('departemen.edit', [
            'departemen' => $departemen
        ]);
    }

    function update(Request $request, Departemen $departemen)
    {
        try {
            $data = $request->validate([
                'dep_code' => ['required', Rule::unique('departemen')->ignore($departemen->id)],
                'departemen' => ['required'],
            ]);

            $departemen->update($data);
            return redirect('/departemen/index')->with('success', 'Berhasil mengubah departemen');
        } catch (ValidationException $e) {
            // Periksa apakah error disebabkan oleh NIK yang sudah ada
            if ($e->validator->errors()->has('dep_code')) {
                return back()->withErrors(['dep_code' => 'Departemen Code sudah terdaftar!'])->withInput();
            }
        }
    }

    function destroy(Departemen $departemen)
    {
        $cekTodo = Todo::where('dep_code', $departemen->dep_code)->first();
        if ($cekTodo) {
            return back()->withErrors(['dep_code' => 'Departemen code digunakan pada todo'])->withInput();
        }

        // Cek apakah dep_code digunakan di tabel departemen user
        $cek_departmenUser = DepartmenUser::where('dep_code', $departemen->dep_code)->first();
        if ($cek_departmenUser) {
            return back()->withErrors(['dep_code' => 'Departemen code digunakan pada departmen user'])->withInput();
        }

        // Hapus departemen jika tidak ada karyawan yang menggunakannya
        $departemen->delete();
        return back()->with('success', 'Berhasil menghapus departemen');
    }
}
