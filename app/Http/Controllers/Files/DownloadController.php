<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Postie\PostieService;

class DownloadController extends Controller
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

        $response = response($file->contents, 200, [
            'Content-Disposition' => 'attachment; filename="' . $file->name . '.txt"',
        ]);

        return $response;
    }
}
