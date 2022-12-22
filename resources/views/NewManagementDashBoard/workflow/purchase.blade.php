@extends('layouts.NewManage')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">WorkFlow</h4>
        </div>
    </div>
</div>
<workflow-purchase-manager  :role="{{$role}}" :workflow="{{$workflow}}" ></workflow-purchase-manager>
@endsection
