<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionResponce;
use App\Http\Controllers\Api\v1\HelpController;
use App\Http\Requests\QuestionResponcesRequests;
use Illuminate\Support\Facades\Auth;

class QuestionResponcesController extends HelpController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $QuestionResponces = QuestionResponce::all();
        return $this->sendResponse($QuestionResponces, 'Question Responces list successfully.');
        try {

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
    public function store(QuestionResponcesRequests $request)
    {
        $data = $request->validated();
        $QuestionResponces = QuestionResponce::create($data);
        return $this->sendResponse($QuestionResponces, 'Question Responces create successfully.');
        try {

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
        $QuestionResponces = QuestionResponce::find($id);
        return $this->sendResponse($QuestionResponces, 'Question Responces list successfully.');
        try {

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
    public function update(QuestionResponcesRequests $request, $id)
    {
        $data = $request->validated();
        $QuestionResponces = QuestionResponce::find($id);
        $QuestionResponces->update($data);
        return $this->sendResponse($QuestionResponces, 'Question Responces update successfully.');
        try {

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
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
        $QuestionResponces = QuestionResponce::find($id);
        $QuestionResponces->delete();
        return $this->sendResponse($QuestionResponces, 'Question Responces delete successfully.');
        try {

        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }
}
