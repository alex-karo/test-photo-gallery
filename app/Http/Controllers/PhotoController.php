<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class PhotoController extends Controller
{
    /**
     * Display a listing of the photo
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome')->with('photos', Photo::all()->take(9));
    }

    /**
     * Display a listing of the photo with offset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMore(Request $request)
    {
        return response(Photo::skip($request->offset)->take(9)->get());
    }

    /**
     * Display a random photo
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        return response(Photo::inRandomOrder()->first());
    }

    /**
     * Store a newly created photo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagesFolder = '/img/catalog';
        $imagePath = public_path() . $imagesFolder;
        $extension = $request->file('file')->getClientOriginalExtension();
        $newFileName = uniqid() . '.' . $extension;
        // TODO: Проверка на то, уникально ли наше имя
        $request->file('file')->move($imagePath, $newFileName);
        $newPhoto = new Photo();
        $newPhoto->title = $request->title;
        $newPhoto->file = "$imagesFolder/$newFileName";
        $newPhoto->save();
        return response($newPhoto);
    }
}
