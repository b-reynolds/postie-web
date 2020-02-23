<?php

namespace App\Postie;

use App\Postie\FileType;

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
    public function getFile(string $id): ?File;

    /**
     * Creates a new file and returns its ID.
     */
    public function createFile(string $name, FileType $fileType, ExpiryOption $expiryOption, string $contents): string;

    /**
     * Creates a new file type and returns its ID.
     * 
     * @param string $name Name of the file type.
     */
    public function createFileType(string $name): string;

    /**
     * Returns the file type identified by the specified ID or [null] if one does not exist.
     * 
     * @param int $id ID of the file type that should be retrieved.
     * 
     * @return FileType Requested file type or `null` if a file type with the specified ID does not exist.
     */
    public function getFileType(int $id): ?FileType;

    /**
     * Returns an array containing available file types.
     */
    public function getFileTypes(): array;
}
