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

    /* Opsi Dropdown */
    .option-list {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 200px;
        /* Lebar dropdown */
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: opacity 0.2s ease-in-out;
    }

    .option-list li {
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .option-list li:hover {
        background-color: #f1f1f1;
    }

    .option-toggle {
        display: inline-block;
        padding: 10px;
        /* border: 1px solid #ddd; */
        /* border-radius: 4px; */
        cursor: pointer;
        position: relative;
        background-color: #fff;
        transition: background-color 0.2s ease;
    }

    .option-toggle:hover {
        background-color: #f1f1f1;
    }

    .option-toggle::after {
        content: '\25BC';
        /* Panah ke bawah */
        font-size: 12px;
        margin-left: 8px;
    }

    .min-height-table {
        min-height: 400px;
        /* Sesuaikan tinggi minimum sesuai kebutuhan */
    }

    .min-height-table tbody tr:last-child td {
        border-bottom: none;
        /* Menghilangkan garis bawah pada baris terakhir jika tabel kosong */
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
                                    @if (session('level') == 1 || session('level') == 2)
                                        <form action="/todo/export" method="get" class="ml-2" id="export-form">
                                            <input type="hidden" name="status" value="{{ $status }}">
                                            <input type="hidden" name="pic" value="{{ $pic }}">
                                            <input type="text" hidden name="dep_code" value="{{ $dep_code }}">
                                            <button type="submit" class="btn btn-success" id="export-button"
                                                @if ($todos->isEmpty()) disabled @endif>
                                                <i class="fas fa-file-excel"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap min-height-table">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>No</th>
                                            @if (session('level') == 1 || session('level') == 2 || session('level') == 3)
                                                <th class="departemen-column option-toggle">
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
                                            @else
                                                <th>Departemen</th>
                                            @endif
                                            <th>Working List</th>
                                            @if (session('level') == 1 || session('level') == 2)
                                                <th class="pic-column option-toggle">
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
                                            @else
                                                <th>PIC</th>
                                            @endif
                                            <th>Related PIC</th>
                                            <th>Deadline</th>
                                            <th class="status-column option-toggle">
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
        // Function to toggle dropdown visibility
        function toggleDropdown(thElement) {
            var optionList = thElement.querySelector('.option-list');
            var isVisible = optionList.style.display === 'block';
            optionList.style.display = isVisible ? 'none' : 'block';
        }

        // Function to handle option selection
        function handleOptionClick(thElement, field) {
            var optionList = thElement.querySelector('.option-list');
            optionList.querySelectorAll('li').forEach(function(item) {
                item.addEventListener('click', function() {
                    var selectedValue = this.getAttribute('data-value');
                    submitForm(field, selectedValue);
                });
            });
        }

        // Function to submit form with selected filter
        function submitForm(field, value) {
            var form = document.createElement('form');
            form.method = 'get';
            form.action = '/todo/index';

            // Add the selected filter field
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = field;
            input.value = value;
            form.appendChild(input);

            // Add other filter fields if they exist
            ['status', 'dep_code', 'pic'].forEach(function(filterField) {
                if (filterField !== field) {
                    var existingInput = document.querySelector(`input[name="${filterField}"]`);
                    if (existingInput) {
                        var newInput = document.createElement('input');
                        newInput.type = 'hidden';
                        newInput.name = filterField;
                        newInput.value = existingInput.value;
                        form.appendChild(newInput);
                    }
                }
            });

            document.body.appendChild(form);
            form.submit();
        }

        // Setup event listeners
        var thStatus = document.querySelector('th.status-column');
        var thDepartemen = document.querySelector('th.departemen-column');
        var thPic = document.querySelector('th.pic-column');

        if (thStatus) {
            var optionListStatus = thStatus.querySelector('.option-list');
            thStatus.addEventListener('click', function() {
                toggleDropdown(thStatus);
            });
            handleOptionClick(thStatus, 'status');
        }

        if (thDepartemen) {
            var optionListDepartemen = thDepartemen.querySelector('.departemen-options');
            thDepartemen.addEventListener('click', function() {
                toggleDropdown(thDepartemen);
            });
            handleOptionClick(thDepartemen, 'dep_code');
        }

        if (thPic) {
            var optionListPic = thPic.querySelector('.pic-options');
            thPic.addEventListener('click', function() {
                toggleDropdown(thPic);
            });
            handleOptionClick(thPic, 'pic');
        }

        // Hide dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            [thStatus, thDepartemen, thPic].forEach(function(thElement) {
                var optionList = thElement ? thElement.querySelector(
                    '.option-list, .departemen-options, .pic-options') : null;
                if (optionList && !thElement.contains(event.target) && !optionList.contains(
                        event.target)) {
                    optionList.style.display = 'none';
                }
            });
        });
    });
</script>
