<div>
    <div class="main-content-label mg-b-5">@lang('app.shipment_type')</div>
    <select class="form-select form-control"
            id="shipment_type_id" name="shipment_type_id"
            aria-label="Select shipment type">
        @foreach($shipment_types as $shipment_type)
            <option value="{{$shipment_type->id}}"
                    @if(!is_null($selected) && ($shipment_type->id == $selected)) selected @endif
            >{{$shipment_type->name}}</option>
        @endforeach
    </select>

</div>
