<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function AddPlaylistGet()
    {
        return view('addplaylist');
    }

    public function AddPlaylistPost(Request $request)
    {
        $valid = Validator::make($request->all(), [
          'title' => 'required|max:255',
            'description' => 'required|max:10',
            'playlistimage' => 'file|required|mimes:jpg,jpeg,gif',
        ]);

    if ($valid->fails()) {
      return redirect()
                ->back()
                ->withErrors($valid)
                ->withInput();
    }

    if ($request->hasFile('playlistimage')) {
            $destinationPath = public_path('images/playlist/');
            $fileName = substr(md5(uniqid()), 0, 20) . "." . $request->playlistimage->extension(); 
            $request->playlistimage->move($destinationPath, $fileName);
        }



    }
}
