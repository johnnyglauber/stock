{{--{{ dd($stockMovementTypes) }}--}}

<!-- Stock Movement Type Field -->
<div class="form-group col-sm-12">
    <label for="stock-movement-type-id">Stock Movement Type</label>
    <select name="stock_movement_type_id" id="stock-movement-type-id" class="form-control">
        <option value="">Select</option>
        @if(!empty($stockMovementTypes))
            @foreach($stockMovementTypes as $stockMovementType)
                <option value="{{ $stockMovementType->id }}"
                        @if( (!empty($stockMovement) && $stockMovement->stock_movement_type_id == $stockMovementType->id) || old('stock_movement_type_id') == $stockMovementType->id || $stockMovementTypes->count() == 1 ) selected @endif
                >{{ $stockMovementType->name }}</option>
            @endforeach
        @else
        @endif
    </select>
</div>

<!-- Product Field -->
<div class="form-group col-sm-12">
    <label for="product-id">Product</label>
    <select name="product_id" id="product-id" class="form-control">
        <option value="">Select</option>
        @if(!empty($products))
            @foreach($products as $product)
                <option value="{{ $product->id }}"
                        @if( (!empty($stockMovement) && $stockMovement->product_id == $product->id) || old('product_id') == $product->id || $products->count() == 1  ) selected @endif
                >{{ $product->name }} (SKU=>{{ $product->code }})</option>
            @endforeach
        @else
        @endif
    </select>
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('stock-movements.index') }}" class="btn btn-default">Cancel</a>
</div>
