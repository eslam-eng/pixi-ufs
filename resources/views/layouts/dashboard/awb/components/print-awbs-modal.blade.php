<!-- Vertically centered modal -->
<div class="modal fade" id="print_awbs_modal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo modal-xl">
            <div class="modal-header">
                <h6 class="modal-title">Print Type</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <button  data-url="{{route('awbs-print3*1')}}" data-awbs_duplicated="0" data-csrf="{{csrf_token()}}" type="button" class="btn btn-success mb-1 print_awbs"><i class="fa fa-print fa-2x p-2"></i><h4 class="text-dark">print 3 * 1</h4></button>

                <button data-url="{{route('awbs-print3*1')}}" data-awbs_duplicated="1" data-csrf="{{csrf_token()}}" type="button" class="btn btn-info mb-1 print_awbs"><i class="fa fa-print fa-2x p-2"></i> <h4 class="text-dark">print 3 * 1 Duplicate</h4></button>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Vertically centered modal -->
