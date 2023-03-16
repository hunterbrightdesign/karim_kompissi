<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserQuizResponce;
use App\Models\Quiz;
use App\Http\Controllers\Api\v1\HelpController;
use App\Http\Requests\UserQuizResponceRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserQuizResponceController extends HelpController
{

    /**
     *
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserQuizResponceRequests $request)
    {
        try {
            $data = $request->validated();
            $UserQuizResponce = UserQuizResponce::where('user_id',Auth::user()->id)->where('quiz_questions_id',$data['quiz_questions_id'])->get();
            if(count($UserQuizResponce))
                return $this->sendError('you had already answered this question', $UserQuizResponce, 403);
            $data['user_id'] = Auth::user()->id;
            $UserQuizResponce = UserQuizResponce::create($data);
            return $this->sendResponse($UserQuizResponce, 'Quiz responce create successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function UserQuizResponc(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(), [
                  'quiz_id' => 'required|exists:quizzes,id',
                  'user_id' => 'required|exists:users,id',
                ]
              );

            if ($validateUser->fails()) {
            return $this->sendError('Vlidation error: '. $validateUser->errors(), 401);
            }

            $Quiz = Quiz::find($request['quiz_id']);
            $Questions = $Quiz->getQuestion()->get();

            $res = $Questions->map(function($question, $key) use($request) {
                $UserResponce = $question->getUserResponce()->where('user_id',$request['user_id'])->first();
                $question['userReponce'] = $UserResponce;
                if($UserResponce)
                    $question['responceValide'] = $UserResponce->getResponceUser()->first()->status === 1 ? true : false;
                return $question;
            });

            return $this->sendResponse($res, 'user Quiz responce list successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to update this/these item(s)', $th, 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserQuizResponceRequests $request, $id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::user()->id;
            $UserQuizResponce = UserQuizResponce::find($id);
            $UserQuizResponce->update($data);
            return $this->sendResponse($UserQuizResponce, 'Quiz responce update successfully.');

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
            $UserQuizResponce = UserQuizResponce::find($id);
            $UserQuizResponce->delete();
            return $this->sendResponse($UserQuizResponce, 'Quiz responce delete successfully.');

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to delete this/these item(s)', $th, 403);
        }
    }
}
