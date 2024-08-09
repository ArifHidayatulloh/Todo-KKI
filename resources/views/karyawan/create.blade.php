@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Karyawan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="/karyawan/index">Karyawan</a></li>
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
                                <h3 class="card-title">Tambah Karyawan</h3>
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

                            <form action="/karyawan/store" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">NIK</label>
                                        <input type="text" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="NIK" name="nik" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Nama</label>
                                        <input type="text" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="Nama Karyawan" name="nama"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Email</label>
                                        <input type="email" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="email@gmail.com" name="email"
                                            required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Password</label>
                                        <input type="password" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="Password" name="password"
                                            required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Level</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="level">
                                            <option value="" selected>Pilih level</option>
                                            <option value="1">Pengurus</option>
                                            <option value="2">General Manager</option>
                                            <option value="3">Manager</option>
                                            <option value="4">KA Unit</option>
                                            <option value="5">Employee</option>
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
