<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LikesRequests;
use App\Http\Requests\LikesVideoRequests;
use App\Model\Likes;
use App\Http\Controllers\HelpController;

class LikesController extends HelpController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LikesRequests $request)
    {
        try {
            $data = $request->validated();
            $like = Likes::create($data);
            return $this.sendResponse($post, 'Like post create successfully.');
        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }


    public function likeVideo(LikesVideoRequests $request)
    {
        try {
            $data = $request->validated();
            $like = Likes::create($data);
            return $this.sendResponse($post, 'Like video create successfully.');
        } catch (\Throwable $th) {
            report($th);
            return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
