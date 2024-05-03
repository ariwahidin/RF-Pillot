<div class="card">
    <div class="card-header">
        <h4 class="card-title">Location : {{ $lokasi }}</h4><br>
        <span>{{ count($item)}} Item found</span>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-sm table-bordered table-nowrap table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Code</th>
                    <th>Avail</th>
                    <th>Prod Date</th>
                    <th>QA</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($item as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="white-space: nowrap;">{{ $data->item_code }}</td>
                    <td>{{ $data->qty_avail }}</td>
                    <td style="white-space: nowrap;">{{ $data->expire }}</td>
                    <td>{{ $data->qastatus }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>