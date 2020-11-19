<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Order;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        logger($request);
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

    //todo
    //1) append imageable_id & imageable_type
    // 2) append csrf token, then pindah balik url image store ke web
    //3) bootstrap theeming //
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
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
        $order = $image->imageable;
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
