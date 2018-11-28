<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\File\File;

interface ReportInterface
{
    public static function create(\DateTime $date, File $file, array $filesData): self;

    public function toArray(): array;
}