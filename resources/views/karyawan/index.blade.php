@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Karyawan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Karyawan</li>
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
                                    <a href="/karyawan/create" class="btn btn-block btn-primary">Tambah Data</a>
                                </h3>

                                <div class="card-tools my-2">
                                    <form action="/karyawan/index" method="get">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="search" name="search" class="form-control float-right"
                                                placeholder="Search" name="search" id="search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if ($errors->any())
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Oops...',
                                            html: `
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                                `,
                                            confirmButtonText: 'Ok'
                                        });
                                    });
                                </script>
                            @endif


                            @if (session('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: '{{ session('success') }}',
                                            confirmButtonText: 'Ok'
                                        });
                                    });
                                </script>
                            @endif

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow-y: hidden;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($karyawan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    @if ($item->level == 1)
                                                        Pengurus
                                                    @elseif($item->level == 2)
                                                        General Manager
                                                    @elseif($item->level == 3)
                                                        Manager
                                                    @elseif($item->level == 4)
                                                        KA Unit
                                                    @else
                                                        Employee
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/karyawan/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                            class="fas fa-pen"></i></a>
                                                    <a href="/karyawan/destroy/{{ $item->id }}" class="btn btn-danger"
                                                        onclick="return confirm('Anda ingin menghapus karyawan?')"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">Belum ada data...</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $karyawan->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
