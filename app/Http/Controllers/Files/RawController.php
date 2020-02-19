<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Postie\PostieService;

class RawController extends Controller
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

        $contents = view('raw')->with('file', $file);
        return response($contents)->header('Content-Type', 'text/plain');
    }
}
