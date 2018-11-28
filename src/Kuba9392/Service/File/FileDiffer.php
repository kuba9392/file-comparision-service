<?php


namespace Kuba9392\Service\File;


interface FileDiffer
{
    public function diff(File $firstFile, File $secondFile): array;

    public function getType(): string;
}