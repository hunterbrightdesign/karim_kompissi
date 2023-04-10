<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequests;
use App\Model\Post;
use Intervention\Image\Facades\Image as Image;
use App\Http\Controllers\HelpController;

class PostController extends HelpController
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
    public function store(PostRequests $request)
    {
        // try {
            $data = $request->validated();
            return $this.sendResponse($data, 'Post create successfully.');
            $lowerTitel = strtolower($data['titel']);
            $slug = str_replace(' ','_',$lowerTitel);
            $data['slug'] = $slug;

            if ($request->hasFile('image')) {
                try {
                    $img = $request->file('image');
                    $file_name = $this->parseFilename($slug). '-' .$img->getClientOriginalExtension();
                    $location = public_path('images/post/' . $file_name);

                    $data['image'] = $location;
                    Image::make($img)->save($location);
                } catch (\Throwable $e) {
                    report($e);
                    return $this->sendErrorWithData('Unable to handle image uploading', $e, 500);
                }
            }


            $post = Post::create($data);
            return $this.sendResponse($post, 'Post create successfully.');
        // } catch (\Throwable $th) {
        //     report($th);
        //     return $this->sendError('Unable to insert this/these item(s)', $th, 403);
        // }
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
