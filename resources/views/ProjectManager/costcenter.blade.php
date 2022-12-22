@extends('layouts.NewApp')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">cost center</h4>
        </div>
    </div>
</div>

<report-component project="{{auth()->user()->projectmanager->id}}"  ></report-component>

@endsection
