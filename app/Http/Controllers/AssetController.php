<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index(\App\Models\Application $application)
    {
        return $application->assets()->get();
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

    public function store(Request $request)
    {
        if (!$request->file('file')) {
            return response('error uploading file', 400);
        }

        $file =$request->file('file');
        $generatedFileName = Str::random(16);
        $mimes = new \Mimey\MimeTypes;

        $mimeType= $mimes->getExtension($file->getMimeType());

        $file->move(public_path('images'),$generatedFileName.'.'.$mimeType);
        
        // $size = getimagesize(public_path('images').$generatedFileName.'.'.$mimeType);
        // $width = $size[0];
        // $height = $size[1];
        $result = array(
            'name' => $generatedFileName.'.'.$mimeType,
            'type' => 'image',
            'src' => env('APP_IMAGE_URL').'/images/'.$generatedFileName.'.'.$mimeType,
            'height' => 350,
            'width' => 200
        );
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }
}