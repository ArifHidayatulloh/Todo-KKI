<style>
    .comment-cell p {
        margin: 0;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }

    .update-pic-cell p {
        margin: 0;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }

    .select-wrapper {
        display: inline-block;
        width: 100%;
    }

    .select-wrapper select {
        width: 100%;
        border: none;
        padding: 0;
        height: auto;
        line-height: normal;
    }

    th,
    td {
        vertical-align: middle;
    }

    .form-select-wrapper {
        display: inline-block;
        width: auto;
    }

    .form-select-wrapper select {
        display: none;
        width: auto;
        min-width: 120px;
        /* Sesuaikan ukuran minimum sesuai kebutuhan */
    }

    .option-list {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 120px;
        z-index: 10000;
        /* Pastikan berada di atas elemen lain */
        max-height: 200px;
        /* Sesuaikan tinggi maksimum */
        overflow-y: auto;
        /* Menambahkan scrollbar vertikal jika terlalu banyak item */
    }

    .option-list li {
        padding: 8px 12px;
        cursor: pointer;
    }

    .option-list li:hover {
        background-color: #f1f1f1;
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

        <input type="text" hidden name="status" value="{{ $status }}">
        <input type="text" hidden name="pic" value="{{ $pic }}">
        <input type="text" hidden name="dep_code" value="{{ $dep_code }}">
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
                                    @if (session('level') == 1 || session('level') == 2)
                                        <form action="/todo/export" method="get" class="ml-2">
                                            <input type="hidden" name="status" value="{{ $status }}">
                                            <input type="hidden" name="pic" value="{{ $pic }}">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>No</th>
                                            <th class="departemen-column" style="position: relative;">
                                                Departemen
                                                <ul class="option-list departemen-options">
                                                    <li data-value="">All</li>
                                                    @foreach ($departemenList as $departemen)
                                                        <li data-value="{{ $departemen->dep_code }}"
                                                            {{ $dep_code == $departemen->dep_code ? 'selected' : '' }}>
                                                            {{ $departemen->departemen }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </th>
                                            <th>Working List</th>
                                            <th class="pic-column" style="position: relative;">
                                                PIC
                                                <ul class="option-list pic-options">
                                                    <li data-value="">All</li>
                                                    @foreach ($karyawan as $kar)
                                                        <li data-value="{{ $kar->nik }}"
                                                            {{ $pic == $kar->nik ? 'selected' : '' }}>
                                                            {{ $kar->nama }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </th>
                                            <th>Related PIC</th>
                                            <th>Deadline</th>
                                            <th class="status-column" style="position: relative;">
                                                Status
                                                <ul class="option-list">
                                                    <li data-value="">All</li>
                                                    <li data-value="1">Outstanding</li>
                                                    <li data-value="2">On Progress</li>
                                                    <li data-value="3">Done</li>
                                                </ul>
                                            </th>
                                            <th>Complete Date</th>
                                            <th>Comment Dephead</th>
                                            <th>Update PIC</th>
                                            @if (session('level') != 5)
                                                <th>Action</th>
                                            @endif
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
                                                    @if ($item->relatedpic)
                                                        @foreach ($item->relatedPicNames as $relpic)
                                                            {{ $relpic }}<br>
                                                        @endforeach
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
                                                    @if ($item->complete_date)
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
                                                    @if (session('level') != 5)
                                                        <a href="/todo/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                                class="fas fa-pen"></i></a>
                                                    @endif

                                                    @if (session('level') == 1 || session('level') == 2)
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


<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listeners for Status
        var thStatus = document.querySelector('th.status-column');
        var optionListStatus = thStatus.querySelector('.option-list');

        thStatus.addEventListener('click', function() {
            optionListStatus.style.display = (optionListStatus.style.display === 'none' ||
                optionListStatus.style.display === '') ? 'block' : 'none';
        });

        optionListStatus.querySelectorAll('li').forEach(function(item) {
            item.addEventListener('click', function() {
                var selectedValue = this.getAttribute('data-value');
                submitForm('status', selectedValue);
            });
        });

        // Event listeners for Departemen
        var thDepartemen = document.querySelector('th.departemen-column');
        var optionListDepartemen = thDepartemen.querySelector('.departemen-options');

        thDepartemen.addEventListener('click', function() {
            optionListDepartemen.style.display = (optionListDepartemen.style.display === 'none' ||
                optionListDepartemen.style.display === '') ? 'block' : 'none';
        });

        optionListDepartemen.querySelectorAll('li').forEach(function(item) {
            item.addEventListener('click', function() {
                var selectedValue = this.getAttribute('data-value');
                submitForm('dep_code', selectedValue);
            });
        });

        // Event listeners for PIC
        var thPic = document.querySelector('th.pic-column');
        var optionListPic = thPic.querySelector('.pic-options');

        thPic.addEventListener('click', function() {
            optionListPic.style.display = (optionListPic.style.display === 'none' || optionListPic.style
                .display === '') ? 'block' : 'none';
        });

        optionListPic.querySelectorAll('li').forEach(function(item) {
            item.addEventListener('click', function() {
                var selectedValue = this.getAttribute('data-value');
                submitForm('pic', selectedValue);
            });
        });

        // Sembunyikan opsi jika klik di luar th status, departemen, atau pic
        document.addEventListener('click', function(event) {
            if (!thStatus.contains(event.target)) {
                optionListStatus.style.display = 'none';
            }
            if (!thDepartemen.contains(event.target)) {
                optionListDepartemen.style.display = 'none';
            }
            if (!thPic.contains(event.target)) {
                optionListPic.style.display = 'none';
            }
        });

        // Fungsi untuk submit form dengan nilai yang dipilih
        function submitForm(field, value) {
            var form = document.createElement('form');
            form.method = 'get';
            form.action = '/todo/index';

            // Ambil nilai dari status, departemen, dan PIC yang sudah dipilih
            var currentStatus = document.querySelector('input[name="status"]').value;
            var currentDepCode = document.querySelector('input[name="dep_code"]').value;
            var currentPic = document.querySelector('input[name="pic"]').value;

            // Buat input untuk field yang dipilih
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = field;
            input.value = value;
            form.appendChild(input);

            // Buat input untuk field yang sudah dipilih sebelumnya
            if (field !== 'status') {
                var statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                statusInput.value = currentStatus;
                form.appendChild(statusInput);
            }

            if (field !== 'dep_code') {
                var depCodeInput = document.createElement('input');
                depCodeInput.type = 'hidden';
                depCodeInput.name = 'dep_code';
                depCodeInput.value = currentDepCode;
                form.appendChild(depCodeInput);
            }

            if (field !== 'pic') {
                var picInput = document.createElement('input');
                picInput.type = 'hidden';
                picInput.name = 'pic';
                picInput.value = currentPic;
                form.appendChild(picInput);
            }

            document.body.appendChild(form);
            form.submit();
        }
    });
</script>
