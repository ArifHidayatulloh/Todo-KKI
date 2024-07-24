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
                                <h3 class="card-title">Ubah Karyawan</h3>
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

                            <form action="/karyawan/update/{{ $karyawan->id }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">NIK</label>
                                        <input type="text" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="NIK" name="nik" required
                                            value="{{ $karyawan->nik }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Departemen Code</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="dep_code">
                                            @if ($karyawan->dep_code == null)
                                                <option value="" selected>Pilih departemen</option>
                                            @endif
                                            @forelse ($departemen as $depart)
                                                @if ($karyawan->dep_code == $depart->dep_code)
                                                    <option value="{{ $depart->dep_code }}" selected>{{ $depart->dep_code }}
                                                        | {{ $depart->departemen }}</option>
                                                @else
                                                    <option value="{{ $depart->dep_code }}">{{ $depart->dep_code }} |
                                                        {{ $depart->departemen }}</option>
                                                @endif
                                            @empty
                                                <option value="">Departemen tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Nama</label>
                                        <input type="text" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="Nama Karyawan" name="nama"
                                            required value="{{ $karyawan->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Email</label>
                                        <input type="email" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="email@gmail.com" name="email"
                                            required value="{{ $karyawan->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Password</label>
                                        <input type="password" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Level</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="level">
                                            <option value="{{ $karyawan->level }}" selected>{{ $karyawan->level }}
                                            </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
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
