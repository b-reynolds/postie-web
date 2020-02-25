<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Postie\PostieService;
use App\PrismJs\PrismJsService;

class FileController extends Controller
{
    private $postie;
    private $prismJs;

    public function __construct(PostieService $postie, PrismJsService $prismJs)
    {
        $this->postie = $postie;
        $this->prismJs = $prismJs;
    }

    public function get($id)
    {
        $file = $this->postie->getFile($id);
        if ($file == null) {
            return view('file_not_found');
        }

        $fileType = null;
        if ($file->fileTypeId !== null) {
            $fileType = $this->postie->getFileType($file->fileTypeId);
            if ($fileType === null) {
                return view('file_not_found');
            }
        }

        $fileTypeAlias = "";
        if ($fileType !== null) {
            foreach($this->prismJs->supportedLanguages as $language) {
                if ($fileType->name == $language->title) {
                    $fileTypeAlias = $language->alias;
                    break;
                }
            }
        }

        return view('file', [
            'id' => $id,
            'file' => $file,
            'fileType' => $fileType,
            'fileTypeAlias' => $fileTypeAlias
        ]);
    }
}
