<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\DepartmenUser;
use App\Models\Karyawan;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    function index(Request $request)
    {
        $search = $request->get("search");

        $karyawan = Karyawan::query()->when($search, function ($query,$search) {
            return $query->where('nik', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);
        return view("karyawan.index", compact('karyawan') );
    }

    function create()
    {
        return view("karyawan.create", [
            'departemen' => Departemen::all()
        ]);
    }

    function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nik' => ['required', 'unique:karyawan'],
                'nama' => ['required'],
                'email' => ['required'],
                'password' => ['required'],
                'level' => ['required'],
            ]);

            // Hash password before saving
            $data['password'] = bcrypt($data['password']);

            Karyawan::create($data);
            return redirect('/karyawan/index')->with('success', 'Berhasil menambah karyawan');
        } catch (ValidationException $e) {
            // Periksa apakah error disebabkan oleh NIK yang sudah ada
            if ($e->validator->errors()->has('nik')) {
                return back()->withErrors(['nik' => 'NIK sudah terdaftar'])->withInput();
            }

            // Kembalikan error validasi lainnya
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', [
            'karyawan' => $karyawan,
            'departemen' => Departemen::all()
        ]);
    }

    function update(Request $request, Karyawan $karyawan)
    {
        try {

            $data = $request->validate([
                'nik' => ['required', Rule::unique('karyawan')->ignore($karyawan->id)],
                'nama' => ['required'],
                'email' => ['required'],
                'password' => ['nullable'],
                'level' => ['required'],
            ]);

            // Hash password before saving
            $data['password'] = bcrypt($data['password']);

            $karyawan->update($data);
            return redirect('/karyawan/index')->with('success', 'Berhasil menambah karyawan');
        } catch (ValidationException $e) {
            // Periksa apakah error disebabkan oleh NIK yang sudah ada
            if ($e->validator->errors()->has('nik')) {
                return back()->withErrors(['nik' => 'NIK sudah terdaftar'])->withInput();
            }

            // Kembalikan error validasi lainnya
            return back()->withErrors($e->validator->errors())->withInput();
        }
    }

    function destroy(Karyawan $karyawan)
    {

        $cek = DepartmenUser::where('nik', $karyawan->nik)->first();
        if ($cek) {
            $cek_todo = Todo::where('pic', $karyawan->nik)->where('relatedpic', $karyawan->nik)->first();
            if ($cek_todo) {
                return back()->withErrors(['nik' => 'NIK karyawan digunakan pada todo'])->withInput();
            }
            return back()->withErrors(['nik' => 'NIK karyawan digunakan pada departemen user'])->withInput();
        }
        $karyawan->delete();
        return back()->with('success', 'Berhasil menghapus karyawan');
    }
}
