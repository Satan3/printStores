<?php

namespace App\Wrappers;

class RequestWrapper extends BaseWrapper {

    public function getBody() {
        return $this->getEntity()->getParsedBody();
    }

    public function getValidatedData() {
        return array_merge($this->getBody(), $this->getEntity()->getUploadedFiles());
    }
}
