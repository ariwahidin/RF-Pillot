<div class="card">
    <div class="card-header">
        <span>Item Found : {{ count($item)}}</span>
    </div>
    <div class="card-body scrollable-card">
        @foreach($item as $data)
        <div class="info-box bg-success">
            <div style="font-size: 12px;" class="info-box-content d-flex">
                <span class="info-box-text">Item Code &nbsp;: <span>{{ $data->item_code }}</span></span>
                <span class="info-box-text">Prod Date &nbsp; : <span>{{ $data->expire }}</span></span>
                <span class="info-box-text">Status QA &nbsp; : <span>{{ $data->qastatus }}</span></span>
                <span class="info-box-text">Qty Avail &nbsp; &nbsp; &nbsp;: <span>{{ $data->qty_avail }}</span></span>
            </div>
        </div>
        @endforeach
    </div>
</div>