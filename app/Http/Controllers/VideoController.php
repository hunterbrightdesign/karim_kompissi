<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VideoRequests;
use App\Model\Videos;
use App\Http\Controllers\HelpController;

class VideoController extends HelpController
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
    public function store(VideoRequests $request)
    {
         try {
            $data = $request->validated();
            $video = Videos::create($data);
            return $this.sendResponse($video, 'Video create successfully.');
        } catch (\Throwable $th) {
            report($th);
            $response = [
                'statusText' => 'success',
                'data'    => $th,
                'message' => "Unable to insert this/these item(s)",
            ];
            return response()->json($response, 403);
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
