@extends('layouts.NewApp')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">JobOffer</h4>
        </div>
    </div>
</div>
<joboffer-update-user :data="{{$data}}"></joboffer-update-user>
@endsection
