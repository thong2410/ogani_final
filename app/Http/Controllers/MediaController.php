<?php

namespace App\Http\Controllers;

use App\Media;
use File;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = Media::orderBy('id','DESC')->get();

        return Response::json($get, 200);
    }


    public function uploadProduct(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $files = $request->file('file');
                $destinationPath = 'uploads/'.sha1(time());
                $upload_success = false;
                foreach ($files as $fileKey => $file) {
                    //$destinationPath = 'uploads';
                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        //$filename = sha1(time().time()).".{$extension}";
                        $filename = time() . $file->getClientOriginalName();
                        $file->move($destinationPath, $filename);
                        $upload_success = true;
                        // add to db
                        Media::create([
                            'path' => $destinationPath,
                            'name' => $filename
                        ]);
                    }
                }
                if ($upload_success) {
                    return Response::json('success', 200);
                } else {
                    return Response::json('error', 400);
                }
            }
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
