@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Departemen User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Departemen User</li>
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
                                    <a href="/departemen_user/create" class="btn btn-block btn-primary">Tambah Data</a>
                                </h3>


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
                                            <th>Karyawan</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($departemenUser as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->karyawan->nama }}</td>
                                                <td>{{ $item->departemen->departemen }}</td>
                                                <td>
                                                    @if ($item->karyawan->level == 1)
                                                    Pengurus
                                                    @elseif($item->karyawan->level == 2)
                                                    General Manager
                                                @elseif($item->karyawan->level == 3)
                                                    Manager
                                                @elseif($item->karyawan->level == 4)
                                                    KA Unit
                                                @else
                                                    Employee
                                                @endif
                                                </td>
                                                <td>
                                                    <a href="/departemen_user/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                            class="fas fa-pen"></i></a>
                                                    <a href="/departemen_user/destroy/{{ $item->id }}" class="btn btn-danger"
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
                                {{ $departemenUser->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
