<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Picture;
use Intervention\Image\Facades\Image;

class PictureController extends Controller
{
    /**
     * Display a listing of all submitted dogs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Picture::all();

        return view('index', ['pictures' => $pictures]);
    }

    /**
     * Show the form for uploading a new dog.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Handle the form submission and save the uploaded dog
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'name'    => 'required'
        ]);

        $image = $request->file('image');

        if (isset($image)) {
            
            $imageName = $image->hashName();

            $width = 286;
            $height = null;
            $img = Image::make($image);
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img = $img->save(public_path('storage/' . $imageName));
            
        }


        $model = new Picture();
        if($imageName){
            $model->file_path = $imageName;
        }
        $model->name = $request->name;

        $model->save();

        return redirect()->route('home')->with('message', 'Dog added successfully!');

    }

    /**
     * Upvote a dog by ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upvote(Request $request, Picture $picture)
    {
        $picture = Picture::find($request->picture_id);
        $picture -> votes = $picture->votes + 1;
        $picture->save();
        
        return redirect()->route('home')->with('message', 'Dog voted!');
    }
}
