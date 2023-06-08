

<div class="modal fade" id="delete_question{{ $question->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <form action="{{route('teacher.question.destroy', $question->id)}}" method="post">
           {{csrf_field()}}
           <div class="modal-content">
               <div class="modal-header">
                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('trans_student.delete') }} {{$question->title}}</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <p> {{ trans('trans_student.delete sure') }}</p>
               </div>
               <div class="modal-footer">
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('trans_student.close') }}</button>
                       <button type="submit" class="btn btn-danger">{{ trans('trans_student.delete') }}</button>
                   </div>
               </div>
           </div>
       </form>
   </div>
</div>
