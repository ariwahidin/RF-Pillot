@extends('layouts.app')

@section('content')

<style>
    .scrollable-card {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

<section class="content-header">
    <h4 style="font-size: 18px;">Create internal transfer</h4>
</section>

<section class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <form id="formSearch">
                            <div class="form-group d-flex">
                                <label style="font-size: 14px; white-space: nowrap;" for="">Origin Loc : &nbsp; </label>
                                <input style="width: 200px;" type="text" class="form-control-sm" name="lokasi_asal" id="lokasi_asal" required autofocus>
                            </div>
                            <div class="form-group d-flex">
                                <label style="font-size: 14px; white-space: nowrap;" for="">Item Code : &nbsp;</label>
                                <input style="width: 200px;" type="text" class="form-control-sm" name="item_code" id="item_code">
                            </div>
                            <div class="form-group d-flex">
                                <label style="font-size: 14px; white-space: nowrap;">Prod Date &nbsp;: &nbsp;</label>
                                <input type="number" class="form-control-sm inDate" id="inYear" style="width: 60px;" maxlength="4" placeholder="yyyy">
                                <span>&nbsp;-&nbsp;</span>
                                <input type="number" class="form-control-sm inDate" id="inMonth" style="width: 50px;" maxlength="2" placeholder="mm">
                                <span>&nbsp;-&nbsp;</span>
                                <input type="number" class="form-control-sm inDate" id="inDay" style="width: 50px;" maxlength="2" placeholder="dd">
                                <input type="hidden" class="form-control" id="prod_date" name="prod_date">
                            </div>
                            <div class="form-group d-flex mb-0">
                                <button type="button" class="btn btn-sm btn-warning w-100 mb-0 mr-1" id="btnReset">Reset</button>
                                <button class="btn btn-sm btn-info w-100 mb-0">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div style="display: none;" class="card" id="cardFormTransfer">
                    <div class="card-body">
                        <form id="formTransfer">
                            <div class="form-group d-flex">
                                <label style="font-size: 14px; white-space: nowrap;">Dest Loc : &nbsp;</label>
                                <input type="text" class="form-control-sm" name="tf_lokasi_tujuan" id="tf_lokasi_tujuan" required>
                            </div>
                            <div class="form-group d-flex mb-0">
                                <button class="btn btn-sm btn-success w-100">Process</button>
                            </div>
                        </form>
                    </div>
                </div>





                <div id="divToast">

                </div>
            </div>
            <div class="col col-md-6">
                <div id="divItem">

                </div>
            </div>
        </div>
    </div>
</section>




<script>
    $(document).ready(function() {

        $('#inYear').on('keyup', function() {
            if ($(this).val().length == 4) {
                $('#inMonth').focus();
            }
        })

        $('#inMonth').on('keyup', function() {
            if ($(this).val().length == 2) {
                $('#inDay').focus();
            }
        })

        $('#btnReset').on('click', function() {
            $('#lokasi_asal').val('');
            $('#lokasi_asal').focus().triger();
            $('#item_code').val('');
            $('#inYear').val('');
            $('#inMonth').val('');
            $('#inDay').val('');
            $('#prod_date').val('');
            $('#tf_lokasi_tujuan').val('');
        })


        $('#formSearch').on('submit', function(e) {
            e.preventDefault();
            $('#prod_date').val('');
            let prod_date = true
            if ($("#inYear").val() != '' || $('#inMonth').val() != '' || $('#inDay').val() != '') {
                prod_date = validateDate();
            }

            if (prod_date == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Prod date is not valid'
                });
                $('#prod_date').val('');
                return;
            }

            // alert('lanjutt');
            // return;
            startLoading();
            let formSearch = $(this).serialize();
            $.ajax({
                url: 'searchByLocAndItem',
                type: 'POST',
                data: formSearch,
                dataType: 'JSON',
                success: function(response) {
                    stopLoading();
                    if (response.success == true) {
                        let divToast = $('#divToast');
                        divToast.empty();
                        let divContent = $('#divItem');
                        divContent.empty();
                        divContent.html(response.content);
                        $('#cardFormTransfer').css('display', 'block');
                        $('#tf_lokasi_tujuan').val('');
                    } else {
                        let divToast = $('#divToast');
                        divToast.empty();
                        divToast.html(`<div class="card card-danger">

                                                <div class="card-body">
                                                ${response.message}
                                                </div>
                                            </div>`);
                        $('#divItem').empty();
                        $('#cardFormTransfer').css('display', 'none');
                    }
                }
            });
        })

        $('#lokasi_asal').on('focus', function() {
            $('#cardFormTransfer').css('display', 'none');
            $('#divToast').empty();
        })

        $('#formTransfer').on('submit', function(e) {
            e.preventDefault();

            if ($('#lokasi_asal').val() === $('#tf_lokasi_tujuan').val()) {
                Swal.fire({
                    icon: "error",
                    title: "Location can not be same!",
                })
                return;
            }

            Swal.fire({
                icon: "question",
                title: "Are you sure internal transfer \n from : " + $('#lokasi_asal').val() + " \n to : " + $('#tf_lokasi_tujuan').val(),
                showCancelButton: true,
                confirmButtonText: "Yes",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    startLoading();
                    let lokasi_asal = $('#tf_lokasi_asal').val();
                    let lokasi_tujuan = $('#tf_lokasi_tujuan').val();
                    let formTransfer = new FormData($(this)[0]);
                    formTransfer.append('lokasi_asal', $('#lokasi_asal').val());
                    formTransfer.append('item_code', $('#item_code').val());
                    formTransfer.append('prod_date', $('#prod_date').val());

                    if (lokasi_asal != lokasi_tujuan) {
                        $.ajax({
                            url: 'prosesTransfer',
                            type: 'POST',
                            data: formTransfer,
                            processData: false,
                            contentType: false,
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
                                    $('#cardFormTransfer').css('display', 'none');
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
                                    $('#cardFormTransfer').css('display', 'none');
                                }
                            }
                        });
                    } else {
                        alert('lokasi tidak boleh sama');
                    }
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })

        function validateDate() {
            var year = $('#inYear').val();
            var month = $('#inMonth').val();
            var day = $('#inDay').val();

            var dateString = year + '-' + month + '-' + day;

            console.log(dateString);
            var dateObject = new Date(dateString);

            if (dateObject == 'Invalid Date' || month > 12 || day > 31) {
                return false;
            } else {
                $('#prod_date').val(dateString);
                return true;
            }
        }
    });
</script>


@endsection