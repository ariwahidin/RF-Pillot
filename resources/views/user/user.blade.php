@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col col-md-12">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table user active</h3>
                            <button class="btn btn-sm btn-primary float-right" id="btnCreate">New</button>
                        </div>
                        <div class="card-body" id="divTableUser">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formUser">
                @csrf
                <input type="hidden" id="proses">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address : </label>
                        <input type="email" name="email" id="email" class="form-control-sm" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Fullname : </label>
                        <input type="text" name="fullname" id="fullname" class="form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">Role : </label>
                        <select name="role" id="role" class="form-control-sm" required>
                            <option value="">Choose role</option>
                            @foreach($role as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Password : </label>
                        <input type="password" name="password" id="password" class="form-control-sm">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        showDataUser();

        $('#btnCreate').on('click', function() {
            $('#proses').val('new');
            $('#modal-default').modal('show')
        })

        $('#divTableUser').on('click', '.btnEdit', function() {
            let userId = $(this).data('id');
            $.ajax({
                url: 'user/' + userId,
                type: 'GET',
                success: function(response) {
                    $('#proses').val('edit');
                    $('#user_id').val(response.id);
                    $('#email').val(response.email);
                    $('#role').val(response.role);
                    $('#password').val('');
                    $('#fullname').val(response.name);
                    $('#modal-default').modal('show');
                }
            });
        })

        $('#divTableUser').on('click', '.btnDelete', function() {
            let userId = $(this).data('id');
            $.ajax({
                url: 'user/' + userId,
                type: 'DELETE',
                success: function(response) {
                    if (response.success == true) {
                        showDataUser();
                    }
                }
            });
        })

        $('#formUser').on('submit', function(e) {
            e.preventDefault();
            let proses = $('#proses').val();
            let formUser = $(this).serialize();

            if (proses == 'new') {
                $.ajax({
                    url: 'user/create',
                    type: 'POST',
                    data: formUser,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success == true) {
                            $('#modal-default').modal('hide');
                            showDataUser();
                        }
                    }
                });
            } else {
                $.ajax({
                    url: 'user/edit',
                    type: 'PUT',
                    data: formUser,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success == true) {
                            $('#modal-default').modal('hide');
                            showDataUser();
                        }
                    }
                });
            }


        })

        function showDataUser() {
            $.ajax({
                url: 'user/data',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.success == true) {
                        let divTable = $('#divTableUser');
                        divTable.empty();
                        divTable.html(response.content);
                    }
                }
            });
        }
    });
</script>

@endsection