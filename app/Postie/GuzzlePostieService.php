<?php

namespace App\Postie;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * An implementation of PostieService that uses Guzzle to make HTTP requests to the Postie API.
 */
class GuzzlePostieService implements PostieService
{
    private const FIELD_CONTENTS = 'contents';
    private const FIELD_EXPIRES_AT = 'expiresAt';
    private const FIELD_FILE_TYPE_ID = 'fileTypeId';
    private const FIELD_NAME = 'name';

    private const HEADER_AUTHORIZATION = 'Authorization';
    private const HEADER_LOCATION = 'Location';

    private const OPTION_BASE_URI = 'base_uri';
    private const OPTION_HEADERS = 'headers';

    private const ROUTE_FILE_TYPES = 'filetypes';
    private const ROUTE_FILES = 'files';

    private $client;

    /**
     * @param string $baseUri Base URI of the Postie API (e.g. http://localhost:7000/v1/).
     * @param string $apiKey API key that will be used to authenticate requests.
     */
    public function __construct(string $baseUri, string $apiKey)
    {
        $this->client = new Client([
            self::OPTION_BASE_URI => $baseUri,
            self::OPTION_HEADERS => [
                self::HEADER_AUTHORIZATION => $apiKey
            ]
        ]);
    }

    public function createFile(string $name, FileType $fileType, ExpiryOption $expiryOption, string $contents): string
    {
        $response = $this->client->post(self::ROUTE_FILES . '/', [
            RequestOptions::JSON => [
                self::FIELD_NAME => $name,
                self::FIELD_FILE_TYPE_ID => $fileType->id,
                self::FIELD_EXPIRES_AT => (time() + $expiryOption->seconds) * 1000,
                self::FIELD_CONTENTS => $contents
            ]
        ]);

        return $this->extractResourceId($response);
    }

    public function getFile(string $id): ?File
    {
        try {
            $response = $this->client->request('GET', self::ROUTE_FILES . '/' . $id);

            $json = json_decode($response->getBody());

            return new File($json->id, $json->name, $json->fileTypeId, $json->contents, $json->createdAt, $json->expiresAt);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                return null;
            }

            throw $exception;
        }
    }

    public function createFileType(string $name): string
    {
        $response = $this->client->post(self::ROUTE_FILE_TYPES . '/', [
            RequestOptions::JSON => [
                self::FIELD_NAME => $name,
            ]
        ]);

        return $this->extractResourceId($response);
    }

    public function getFileType(int $id): ?FileType
    {
        try {
            $response = $this->client->request('GET', self::ROUTE_FILE_TYPES . '/' . $id);

            $json = json_decode($response->getBody());

            return new FileType($json->id, $json->name, $json->createdAt);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                return null;
            }

            throw $exception;
        }
    }

    public function getFileTypes(): array
    {
        $response = $this->client->request('GET', self::ROUTE_FILE_TYPES . '/');

        $json = json_decode($response->getBody());

        $fileTypes = [];
        foreach ($json as $fileType) {
            array_push($fileTypes, new FileType($fileType->id, $fileType->name, $fileType->createdAt));
        }

        return $fileTypes;
    }

    private function extractLocationHeader(ResponseInterface $response): string {
        $locationHeaders = $response->getHeader(self::HEADER_LOCATION);

        return $locationHeaders[array_key_first($locationHeaders)];
    }

    private function extractResourceId(ResponseInterface $response) {
        return basename($this->extractLocationHeader($response), "/");
    }
}
