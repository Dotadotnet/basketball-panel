<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Hashids\Hashids;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function view($id)
    {
        $hash = new Hashids();
        $files = new Files();
        $files = $files->find($hash->decode($id)[0]);

        $f = Storage::exists($files->file_address);

        
        if($f){
            $f = Storage::get($files->file_address);
        }else{
            $f = Storage::disk('s3')->get($files->file_address);
        }

        $response = Response::make($f, 200);
        $response->header('Content-Type', $files->mime_type);

        return $response;
    }
}
