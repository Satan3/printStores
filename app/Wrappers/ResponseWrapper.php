<?php

namespace App\Wrappers;

use Psr\Http\Message\ResponseInterface;

class ResponseWrapper {
    private $response;

    public function __construct(ResponseInterface $response) {
        $this->response = $response;
    }

    public function toJson($body, int $status = null): ResponseInterface {
        if ($status) {
            $this->response->withStatus($status);
        }
        $this->response->getBody()->write(json_encode($body, JSON_UNESCAPED_UNICODE));
        return $this->response->withHeader('Content-Type', 'application/json');
    }
}
