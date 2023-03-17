<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuestionResponce;

class CheckIsCreate {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, string $type) {
      $tbUrl = explode("/", $request->url());
      $id = explode("/", $request->url())[count($tbUrl)-1];
    if($type === 'quiz'){
        $Quiz = Quiz::find($id);
        if($Quiz->user_id !== Auth::user()->id)
            return response()->json(['error' => 'you didn\'t have the authorization ', 'statusText' => 'failed'], 404);
    }
    if($type === 'question'){
        if($request['quiz_id']){
            $Quiz = Quiz::find($request['quiz_id']);
            if($Quiz->user_id !== Auth::user()->id)
                return response()->json(['error' => 'you didn\'t have the authorization ', 'statusText' => 'failed'], 404);
        }else{
            $QuizQuestion = QuizQuestion::find($id);
            $quiz = $QuizQuestion->getQuiz()->first();
            if($quiz->user_id !== Auth::user()->id)
                return response()->json(['error' => 'you didn\'t have the authorization ', 'statusText' => 'failed'], 404);
        }

    }
    if($type === 'questionResponce'){
        if($request['question_id']){
            $QuizQuestion = QuizQuestion::find($request['question_id']);
                $quiz  = $QuizQuestion->getQuiz()->first();
            if($quiz->user_id !== Auth::user()->id)
                return response()->json(['error' => 'you didn\'t have the authorization ', 'statusText' => 'failed'], 404);
        }else{
            $QuestionResponce = QuestionResponce::find($id);
            $QuizQuestion = $QuestionResponce->getQuestion()->first();
            $quiz = $QuizQuestion->getQuiz()->first();
            if($quiz->user_id !== Auth::user()->id)
                return response()->json(['error' => 'you didn\'t have the authorization ', 'statusText' => 'failed'], 404);
        }

    }
    return $next($request);
    // return;

  }
}
