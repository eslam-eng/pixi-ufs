<div>
    <div class="main-content-label mg-b-5">@lang('app.shipment_type')</div>
    <select class="form-select form-control"
            id="shipment_type_id" name="{{$field_name}}"
            aria-label="Select shipment type">
        @foreach($shipment_types as $shipment_type)
            <option value="{{$shipment_type->id}}"
                    @if(!is_null($selected_shipment_type) && ($shipment_type->id == $selected_shipment_type)) selected @endif
            >{{$shipment_type->name}}</option>
        @endforeach
    </select>

</div>
