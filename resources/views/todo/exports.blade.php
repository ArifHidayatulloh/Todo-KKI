<div class="card-body table-responsive p-0" style="overflow-y: hidden;">
    <table class="table table-head-fixed text-nowrap">
        <thead>
            <tr style="text-align:center">
                <th style="width: 20px;">No</th>
                <th style="width: 150px">Departemen</th>
                <th style="width: 170px">Working List</th>
                <th style="width: 170px;">PIC</th>
                <th style="width: 170px">Related PIC</th>
                <th style="width: 100px;">Deadline</th>
                <th style="width: 100px;">Status</th>
                <th style="width: 100px;">Complete Date</th>
                <th style="width: 250px;">Comment Dephead</th>
                <th style="width: 250px;">Update PIC</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todo as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->departemen->departemen }}</td>
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
                    <td>{{ Carbon\Carbon::parse($item->deadline)->format('d m Y') }}</td>
                    <td>
                        @if ($item->status == 1)
                            Outstanding
                        @elseif($item->status == 2)
                            On Progress
                        @else
                            Done
                        @endif
                    </td>
                    <td>
                        @if ($item->complete_date != null)
                            {{ Carbon\Carbon::parse($item->complete_date)->format('d m Y') }}
                        @else
                            {{ $item->complete_date }}
                        @endif
                    </td>
                    <td style="white-space: pre-wrap;">{!! $item->comment_dephead !!}</td>
                    <td style="white-space: pre-wrap;">{!! $item->update_pic !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">Belum ada data...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
