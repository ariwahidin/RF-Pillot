<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar item di lokasi : {{ $lokasi }}</h4>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Code</th>
                    <th>Avail</th>
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
                    <td>{{ $data->item_code }}</td>
                    <td>{{ $data->qty_avail }}</td>
                    <td>{{ $data->qastatus }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>