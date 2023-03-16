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
     * Display a listing of the resource.
     *
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
     *
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $quiz = Quiz::find($id);
            return $this->sendResponse($quiz, 'Quiz create successfully.');
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
     *
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
