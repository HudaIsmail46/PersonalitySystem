<h4>Item</h4>
<div class="field">
    <div class="table-responsive">
        <table class="table table-bordered w-100">
            <tr class="table-active">
                <th>No</th>
                <th>Item</th>
                <th>Delete Item (&#x2714) </th>
            </tr>
            @foreach ($order->orderItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="field">
                            <div class="form-group row ">
                                <div class="col">
                                    <label for="material[]">Material</label>
                                    <input type="hidden" name="item_id[]"
                                        value="{{ $item->id }}">
                                    <select id="material" name="material[]"
                                        class="custom-select @error('material') is-invalid @enderror">
                                        <option value="">--SELECT MATERIAL--</option>
                                        @foreach (App\Order::MATERIALS as $material)
                                            <option value="{{ $material }}"
                                                {{ $item->material == $material ? 'selected' : '' }}>
                                                {{ $material }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('material') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                        <div class="field">
                            <div class="form-group row ">
                                <div class="col">
                                    <label for="size[]">Size</label>
                                    <select id="size" name="size[]"
                                        class="custom-select @error('size') is-invalid @enderror">
                                        <option value="">--SELECT SIZE--</option>
                                        @foreach (App\Order::SIZES as $size)
                                            <option value="{{ $size }}"
                                                {{ $item->size == $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('size') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="form-group row ">
                                <div class="col">
                                    <label for="quantity_item[]">Quantity</label>
                                    <input
                                        class="form-control @error('quantity_item') is-invalid @enderror"
                                        type="number" name="quantity_item[]" id="quantity_item"
                                        value="{{ old('quantity_item') ?? ($item->quantity ?? '') }}"
                                        placeholder=" Quantity">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('quantity_item') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="form-group row ">
                                <div class="col">
                                    <label for="price_item[]">Price(RM)</label>
                                    <input
                                        class="form-control @error('price_item') is-invalid @enderror"
                                        type="number" name="price_item[]" id="price_item"
                                        value="{{ (float) (old('price_item') ?? ($item->price / 100 ?? 0)) }}" />
                                    <div class="invalid-feedback">
                                        {{ $errors->first('price_item') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="checkbox mt-2">
                            <input type="checkbox" name='delete[]' value='{{ $item->id }}'>
                            <label for="delete[]"><span class="text-danger">Delete</span></label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</div>
<p class="small text-muted float-right">*Checked item will be removed.</p>
<div id="AddItem" data-materials="{{ json_encode(App\Order::MATERIALS) }}"
    data-sizes="{{ json_encode(App\Order::SIZES) }}"></div>