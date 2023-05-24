<div>
    <div class="main-content-label mg-b-5">@lang('app.'.$payment_type_title)</div>
    <select class="form-select form-control"
            id="payment_type" name="{{$payment_type_field_name}}"
            aria-label="Select payment type">
        @foreach($options as $key=>$value)
            <option value="{{$value}}"
                    @if(!is_null($selected) && ($value == $selected)) selected @endif
            >{{$key}}</option>
        @endforeach
    </select>

</div>
