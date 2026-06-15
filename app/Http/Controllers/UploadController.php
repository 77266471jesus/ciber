<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if($request->hasFile(key: 'avatar')){
            $file = $request->file(key: 'avatar');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            // $file->storeAs(path: 'avatars/tmp' . $folder, $filename);

            return $folder;
        }
        return '';
    }
}
