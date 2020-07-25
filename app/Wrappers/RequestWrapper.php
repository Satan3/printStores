<?php

namespace App\Wrappers;

class RequestWrapper extends BaseWrapper {

    public function getBody() {
        return json_decode($this->getEntity()->getBody()->getContents(), true) ?? [];
    }
}
