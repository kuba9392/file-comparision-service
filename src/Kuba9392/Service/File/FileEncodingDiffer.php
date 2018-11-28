<?php


namespace Kuba9392\Service\File;


class FileEncodingDiffer implements FileDiffer
{
    public function diff(File $firstFile, File $secondFile): array
    {
        return [$firstFile->getEncoding(), $secondFile->getEncoding()];
    }

    public function getType(): string
    {
        return "encoding";
    }
}