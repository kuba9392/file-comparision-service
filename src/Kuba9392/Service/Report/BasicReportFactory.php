<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\File\File;

class BasicReportFactory implements ReportFactory
{
    public function create(File $file, array $filesData): ReportInterface
    {
        return Report::create(new \DateTime(), $file, $filesData);
    }
}