<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateImage();

        $image = new Image;

        if (request()->hasFile('file')) {
            $image->fill([
                'imageable_id' => $request->imageable_id,
                'imageable_type' => $request->imageable_type,
                'file' => request()->file->store('uploads', 'public'),
            ]);
        }

        $image->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
    }

    public function validateImage()
    {
        $validateData = request()->validate([]);

        if (request()->has('image')) {
            request()->validate([
                'image' => 'file | image',
            ]);
        }
        return $validateData;
    }
}
