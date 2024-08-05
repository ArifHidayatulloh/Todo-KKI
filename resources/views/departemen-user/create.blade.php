@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Departemen User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="/departemen_user/index">Departemen User</a></li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Departemen User</h3>
                            </div>
                            <!-- /.card-header -->
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <p><i class="icon fas fa-exclamation-triangle"></i> {{ $error }}!</p>
                                    </div>
                                @endforeach
                            @endif

                            <form action="/departemen_user/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">NIK</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="nik">
                                            <option value="" selected>Pilih karyawan</option>
                                            @forelse ($karyawan as $kar)
                                                <option value="{{ $kar->nik }}"> {{ $kar->nik }} | {{ $kar->nama }}
                                                </option>
                                            @empty
                                                <option value="">Karyawan tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Departemen</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="dep_code">
                                            <option value="" selected>Pilih Departemen</option>
                                            @forelse ($departemen as $dep)
                                                <option value="{{ $dep->dep_code }}"> {{ $dep->dep_code }} | {{ $dep->departemen }}
                                                </option>
                                            @empty
                                                <option value="">Departemen tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    <button type="reset" class="btn btn-default float-right">Batal</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
