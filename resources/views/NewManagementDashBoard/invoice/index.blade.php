@extends('layouts.NewManage')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> invoices </h4>
        </div>
    </div>
</div>
<invoice-table-component ></invoice-table-component>
@endsection
