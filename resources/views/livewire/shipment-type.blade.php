<div>
    <label class="form-label">@lang('app.shipment_type')</label>
    <select class="form-select form-control"
            id="shipment_type_id" name="{{$field_name}}"
            aria-label="Select shipment type">
        @foreach($shipment_types as $shipment_type)
            <option value="{{$shipment_type->id}}" data-has_dimension="{{$shipment_type->has_dimension}}"
                    @if(!is_null($selected_shipment_type) && ($shipment_type->id == $selected_shipment_type)) selected @endif
            >{{$shipment_type->name}}</option>
        @endforeach
    </select>
</div>
