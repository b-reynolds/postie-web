<?php

namespace App\Postie;

/**
 * Postie file.
 */
class File {
    public $id;
    public $name;
    public $fileTypeId;
    public $contents;
    public $createdAt;
    public $expiresAt;
    
    /**
     * @param string $id Unique ID of the file.
     * @param string $name Name of the file.
     * @param int $fileTypeId Unique ID of the file's type.
     * @param string $contents Contents of the file.
     * @param time_t $createdAt Timestamp at which the file was created.
     * @param time_t $expiresAt Timestamp at which the file will expire (optional).
     * 
     * @return void
     */
    public function __construct($id, $name, $fileTypeId, $contents, $createdAt, $expiresAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fileTypeId = $fileTypeId;
        $this->contents = $contents;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
    }
}