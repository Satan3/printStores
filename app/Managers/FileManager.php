<?php

namespace App\Managers;

use App\Entities\File;
use App\Wrappers\AppWrapper;
use Psr\Http\Message\UploadedFileInterface;

class FileManager {
    private $directory;
    private $fileRepository;

    public function __construct($path) {
        $this->directory = $path;
        $this->fileRepository = AppWrapper::getInstance()->getContainer()->get('fileRepository');
    }

    public function save(UploadedFileInterface $uploadedFile) {
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $path = $this->moveUploadedFile($uploadedFile);
            return $this->fileRepository->create(['path' => $path]);
        }
        return null;
    }

    public function delete(string $path) {
        $baseDir = AppWrapper::getInstance()->getContainer()->get('baseDir');
        return unlink(realpath($baseDir) . $path);
    }

    public function replace(File $oldFile, UploadedFileInterface $newFile) {
        $this->delete($oldFile->getPath());
        return $this->save($newFile);
    }

    private function moveUploadedFile(UploadedFileInterface $uploadedFile) {
        $baseDir = AppWrapper::getInstance()->getContainer()->get('baseDir');
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $baseName = bin2hex(random_bytes(8));
        $fileName = sprintf('%s.%0.8s', $baseName, $extension);
        $filePath = sprintf(
            '%suploads%s%s%s%s',
            DIRECTORY_SEPARATOR,
            DIRECTORY_SEPARATOR,
            $this->directory,
            DIRECTORY_SEPARATOR,
            $fileName
        );
        $uploadedFile->moveTo(realpath($baseDir) . $filePath);
        return $filePath;
    }
}
