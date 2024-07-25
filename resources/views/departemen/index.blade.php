@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Departemen</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Departemen</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="/departemen/create" class="btn btn-block btn-primary">Tambah Data</a>
                                </h3>

                                <div class="card-tools my-2">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <p><i class="icon fas fa-exclamation-triangle"></i> {{ $error }}!</p>
                                    </div>
                                @endforeach
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <p><i class="icon fas fa-exclamation-triangle"></i> {{ session('success') }}!</p>
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow-y: hidden;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Departemen Code</th>
                                            <th>NIK Atasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($departemen as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->dep_code }}</td>
                                                <td>{{ $item->nik_atasan }}</td>
                                                <td>
                                                    <a href="/departemen/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                            class="fas fa-pen"></i></a>
                                                    <a href="/departemen/destroy/{{ $item->id }}" class="btn btn-danger"
                                                        onclick="return confirm('Anda ingin menghapus departemen?')"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Belum ada data...</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $departemen->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
