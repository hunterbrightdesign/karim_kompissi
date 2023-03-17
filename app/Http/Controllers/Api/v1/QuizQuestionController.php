<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Http\Controllers\Api\v1\HelpController;
use App\Http\Requests\QuizQuestionRequests;
use Illuminate\Support\Facades\Auth;

class QuizQuestionController extends HelpController
{
    /**
   * Controller General Constructor
   *
   * @author Fokoui Marco <hunterbrightdesign@gmail.com>
   * @return void
   */
  public function __construct() {
    $this->middleware('CheckIsCreate:question')->except('index', 'show');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $QuizQuestion = QuizQuestion::all();
            return $this->sendResponse($QuizQuestion, 'Quiz question list successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizQuestionRequests $request)
    {
        try {
            $data = $request->validated();
            $QuizQuestion = QuizQuestion::create($data);
            return $this->sendResponse($QuizQuestion, 'Quiz question create successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $QuizQuestion = QuizQuestion::find($id);
            return $this->sendResponse($QuizQuestion, 'Quiz question list successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizQuestionRequests $request, $id)
    {
        try {
            $data = $request->validated();
            $QuizQuestion = QuizQuestion::find($id);
            $QuizQuestion->update($data);
            return $this->sendResponse($QuizQuestion, 'Quiz question update successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to update this/these item(s)', $th, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $QuizQuestion = QuizQuestion::find($id);
            $QuizQuestion->delete();
            return $this->sendResponse($QuizQuestion, 'Quiz question delete successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to delete this/these item(s)', $th, 403);
        }
    }
}
