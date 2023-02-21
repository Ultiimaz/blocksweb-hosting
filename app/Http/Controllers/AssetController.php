<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index($workspace)
    {
        $workspace = DB::table('Workspace')->where('id', $workspace)->get()->first();
        if (!$workspace) {
            abort(404);
        }
        $assets = DB::table('Asset')->where('workspace_id', $workspace->id)->get();

        return $assets;
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

    public function store($workspace, Request $request)
    {
        $request->validate([
            // image of max 12mb
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);


        $path = Storage::disk('do-spaces')->put('images', $request->file, 'public');
        $path = Storage::disk('do-spaces')->url($path);
        $path = str_replace("https://blocksweb-cms.fra1.digitaloceanspaces.com/", "https://content.blocksweb.cloud/", $path);

        /* Store $imageName name in DATABASE from HERE */
        $result = array(
            'type' => 'image',
            'src' => $path
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
