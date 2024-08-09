@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Form Todo</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="/todo/index">Todo</a></li>
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
                    <!-- Form Container -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Todo</h3>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <p><i class="icon fas fa-exclamation-triangle"></i> {{ $error }}!</p>
                                    </div>
                                @endforeach
                            @endif

                            <form action="/todo/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleSelectBorderWidth2">Departemen</label>
                                                <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="dep_code">
                                                    <option value="" selected>Pilih departemen</option>
                                                    @forelse ($departemen as $dep)
                                                        <option value="{{ $dep->dep_code }}">{{ $dep->departemen }}</option>
                                                    @empty
                                                        <option value="">Departemen tidak tersedia</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputBorderWidth2">Working List</label>
                                                <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Working List" name="working_list" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectBorderWidth2">PIC</label>
                                                <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2" name="pic">
                                                    <option value="" selected>Pilih PIC</option>
                                                    @forelse ($karyawan as $kar)
                                                        <option value="{{ $kar->nik }}">{{ $kar->nama }}</option>
                                                    @empty
                                                        <option value="">PIC tidak tersedia</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectBorderWidth2">Related PIC</label>
                                                <div class="form-checkpic"  style="height:150px; overflow-y:auto;">
                                                @foreach ($karyawan as $kar)
                                                    <div class="form-check" >
                                                        <input class="form-check-input" type="checkbox" name="relatedpic[]" value="{{ $kar->nik }}" id="relatedpic{{ $kar->nik }}">
                                                        <label class="form-check-label" for="relatedpic{{ $kar->nik }}">
                                                            {{ $kar->nama }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputBorderWidth2">Deadline</label>
                                                <input type="date" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" name="deadline" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputBorderWidth2">Complete Date</label>
                                                <input type="date" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" name="complete_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Comment Dephead</label>
                                                <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Comment Dephead..." name="comment_dephead" style="white-space: pre-wrap;" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Update PIC</label>
                                                <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Update PIC..." name="update_pic" style="white-space: pre-wrap;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                    <button type="reset" class="btn btn-default float-right">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
