<?php

namespace App\Wrappers;

use Psr\Http\Message\ResponseInterface;

class ResponseWrapper extends BaseWrapper {
    public function toJson($body, int $status = null): ResponseInterface {
        if ($status) {
            $this->getEntity()->withStatus($status);
        }
        $this->getEntity()->getBody()->write(json_encode($body, JSON_UNESCAPED_UNICODE));
        return $this->getEntity()->withHeader('Content-Type', 'application/json');
    }
}
