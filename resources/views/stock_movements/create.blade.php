@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Stock Movement
        </h1>
    </section>
    <div class="content">

        @if(!empty($errors))
            @if($errors->any())
                <ul class="alert alert-danger" style="list-style-type: none">
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            @endif
        @endif


        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'stock-movements.store']) !!}

                        @include('stock_movements.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection




