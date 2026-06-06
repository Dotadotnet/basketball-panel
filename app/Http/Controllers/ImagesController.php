<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function view($id)
    {
        $hash = new Hashids();
        $files = new Files();
        $files = $files->find($hash->decode($id)[0]);
        $f = Storage::disk('parspack')->get(str_replace("user/","",$files->file_address));
        $response = Response::make($f, 200);
        $response->header('Content-Type', $files->mime_type);
        return $response;
    }
}
