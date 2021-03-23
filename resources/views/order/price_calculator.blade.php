<div class ="col-md-4 mx-4 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Calculate Size</h4>
        </div>
        <div class="card-body">

            <div class="field">
                <label class="label" for="material">Material</label>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <select id="type_material" name="type_material" onblur="calculate()"
                            class="form-control">
                            <option value="">--SELECT MATERIAL--</option>
                            @foreach (App\Order::MATERIALS as $type_material)
                                <option value="{{ $type_material }}">{{ $type_material }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="walk_in" name="walk_in" onblur="calculate()" value="true">
                <label class="form-check-label" for="walk_in">Walk In Customer</label>
            </div>

            <div class="field">
                <label class="label" for="cal_length">Actual length (ft) </label>
                <div class="form-group row">
                    <div class="col-auto">
                        <input class="form-control "
                            type="number" name="cal_length" id="cal_length"
                            value="{{ old('cal_length') ?? ($order ?? ''->cal_length ?? '') }}"
                            placeholder="Length"
                            onblur="calculate()" >
                    </div>
                </div>
            </div>


            <div class="field">
                <label class="label" for="cal_width">Actual width (ft) </label>
                <div class="form-group row">
                    <div class="col-auto">
                        <input class="form-control "
                            type="number" name="cal_width" id="cal_width"
                            value="{{ old('cal_width') ?? ($order ?? ''->cal_width ?? '') }}"
                            placeholder=" Width"
                            onblur="calculate()" >
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label" for="total_length">Total Size(ft)</label>
                <p id="total_length"></p>
                <p id="actual_size"></p>
                <p id="act_price"></p>
            </div>
        </div>
    </div>
</div>
