<div>
    <button type="button" wire:click="setDefault" class="btn btn-sm btn-success">@lang('app.make_address_default')</button>
</div>
@section('scripts')
    <script>
        window.addEventListener('swal:confirm-change-status', event => {
            swal({
                title: "{{__('lang.are_you_sure')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    window.livewire.emit('changeShipmentStatus', event.detail.component_id);
                }
            });
        });
    </script>
@endsection
