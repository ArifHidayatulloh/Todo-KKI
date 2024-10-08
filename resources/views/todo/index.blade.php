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

    .sort-icon {
        margin-left: 5px;
        display: inline-block;
    }

    .sort-icon::before {
        content: '▲';
        /* Default ke panah ke atas */
        font-size: 12px;
        color: #333;
    }

    .sort-icon.desc::before {
        content: '▼';
        /* Ganti dengan panah ke bawah saat descending */
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
                                @if (session('level') == 1 || session('level') == 2)
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

                                <div>

                                    @if ($errors->any())
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Oops...',
                                                    html: `
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                                `,
                                                    confirmButtonText: 'Ok'
                                                });
                                            });
                                        </script>
                                    @endif


                                    @if (session('success'))
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    text: '{{ session('success') }}',
                                                    confirmButtonText: 'Ok'
                                                });
                                            });
                                        </script>
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
                                            <th class="deadline-column" style="cursor: pointer;">
                                                Deadline
                                                <span
                                                    class="sort-icon {{ request('sort_order') === 'desc' ? 'desc' : '' }}"></span>
                                            </th>
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
                                            @if (session('level') == 3 || session('level') == 4 || session('level') == 5)
                                                <th>Request</th>
                                            @endif
                                            <th class="created-at-column" style="cursor: pointer;">
                                                Created At
                                                <span class="sort-icon {{ $sortField === 'created_at' && $sortOrder === 'desc' ? 'desc' : '' }}"></span>
                                            </th>
                                            <th>Action</th>
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
                                                <td>{{ Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</td>
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
                                                        {{ Carbon\Carbon::parse($item->complete_date)->format('d M Y') }}
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
                                                @if (session('level') == 3 || session('level') == 4 || session('level') == 5)
                                                    <td>
                                                        @if ($item->req_status == null)
                                                            not in the request
                                                        @elseif($item->req_status == 'request')
                                                            in the request
                                                        @elseif($item->req_status == 'rejected')
                                                            {{ $item->req_status }} <button type="button"
                                                                class="btn btn-danger" data-toggle="modal"
                                                                data-target="#modal-reject-{{ $item->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modal-reject-{{ $item->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="modal-reject-label-{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="modal-reject-label-{{ $item->id }}">
                                                                                Keterangan</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>Comment Update</label>
                                                                                <textarea class="form-control form-control-border border-width-2" rows="3" placeholder="Keterangan..."
                                                                                    name="comment_update" style="white-space: pre-wrap;" disabled>{{ $item->comment_update }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            {{ $item->req_status }}
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{$item->created_at->format('d M Y')}}</td>
                                                <td>
                                                    <a href="/todo/edit/{{ $item->id }}" class="btn btn-warning"><i
                                                            class="fas fa-pen"></i></a>

                                                    @if (session('level') == 1 || session('level') == 2)
                                                        <a href="/todo/destroy/{{ $item->id }}" class="btn btn-danger"
                                                            onclick="return confirm('Anda ingin menghapus todo?')"><i
                                                                class="fas fa-trash"></i></a>
                                                    @endif

                                                    @if (session('level') == 3 || session('level') == 4 || session('level') == 5)
                                                        @if ($item->status == 2)
                                                            <a href="/todo/requestActionPic/{{ $item->id }}"
                                                                class="btn btn-info"
                                                                onclick="return confirm('Anda ingin mengajukan request?')"><i
                                                                    class="fas fa-paper-plane"></i></a>
                                                        @endif
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
        // Toggle dropdown visibility
        function toggleDropdown(thElement) {
            var optionList = thElement.querySelector('.option-list');
            var isVisible = optionList.style.display === 'block';
            optionList.style.display = isVisible ? 'none' : 'block';
        }

        // Handle option click
        function handleOptionClick(thElement, field) {
            var optionList = thElement.querySelector('.option-list');
            optionList.querySelectorAll('li').forEach(function(item) {
                item.addEventListener('click', function() {
                    var selectedValue = this.getAttribute('data-value');
                    submitForm(field, selectedValue);
                });
            });
        }

        // Submit form with selected value and sorting order
        function submitForm(field, value, sortOrder = 'asc') {
            var form = document.createElement('form');
            form.method = 'get';
            form.action = '/todo/index';

            // Append selected filter value
            var inputField = document.createElement('input');
            inputField.type = 'hidden';
            inputField.name = field;
            inputField.value = value;
            form.appendChild(inputField);

            // Append sorting order
            var inputSort = document.createElement('input');
            inputSort.type = 'hidden';
            inputSort.name = 'sort_order';
            inputSort.value = sortOrder;
            form.appendChild(inputSort);

            // Append field to sort
            var inputSortField = document.createElement('input');
            inputSortField.type = 'hidden';
            inputSortField.name = 'sort_field';
            inputSortField.value = field;
            form.appendChild(inputSortField);

            // Preserve other filters
            ['status', 'dep_code', 'pic', 'deadline'].forEach(function(filterField) {
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

        // Apply toggle and option click handler for each dropdown
        var thDepartemen = document.querySelector('th.departemen-column');
        var thPic = document.querySelector('th.pic-column');
        var thDeadline = document.querySelector('th.deadline-column');
        var thStatus = document.querySelector('th.status-column');
        var thCreatedAt = document.querySelector('th.created-at-column'); // For created_at

        if (thDepartemen) {
            thDepartemen.addEventListener('click', function() {
                toggleDropdown(this);
            });
            handleOptionClick(thDepartemen, 'dep_code');
        }

        if (thPic) {
            thPic.addEventListener('click', function() {
                toggleDropdown(this);
            });
            handleOptionClick(thPic, 'pic');
        }

        if (thDeadline) {
            thDeadline.addEventListener('click', function() {
                var currentSortOrder = thDeadline.querySelector('.sort-icon').classList.contains('desc') ? 'asc' : 'desc';
                submitForm('deadline', '', currentSortOrder);
            });
        }

        if (thStatus) {
            thStatus.addEventListener('click', function() {
                toggleDropdown(this);
            });
            handleOptionClick(thStatus, 'status');
        }

        if (thCreatedAt) {
            thCreatedAt.addEventListener('click', function() {
                var currentSortOrder = thCreatedAt.querySelector('.sort-icon').classList.contains('desc') ? 'asc' : 'desc';
                submitForm('created_at', '', currentSortOrder);
            });
        }

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var isClickInside = thDepartemen.contains(event.target) ||
                thPic.contains(event.target) ||
                thDeadline.contains(event.target) ||
                thStatus.contains(event.target) ||
                thCreatedAt.contains(event.target); // For created_at

            if (!isClickInside) {
                var optionLists = document.querySelectorAll('.option-list');
                optionLists.forEach(function(list) {
                    list.style.display = 'none';
                });
            }
        });
    });
</script>
