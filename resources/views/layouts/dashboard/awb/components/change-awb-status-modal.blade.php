<!-- Basic modal -->
<div class="modal fade" id="changeAwbsStatus">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-body">
                <h6>Awb Statues</h6>
                <!-- Select2 -->
                <select id="awb_status" class="form-control">
                    <option label="Choose one"></option>
                    @foreach($awb_statuses as $statues)
                        <option value="{{$statues->id}}">
                            {{$statues->name}}
                        </option>
                    @endforeach
                </select>
                <!-- Select2 -->
                <p class="mt-3">please select statues</p>
            </div>
            <div class="modal-footer">
                <button data-url="{{route('awbs-change-status')}}" data-csrf="{{csrf_token()}}" data-reload="false" class="btn ripple btn-primary" id="change_awb_status" type="button">Save changes</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
