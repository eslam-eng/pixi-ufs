<!-- Vertically centered modal -->
<div class="modal fade" id="print_awbs_modal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo modal-xl">
            <div class="modal-header">
                <h6 class="modal-title">Print Type</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <form action="{{route('awbs-print3*1')}}" method="post" id="default_print_awbs">
                            @csrf
                            <input type="hidden" value="" name="ids" id="awbs_ids">
                            <button type="submit" class="btn btn-success mb-1 print_awbs"><i class="fa fa-print fa-2x p-2"></i><h4 class="text-dark">print 3 * 1</h4></button>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <form action="{{route('awbs-print3*1')}}" method="post" id="print_duplicate_awbs">
                            @csrf
                            <input type="hidden" value="" name="ids" id="awbs_ids_duplicate">
                            <input type="hidden" value="1" name="is_duplicated" id="is_duplicated">
                            <button type="submit" class="btn btn-success mb-1 print_duplicated"><i class="fa fa-print fa-2x p-2"></i><h4 class="text-dark">print 3 * 1 Duplicate</h4></button>
                        </form>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Vertically centered modal -->
