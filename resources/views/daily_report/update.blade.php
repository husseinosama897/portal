@extends('layouts.NewApp')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
        <h4 class="page-title"> Daily Report </h4>
        </div>
    </div>
</div>
<update-daily-report  :data="{{$data}}" ></update-daily-report>

@endsection

