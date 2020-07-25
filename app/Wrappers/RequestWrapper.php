<?php

namespace App\Wrappers;

use Psr\Http\Message\ServerRequestInterface;

class RequestWrapper {
    private $request;

    public function __construct(ServerRequestInterface $request) {
        $this->request = $request;
    }

    public function getBody() {
        return json_decode($this->request->getBody()->getContents(), true);
    }
}
