<?php

namespace App\Postie;

/**
 * Able to make exchanges with the Postie API.
 */
interface PostieService
{
    /**
     * Returns the file identified by the specified ID or [null] if one does not exist.
     * 
     * @param string $id ID of the file that should be retrieved.
     * @return File Requested file or `null` if a file with the specified ID does not exist.
     */
    public function getFile($id): ?File;

    /**
     * Returns the file type identified by the specified ID or [null] if one does not exist.
     * 
     * @param mixed $id ID of the file type that should be retrieved.
     * 
     * @return FileType Requested file type or `null` if a file type with the specified ID does not exist.
     */
    public function getFileType($id): ?FileType;
}
