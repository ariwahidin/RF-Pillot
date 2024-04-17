@extends('layouts.app')

@section('content')

<section class="content-header">
    <h4>Internal transfer By Location</h4>
</section>

<section class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form id="formSearch">
                    <div class="form-group">
                        <label for="">Lokasi Asal : </label>
                        <input type="text" class="form-control-sm" name="lokasi_asal" id="lokasi_asal" required autofocus>
                        <button class="btn btn-sm btn-info">Cari</button>
                    </div>
                </form>

                <form style="display: none;" id="formTransfer">
                    <div class="form-group">
                        <label for="">Lokasi Tujuan : </label>
                        <input type="hidden" class="form-control-sm" name="tf_lokasi_asal" id="tf_lokasi_asal" required>
                        <input type="text" class="form-control-sm" name="tf_lokasi_tujuan" id="tf_lokasi_tujuan" required>
                        <button class="btn btn-sm btn-success">Prosess</button>
                    </div>
                </form>

                <div id="divToast">

                </div>
            </div>
            <div class="col col-md-6">
                <div id="divItem"></div>
            </div>
        </div>
    </div>
</section>




<script>
    $(document).ready(function() {
        $('#formSearch').on('submit', function(e) {
            e.preventDefault();
            startLoading();
            let formSearch = $(this).serialize();
            $.ajax({
                url: 'itemByLocation',
                type: 'POST',
                data: formSearch,
                dataType: 'JSON',
                success: function(response) {
                    stopLoading();
                    if (response.success == true) {
                        let divContent = $('#divItem');
                        divContent.empty();
                        divContent.html(response.content);
                        $('#formTransfer').css('display', 'block');
                        $('#tf_lokasi_asal').val($('#lokasi_asal').val());

                    }
                }
            });
        })

        $('#lokasi_asal').on('focus', function() {
            $('#formTransfer').css('display', 'none');
            $('#divToast').empty();
        })

        $('#formTransfer').on('submit', function(e) {
            e.preventDefault();
            startLoading();
            let lokasi_asal = $('#tf_lokasi_asal').val();
            let lokasi_tujuan = $('#tf_lokasi_tujuan').val();
            let formTransfer = $(this).serialize();

            if (lokasi_asal != lokasi_tujuan) {
                $.ajax({
                    url: 'prosesTransferByLocation',
                    type: 'POST',
                    data: formTransfer,
                    dataType: 'JSON',
                    success: function(response) {
                        stopLoading();
                        if (response.success == true) {
                            let divToast = $('#divToast');
                            divToast.empty();
                            divToast.html(`<div class="card card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Success</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                ${response.message}
                                                </div>
                                            </div>`);
                            $('#divItem').empty();
                            $('#formTransfer').css('display', 'none');
                        } else {
                            let divToast = $('#divToast');
                            divToast.empty();
                            divToast.html(`<div class="card card-danger">
                                                <div class="card-header">
                                                    <h3 class="card-title">Error</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                ${response.message}
                                                </div>
                                            </div>`);
                            $('#divItem').empty();
                            $('#formTransfer').css('display', 'none');
                        }
                    }
                });
            } else {
                alert('lokasi tidak boleh sama');
            }

        })
    });
</script>


@endsection