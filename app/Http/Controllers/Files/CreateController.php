<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Postie\PostieService;
use App\Postie\ExpiryOption;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    private $postie;
    private $expiryOptions;

    public function __construct(PostieService $postie)
    {
        $this->postie = $postie;
        $this->expiryOptions = [
            1 => new ExpiryOption("1 Hour", 3600),
            2 => new ExpiryOption("1 Day", 86400),
            3 => new ExpiryOption("1 Week", 604800),
            4 => new ExpiryOption("1 Month", 2629746),
            5 => new ExpiryOption("1 Year", 31556952)
        ];
    }

    public function get()
    {
        $fileTypes = $this->postie->getFileTypes();

        return view(
            'home',
            [
                'fileTypes' => $fileTypes,
                'expiryOptions' => $this->expiryOptions,
            ]
        );
    }

    public function post(Request $request)
    {
        $name = $request->input('name');
        $fileTypeId = $request->input('fileType');
        $expiryOptionId = $request->input('expires');
        $contents = $request->input('contents');

        $fileType = $this->postie->getFileType($fileTypeId);
        if ($fileType == null) {
            return redirect()->action('Files\CreateController@get');
        }

        $expiryOption = $this->expiryOptions[$expiryOptionId] ?? null;
        if ($expiryOption == null) {
            return redirect()->action('Files\CreateController@get');
        }

        $fileId = $this->postie->createFile($name, $fileType, $expiryOption, $contents);

        return redirect()->action('Files\FileController@get', ['id' => $fileId ]);
    }
}