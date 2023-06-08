<!-- Deleted inFormation Student -->
<div class="modal fade" id="return_student{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('trans_student.return student') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('graduated.update', $student->id)}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('trans_student.are you sure previous student') }}</h5>
                    <input type="text" readonly value="{{$student->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_student.close')}}</button>
                        <button  class="btn btn-danger">{{trans('trans_student.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
