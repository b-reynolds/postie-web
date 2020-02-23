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
    private $maxNameLength;
    private $maxContentsLength;

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
        $this->maxNameLength = env('POSTIE_FILE_NAME_LENGTH_MAX');
        $this->maxContentsLength = env('POSTIE_CONTENTS_LENGTH_MAX');
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
        $name = trim($request->input('name'));
        if (strlen($name) == 0) {
            return redirect()->action('Files\CreateController@get');
        } else if (strlen($name) > $this->maxNameLength) {
            $name = substr($name, 0, $this->maxNameLength);
        }

        $fileTypeId = $request->input('fileType');
        $fileType = $this->postie->getFileType($fileTypeId);
        if ($fileType == null) {
            return redirect()->action('Files\CreateController@get');
        }

        $expiryOptionId = $request->input('expires');
        $expiryOption = $this->expiryOptions[$expiryOptionId] ?? null;
        if ($expiryOption == null) {
            return redirect()->action('Files\CreateController@get');
        }

        $contents = $request->input('contents');
        $contentsLength = strlen($contents);
        if ($contentsLength == 0) {
            return redirect()->action('Files\CreateController@get');
        } else if ($contentsLength > $this->maxContentsLength) {
            error_log('subbing to ' . $this->maxContentsLength);
            $contents = substr($contents, 0, $this->maxContentsLength);
        }

        $fileId = $this->postie->createFile($name, $fileType, $expiryOption, $contents);

        return redirect()->action('Files\FileController@get', ['id' => $fileId]);
    }
}
