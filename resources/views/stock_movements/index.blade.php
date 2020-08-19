@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Stock Movements</h1>
        <h1 class="pull-right">

            <a class="btn btn-danger pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('stock-movements.create', 2) }}">Remove from Stock</a>
            <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('stock-movements.create', 1) }}">Place in Stock</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('stock_movements.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
