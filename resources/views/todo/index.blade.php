<style>
    .comment-cell p {
    margin: 0;
    border-bottom: 1px solid #ddd; /* Garis bawah pada setiap komentar */
    padding-bottom: 5px; /* Spasi di bawah teks komentar */
    margin-bottom: 5px; /* Jarak antar komentar */
}

.update-pic-cell p {
    margin: 0;
    border-bottom: 1px solid #ddd; /* Garis bawah pada setiap item progres */
    padding-bottom: 5px; /* Spasi di bawah teks item progres */
    margin-bottom: 5px; /* Jarak antar item progres */
}

</style>

@extends('layout.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Todo</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Todo</li>
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
                                @if (session('level') == 1)
                                    <h3 class="card-title">
                                        <a href="/todo/create" class="btn btn-block btn-primary">Tambah Data</a>
                                    </h3>
                                @endif

                                <div class="card-tools my-2 d-flex">
                                    <form action="/todo/filterStatus" method="get" class="mr-2">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <select class="custom-select form-control-float float-right border-width-2"
                                                id="exampleSelectBorderWidth2" name="status">
                                                <option value="" {{ $status === '' ? 'selected' : '' }}>Pilih status
                                                </option>
                                                <option value="1" {{ $status == '1' ? 'selected' : '' }}>Outstanding
                                                </option>
                                                <option value="2" {{ $status == '2' ? 'selected' : '' }}>On Progress
                                                </option>
                                                <option value="3" {{ $status == '3' ? 'selected' : '' }}>Done</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @if (session('level') == 1)
                                    <form action="/todo/export" method="get" style="display: inline">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" name="status" value="{{ $status }}">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="overflow-y: hidden;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>No</th>
                                            <th>Departemen</th>
                                            <th>Working List</th>
                                            <th style="text-align: center">PIC</th>
                                            <th>Related PIC</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                            <th>Complete Date</th>
                                            <th>Comment Dephead</th>
                                            <th>Update PIC</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($todos as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->departemen->departemen }}</td>
                                                <td>{{ $item->working_list }}</td>
                                                <td>{{ $item->karyawan->nama }}</td>
                                                <td>
                                                    {{ $item->pic1->nama }}
                                                    @if ($item->relatedpic2 != null)
                                                        <br>{{ $item->pic2->nama }}
                                                    @endif
                                                    @if ($item->relatedpic3 != null)
                                                        <br>{{ $item->pic3->nama }}
                                                    @endif
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->deadline)->format('d m Y') }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-danger">Outstanding</span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge badge-warning">On Progress</span>
                                                    @else
                                                        <span class="badge badge-success">Done</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->complete_date != null)
                                                        {{ Carbon\Carbon::parse($item->complete_date)->format('d m Y') }}
                                                    @else
                                                        {{ $item->complete_date }}
                                                    @endif
                                                </td>
                                                <td class="comment-cell">
                                                    @foreach ($item->comments as $comment)
                                                        <p>{{ $comment }}</p>
                                                    @endforeach
                                                </td>
                                                <td class="update-pic-cell">
                                                    @foreach ($item->progress as $index => $progress)
                                                        <p>{{ $index }}.
                                                            @foreach ($progress as $prog)
                                                                {{ $prog }},
                                                            @endforeach
                                                        </p>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="/todo/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                            class="fas fa-pen"></i></a>

                                                    @if (session('level') == 1)
                                                        <a href="/todo/destroy/{{ $item->id }}" class="btn btn-danger"
                                                            onclick="return confirm('Anda ingin menghapus todo?')"><i
                                                                class="fas fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11">Belum ada data...</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $todos->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
