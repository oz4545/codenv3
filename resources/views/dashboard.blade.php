@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>bienvenido {{ Auth::user()->name }}!</p>
    <a href="{{ route('quiz.show') }}" class="btn btn-danger">ir al formulario</a>
    <br>
</div>
@endsection
