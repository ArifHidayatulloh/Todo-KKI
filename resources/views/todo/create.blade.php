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
                                <h3 class="card-title">Tambah Todo</h3>
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

                            <form action="/todo/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Terminal Code</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="terminal_code">
                                            <option value="" selected>Pilih terminal</option>
                                            @forelse ($terminal as $term)
                                                <option value="{{ $term->terminal_code }}">{{ $term->terminal_code }} |
                                                    {{ $term->nm_terminal }}</option>
                                            @empty
                                                <option value="">Terminal tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Working List</label>
                                        <input type="text" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" placeholder="Working List" name="working_list"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">PIC</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="pic">
                                            <option value="" selected>Pilih PIC</option>
                                            @forelse ($karyawan as $kar)
                                                <option value="{{ $kar->nik }}">{{ $kar->nik }} |
                                                    {{ $kar->nama }}</option>
                                            @empty
                                                <option value="">PIC tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Related PIC</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="id_relatedpic">
                                            <option value="" selected>Pilih Related PIC</option>
                                            @forelse ($relatedpic as $pic)
                                                <option value="{{ $pic->id_relatedpic }}">{{ $pic->nik }} |
                                                    {{ $pic->nama }}</option>
                                            @empty
                                                <option value="">Related PIC tidak tersedia</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Deadline</label>
                                        <input type="date" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" name="deadline" required>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleSelectBorderWidth2">Status</label>
                                        <select class="custom-select form-control-border border-width-2"
                                            id="exampleSelectBorderWidth2" name="status">
                                            <option value="" selected>Pilih status</option>
                                            <option value="1">Outstanding</option>
                                            <option value="2">On Progress</option>
                                            <option value="3">Done</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Complete Date</label>
                                        <input type="date" class="form-control form-control-border border-width-2"
                                            id="exampleInputBorderWidth2" name="complete_date">
                                    </div>
                                    <div class="form-group">
                                        <label>Comment Dephead</label>
                                        <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Comment Dephead..."
                                            name="comment_dephead" style="white-space: pre-wrap;" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Update PIC</label>
                                        <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Update PIC..."
                                            name="update_pic" style="white-space: pre-wrap;"></textarea>
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
