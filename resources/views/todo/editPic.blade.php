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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Ubah Todo</h3>
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

                            <form action="/todo/updatePIC/{{ $todo->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group" style="display: none;">
                                        <label for="exampleSelectBorderWidth2">Status</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="status">
                                            @if ($todo->status == 1)
                                                <option value="1" selected>Outstanding</option>
                                                <option value="2">On Progress</option>
                                                <option value="3">Done</option>
                                            @elseif($todo->status == 2)
                                                <option value="1">Outstanding</option>
                                                <option value="2" selected>On Progress</option>
                                                <option value="3">Done</option>
                                            @else
                                                <option value="1">Outstanding</option>
                                                <option value="2">On Progress</option>
                                                <option value="3" selected>Done</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Update PIC</label>
                                        <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Update PIC..."
                                            name="update_pic" style="white-space: pre-wrap;">{{ $todo->update_pic }}</textarea>
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
