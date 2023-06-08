<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_process{{$pf->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ __('trans_fee.delete fee processing') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('processingFees.destroy', $pf->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('trans_fee.delete sure') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_student.close')}}</button>
                        <button  class="btn btn-danger">{{trans('trans_student.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
