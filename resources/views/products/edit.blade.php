@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product
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
                   {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch']) !!}

                        @include('products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
