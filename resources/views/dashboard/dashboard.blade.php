@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col col-md-12">
        <h1>Selamat datang, {{ Auth::user()->name }}</h1>
    </div>
</div>
@endsection