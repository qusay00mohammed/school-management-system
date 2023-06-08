@extends('layouts.master')
@section('css')
@livewireStyles;
@section('title')
إجراء اختبار
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        إجراء اختبار
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('question.show', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
@livewireScripts;
@endsection
