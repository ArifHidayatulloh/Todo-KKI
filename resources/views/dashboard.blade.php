<style>
    .comment-cell p {
        margin: 0;
        border-bottom: 1px solid #ddd;
        /* Garis bawah pada setiap komentar */
        padding-bottom: 5px;
        /* Spasi di bawah teks komentar */
        margin-bottom: 5px;
        /* Jarak antar komentar */
    }

    .update-pic-cell p {
        margin: 0;
        border-bottom: 1px solid #ddd;
        /* Garis bawah pada setiap item progres */
        padding-bottom: 5px;
        /* Spasi di bawah teks item progres */
        margin-bottom: 5px;
        /* Jarak antar item progres */
    }
</style>

@extends('layout.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                    @if (session('level') == 1)
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="nav-icon fas fa-landmark"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Departemen</span>
                                    <span class="info-box-number">{{ $departemens }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="nav-icon fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Karyawan</span>
                                    <span class="info-box-number">{{ $karyawans }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        {{-- <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-building"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Terminal</span>
                                    <span class="info-box-number">{{ $terminals }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div> --}}
                        <!-- /.col -->
                        {{-- <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Related PIC</span>
                                    <span class="info-box-number">{{ $relatedPIC }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div> --}}
                    @endif
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fas fa-list-ol"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">To Do</span>
                                <span class="info-box-number">{{ $todos }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Deadline Dalam Seminggu
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr style="text-align:center">
                                                    <th>No</th>
                                                    <th>Department</th>
                                                    <th>Working List</th>
                                                    <th style="text-align: center">PIC</th>
                                                    <th>Related PIC</th>
                                                    <th>Deadline</th>
                                                    <th>Status</th>
                                                    <th>Complete Date</th>
                                                    <th>Comment Dephead</th>
                                                    <th>Update PIC</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($deadlineAsc as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->departemen->departemen }}
                                                        </td>
                                                        <td>{{ $item->working_list }}</td>
                                                        <td>{{ $item->karyawan->nama }}</td>
                                                        <td>

                                                            @if ($item->relatedpic != null)
                                                                @foreach ($item->relatedPicNames as $relpic)
                                                                    {{ $relpic }}
                                                                    <br>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($item->deadline)->format('d m Y') }}
                                                        </td>
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
                                                            <a href="/todo/edit/{{ $item->id }}"
                                                                class="btn btn-warning"><i class="fas fa-pen"></i></a>

                                                            @if (session('level') == 1)
                                                                <a href="/todo/destroy/{{ $item->id }}"
                                                                    class="btn btn-danger"
                                                                    onclick="return confirm('Anda ingin menghapus todo?')"><i
                                                                        class="fas fa-trash"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="11">Tidak ada deadline kurang dari seminggu | Periksa
                                                            tugas anda pada menu todo!!!</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer clearfix">
                                        {{-- {{ $todo->links('vendor.pagination.bootstrap-4') }} --}}
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
