{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('products.show', $id) }}" class='btn btn-info btn-xs'>
        <i class="fa fa-info"></i>
    </a>
    <a href="{{ route('products.edit', $id) }}" class='btn btn-warning btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}

</div>

<div class='btn-group'>

    <a href="{{ route('stock-movements.create', [config('stock.fk_placed'), $id]) }}" class='btn btn-success btn-xs'>
        <i class="fa fa-plus"></i>
    </a>

    @if($model->availableAmount()>0)
        <a href="{{ route('stock-movements.create', [config('stock.fk_removed'), $id]) }}" class='btn btn-danger btn-xs'>
            <i class="fa fa-minus"></i>
        </a>
    @endif



</div>

{!! Form::close() !!}
