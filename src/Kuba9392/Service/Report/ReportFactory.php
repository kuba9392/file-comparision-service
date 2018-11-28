<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\File\File;

interface ReportFactory
{
    public function create(File $file, array $filesData): ReportInterface;
}