<?php

namespace App\Postie;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * An implementation of PostieService that uses Guzzle to make HTTP requests.
 */
class GuzzlePostieService implements PostieService
{
    private $client;

    /**
     * @param string $baseUri Base URI of the Postie API.
     * @param string $apiKey Postie API key that will be used to authenticate requests.
     * 
     * @return void
     */
    public function __construct($baseUri, $apiKey)
    {
        $this->client = new Client(
            [
                'base_uri' => $baseUri,
                'headers' => [
                    'Authorization' => $apiKey
                ]
            ]
        );
    }

    public function getFile(string $id): ?File
    {
        try {
            $response = $this->client->request('GET', "files/{$id}");

            $json = json_decode($response->getBody());

            return new File($json->id, $json->name, $json->fileTypeId, $json->contents, $json->createdAt, $json->expiresAt);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                return null;
            }

            throw $exception;
        }
    }

    public function getFileType(int $id): ?FileType
    {
        try {
            $response = $this->client->request('GET', "filetypes/{$id}");

            $json = json_decode($response->getBody());

            return new FileType($json->id, $json->name, $json->createdAt);
        } catch (ClientException $exception) {
            if ($exception->getCode() == 404) {
                return null;
            }

            throw $exception;
        }
    }
}
