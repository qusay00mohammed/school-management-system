
<div>
    <div class="card card-statistics mb-30">
        <div class="card-body">
            <h5 class="card-title"> {{$data[$counter]->title}}</h5>

            @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index=>$answer)
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input" inh>
                    <label class="custom-control-label" for="customRadio{{$index}}" wire:click="nextQuestion({{$data[$counter]->id}}, {{$data[$counter]->score}}, '{{$answer}}', '{{$data[$counter]->right_answer}}')"> {{$answer}}</label>
                    {{-- <h1>{{ $data[$counter]->id }}</h1>
                    <h1>{{ $data[$counter]->score }}</h1>
                    <h1>{{ $data[$counter]->answer }}</h1>
                    <h1>{{ $data[$counter]->right_answer }}</h1>
                    <h1>{{ $answer }}</h1> --}}
                </div>
            @endforeach

        </div>
    </div>
</div>

