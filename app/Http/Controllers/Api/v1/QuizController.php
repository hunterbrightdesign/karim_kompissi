<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Controllers\Api\v1\HelpController;
use App\Http\Requests\QuizRequests;
use Illuminate\Support\Facades\Auth;

class QuizController extends HelpController
{
    /**
   * Controller General Constructor
   *
   * @author Fokoui Marco <hunterbrightdesign@gmail.com>
   * @return void
   */
  public function __construct() {
    $this->middleware('CheckIsCreate:quiz')->except('index', 'show', 'store');
  }

    /**
     * Display a listing of the resource.
    * @author Fokoui Marco <hunterbrightdesign@gmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $quiz = Quiz::all();
            return $this->sendResponse($quiz, 'Quiz list successfully.');
        } catch (\Throwable $th) {
            report($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @author Fokoui Marco <hunterbrightdesign@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequests $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;
            $quiz = Quiz::create($data);
            return $this->sendResponse($quiz, 'Quiz create successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }

    }

    /**
     * Display the specified resource.
     * @author Fokoui Marco <hunterbrightdesign@gmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $quiz = Quiz::find($id);
            $questions = $quiz->getQuestion()->get();
            $questionResponce = $questions->map(function ($question , $key){
                $question['responce'] = $question->getResponce()->get();
                return $question;
            });
            $quiz['question'] = $questionResponce;
            return $this->sendResponse($quiz, 'Quiz create successfully.');
        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Update the specified resource in storage.
     * @author Fokoui Marco <hunterbrightdesign@gmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequests $request, int $id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;
            $quiz = Quiz::find($id);
            if($quiz->user_id != Auth::user()->id)
                return $this->sendError('Unauthorised', $th, 403);
            $quiz->update($data);
            return $this->sendResponse($quiz, 'Quiz update successfully.');
        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to update this/these item(s)', $th, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @author Fokoui Marco <hunterbrightdesign@gmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $quiz = Quiz::find($id);
            if($quiz->user_id != Auth::user()->id)
                return $this->sendError('Unauthorised', $th, 403);
            $quiz->delete();
            return $this->sendResponse([], 'Quiz delete successfully.');
        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to delete this/these item(s)', $th, 403);
        }
    }
}
