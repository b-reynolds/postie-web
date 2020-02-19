<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Postie\PostieService;

class FileController extends Controller
{
    private $postie;

    public function __construct(PostieService $postie)
    {
        $this->postie = $postie;
    }

    public function get($id)
    {
        $file = $this->postie->getFile($id);
        if ($file == null) {
            return view('file_not_found');
        }

        $fileType = $this->postie->getFileType($file->fileTypeId);
        if ($fileType == null) {
            return view('file_not_found');
        }

        return view('file', [
            'id' => $id,
            'file' => $file,
            'fileType' => $fileType
        ]);
    }
}
