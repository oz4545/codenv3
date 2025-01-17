@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $form->nombre }}</div>
                <div class="card-body">
                    <h2>{{ $question->nombre_pregunta }}</h2>
                    <p>{{ $question->descripcion }}</p>
                    <form action="{{ route('quiz.validate', ['formId' => $form->id, 'questionId' => $question->id]) }}" method="POST">
                        @csrf
                        @if($question->type == 'unica_respuesta')
                            @foreach($answers as $answer)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer" value="{{ $answer->id }}" id="answer{{ $answer->id }}">
                                    <label class="form-check-label" for="answer{{ $answer->id }}">
                                        {{ $answer->nombre }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                    </form>
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
