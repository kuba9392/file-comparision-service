<?php


namespace Kuba9392\Service\File;


class FileSizeDiffer implements FileDiffer
{
    public function diff(File $firstFile, File $secondFile): array
    {
        return [$firstFile->getSize(), $secondFile->getSize()];
    }

    public function getType(): string
    {
        return "size";
    }
}