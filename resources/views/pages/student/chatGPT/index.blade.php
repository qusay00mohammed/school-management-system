
@extends('layouts.master')
@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}

@endsection

@section('title')
  {{ trans('trans_dashboard.my questions') }}
@stop

@section('PageTitle')
    {{ trans('trans_dashboard.my questions') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('trans_dashboard.my questions') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ __('trans_main.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('trans_dashboard.my questions') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

<style>
    .bg-green {
        background-color: #bbf7d0;
        margin-bottom: 15px;
    }
    .bg-blue {
        background-color: #bfdbfe;
    }

    form {
        padding: 4px;
    }

    .rounded-md {
        border: none;
        outline: none;
        display: inline-block;
        width: 100%;
        margin-bottom: 7px;
    }

</style>


<div class="antialiased">
    <div class="flex flex-col space-y-4 p-4">
    @foreach($messages as $message)
        <div class="flex rounded-lg p-4 @if ($message['role'] === 'assistant') bg-green flex-reverse @else bg-blue @endif ">
            <div class="ml-4">
                <div class="text-lg">
                    @if ($message['role'] === 'assistant')
                        <a href="#" class="font-medium text-gray-900">ChatGPT</a>
                    @else
                        <a href="#" class="font-medium text-gray-900">{{ __('trans_main.you') }} :</a>
                    @endif
                </div>
                <div class="mt-1">
                    <p class="text-gray-600">
                        {!! \Illuminate\Mail\Markdown::parse($message['content']) !!}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <form class="p-4 flex space-x-4 justify-center items-center" action="{{ route('student.questions.store') }}" method="post">
        @csrf
        <label for="message">{{ __('trans_main.what is your question') }} :</label>
        <input id="message" type="text" name="message" autocomplete="off" class="border  rounded-md  p-2 flex-1" />
        <input type="submit" value="{{ __("trans_main.send") }}" class="btn btn-info">
        <a class="btn btn-primary" href="{{ route('student.questions.reset') }}">{{ __("trans_main.reset conversation") }}</a>
    </form>
</div>


@endsection
