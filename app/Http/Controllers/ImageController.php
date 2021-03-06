<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as Img;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $img = Img::all();
        return view('images.gallery', compact('img'));
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
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
        ]);

        $name = $request->file('file')->getClientOriginalName();
        $directory = storage_path() . '\app\public\images/';
        $new_name = Str::random(20);
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        $pick = storage_path() . '\app\public\images/'.$new_name.'.'.$ext;

        $image = Image::make($request->file('file'))
                        ->resize(500, null, function($constrains){
                            $constrains->aspectRatio();
                        })
                        ->save($pick);
        $save_image_db = Img::create([
            'url' => $new_name. '.' . $ext
        ]);
    }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
