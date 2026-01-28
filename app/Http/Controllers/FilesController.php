<?php

namespace App\Http\Controllers;

use App\Models\Directories;
use App\Models\Files;
use App\Rules\AuthorizedFilesConfigurationRule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class FilesController extends Controller
{
    public function upload(): Factory|View|Application
    {
        return view('upload');
    }

    public function directories_exists()
    {
        $directories = Directories::all();
        foreach ($directories as $directory) {
            if (! Storage::exists($directory->slug)) {
                Storage::makeDirectory($directory->slug);
            }
        }
    }

    public function directory_name_get($name)
    {
        return Directories::select(['id', 'name', 'slug'])->where('name', '=', $name)->first();
    }

    /**
     * @return File ID
     *
     * @throws ValidationException
     */
    public function fileStore(Request $request, $input_name, $directory_name, $account_type)
    {
        $this->validate($request, [
            $input_name => [new AuthorizedFilesConfigurationRule()],
        ]);

        try {
            $fileInput = $request->file($input_name);
            $destinationPath = $this->directory_name_get($directory_name);
            if ($fileInput != null) {
                $megaAuth = new MegaAuthenticationController();
                $physicalPath = Storage::disk('liara')->put(path: $destinationPath->slug,contents: $fileInput);

                $files = new Files();
                $files->name = $fileInput->getClientOriginalName();
                $files->file_name = basename($physicalPath);
                $files->file_address = $physicalPath;
                $files->mime_type = Storage::disk('liara')->mimeType($physicalPath);
                $files->directories_id = $destinationPath->id;
                $files->size = Storage::disk('liara')->size($physicalPath);
                $files->hash_file = md5(Storage::disk('liara')->get($physicalPath));
                $files->files_label_id = null;
                $files->accounts_id = $megaAuth->get_account_id($account_type);
                $files->save();

                return $files['id'];
            }

            return null;
        } catch (FileException $e) {
            return abort(500, 'file not found');
        }
    }

    public function fileExists()
    {

        // Check database if file not exists in physical directory
        // Change status in database to not exists
        $files = Files::all();
        foreach ($files as $file) {
            if (! Storage::exists($file->file_address)) {
                $file->files_status_id = 6; // Not exists
                $file->files_status_at = now();
                $file->files_status_by = 2; // user "Bot File"
                $file->save();
            }
        }

        // Check physical directory if file not exists in database
        // this code maybe complex to reading, but it's simple
        foreach (Storage::disk('liara')->allDirectories() as $directory) {
            foreach (Storage::disk('liara')->allFiles($directory) as $filePath) {
                foreach (Files::all() as $files) {
                    if ($files->file_address == $filePath) {
                        goto jumper;
                    }
                }
                Storage::disk('liara')->delete($filePath);
                jumper:
            }
        }
    }
}
