<?php

namespace App\Postie;

/**
 * Postie file type.
 */
class FileType {
    public $id;
    public $name;
    public $createdAt;
    
    /**
     * @param int $id Unique ID of the file type.
     * @param string $name Name of the file type.
     * @param time_t $createdAt Timestamp at which the file type was created.
     * 
     * @return void
     */
    public function __construct($id, $name, $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
    }
}