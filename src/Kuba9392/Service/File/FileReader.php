<?php


namespace Kuba9392\Service\File;


class FileReader
{
    /**
     * @param string $filePath
     * @return File
     * @throws FileReaderException
     */
    public function read(string $filePath): File
    {
        if(!file_exists($filePath)) throw FileReaderException::fileNotFound($filePath);
        return $this->createFileWithData($filePath);
    }

    protected function createFileWithData(string $filePath): File
    {
        $file = new File();
        $file->setName(basename($filePath));
        $file->setContent(file_get_contents($filePath));
        $file->setSize(filesize($filePath));
        $file->setEncoding(mb_detect_encoding($file->getContent()));
        $file->setPath($filePath);
        return $file;
    }
}