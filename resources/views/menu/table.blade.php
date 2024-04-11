<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Parent Menu</th>
            <th>Menu</th>
            <th>URL</th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach($menu as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->parent_name }}</td>
            <td>{{ $data->label }}</td>
            <td>{{ $data->url }}</td>
            <td>
                <button class="btn btn-xs btn-primary btnEdit" data-id="{{ $data->id }}">Edit</button>
                <button class="btn btn-xs btn-danger btnDelete" data-id="{{ $data->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>