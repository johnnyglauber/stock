@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Data Source
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
                    {!! Form::open(['route' => 'data-sources.store']) !!}

                        @include('data_sources.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection




