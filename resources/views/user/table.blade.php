<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach($user as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->role_name }}</td>
            <td>
                <button class="btn btn-xs btn-primary btnEdit" data-id="{{ $data->id }}">Edit</button>
                <button class="btn btn-xs btn-danger btnDelete" data-id="{{ $data->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>