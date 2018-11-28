<?php


namespace Kuba9392\Service\File;


class FileReaderException extends \Exception
{
    public static function fileNotFound(string $filePath)
    {
        return new self("File not found (file path: $filePath)");
    }
}