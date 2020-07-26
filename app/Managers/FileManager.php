<?php

namespace App\Managers;

use Psr\Http\Message\UploadedFileInterface;

class FileManager {
    const UPLOAD_DIR_PATH = __DIR__ . DIRECTORY_SEPARATOR . '\..\..\uploads';
    private $path;
    private $fileRepository;

    public function __construct($path, $fileRepository) {
        $this->path = realpath(self::UPLOAD_DIR_PATH) . DIRECTORY_SEPARATOR .  $path;
        $this->fileRepository = $fileRepository;
    }

    public function save(UploadedFileInterface $uploadedFile) {
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $path = $this->moveUploadedFile($this->path, $uploadedFile);
            return $this->fileRepository->create(['path' => $path]);
        }
        return null;
    }

    private function moveUploadedFile($directory, UploadedFileInterface $uploadedFile) {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $fullPath = $directory . DIRECTORY_SEPARATOR . $filename;
        $uploadedFile->moveTo($fullPath);
        return $fullPath;
    }
}
