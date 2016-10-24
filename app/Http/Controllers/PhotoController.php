<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $photos = Photo::skip($request->offset)->take(9)->get();
        return response([
            'success' => true,
            'data' => $photos
        ]);
    }

    /**
     * Display a random photo
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $photo = Photo::inRandomOrder()->first();

        if (count($photo) === 0) {
            return response([
                'success' => false,
                'data' => 'Нет изображений'
            ]);
        }
        return response([
            'success' => true,
            'data' => $photo
        ]);
    }

    /**
     * Store a newly created photo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'title' => 'max:255',
            'file' => 'required|max:2000|mimetypes:image/jpg,image/jpeg,image/png,image/gif,image/webp',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false,
                'data' =>$validator->messages()
            ]);
        }

        $newPhoto = new Photo($request->toArray());

        if (!$newPhoto->save()) {
            return response(['success' => false]);
        }
        return response(['success' => true]);
    }
}
