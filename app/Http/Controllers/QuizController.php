<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserAnswers;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function showQuestion($formId, $questionId)
    {
        $form = Form::findOrFail($formId);
        $question = Question::where('formulario', $formId)->findOrFail($questionId);
        $answers = Answer::where('pregunta_id', $question->id)->get();

        return view('quiz.question', compact('form', 'question', 'answers'));
    }

    public function validateAnswer(Request $request, $questionId)
    {
        $formId = 1; // ID del formulario fijo
        $question = Question::where('formulario', $formId)->findOrFail($questionId);
        $correctAnswers = Answer::where('pregunta_id', $question->id)->where('respuesta', true)->pluck('id')->toArray();

        if ($question->type == 'unica_respuesta') {
            if (in_array($request->input('answer'), $correctAnswers)) {
                // Guardar respuesta del usuario
                UserAnswers::create([
                    'usuario_id' => Auth::id(),
                    'pregunta_id' => $question->id,
                    'respuesta_id' => $request->input('answer'),
                ]);

                $question->completado = true;
                $question->save();
                return $this->nextQuestionOrCompleted($formId, $questionId);
            } else {
                return back()->with('error', 'Respuesta incorrecta. Inténtalo de nuevo.');
            }
        }
    }

    public function nextQuestionOrCompleted($formId, $currentQuestionId)
    {
        $nextQuestion = Question::where('formulario', $formId)
            ->where('id', '>', $currentQuestionId)
            ->orderBy('id')
            ->first();

        if ($nextQuestion) {
            return redirect()->route('quiz.show', ['questionId' => $nextQuestion->id]);
        } else {
            $form = Form::findOrFail($formId);
            $form->completado = true;
            $form->save();

            return redirect()->route('quiz.completed');
        }
    }

    public function completed()
    {
        $formId = 1; // ID del formulario fijo
        $form = Form::findOrFail($formId);
        return view('quiz.completed', compact('form'));
    }
}
