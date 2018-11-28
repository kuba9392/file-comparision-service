<?php


namespace Kuba9392\Service\File;


class MultiFileReader
{
    /**
     * @var FileReader
     */
    private $fileReader;

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    /**
     * @param array $filePaths
     * @return array
     * @throws FileReaderException
     */
    public function read(array $filePaths)
    {
        $files = [];
        foreach($filePaths as $path) {
            $files[] = $this->fileReader->read($path);
        }
        return $files;
    }
}