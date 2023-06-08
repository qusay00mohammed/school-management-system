<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_meet{{$online_class->meeting_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ __('trans_student.delete') }} {{$online_class->topic}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('online_classes.destroy', $online_class->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{$online_class->meeting_id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('trans_student.delete sure') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_student.close')}}</button>
                        <button  class="btn btn-danger">{{trans('trans_student.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
