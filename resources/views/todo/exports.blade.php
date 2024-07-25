<div class="card-body table-responsive p-0" style="overflow-y: hidden;">
    <table class="table table-head-fixed text-nowrap">
        <thead>
            <tr style="text-align:center">
                <th>No</th>
                <th>Terminal Code</th>
                <th>Working List</th>
                <th style="text-align: center">PIC</th>
                <th>Related PIC</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Complete Date</th>
                <th>Comment Dephead</th>
                <th>Update PIC</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todo as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->terminal->nm_terminal }}</td>
                    <td>{{ $item->working_list }}</td>
                    <td>{{ $item->karyawan->nik }} | {{ $item->karyawan->nama }}</td>
                    <td>{{ $item->relatedpic->nik }} | {{ $item->relatedpic->nama }}</td>
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
                    <td style="white-space: pre-wrap;">{{ $item->comment_dephead }}</td>
                    <td>{{ $item->update_pic }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Belum ada data...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
