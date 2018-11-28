<?php


namespace Kuba9392\Service\File;


interface MultiFileDiffsReaderProvider
{
    public function get(): MultiFileDiffsReader;
}