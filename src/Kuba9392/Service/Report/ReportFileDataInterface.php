<?php


namespace Kuba9392\Service\Report;


interface ReportFileDataInterface
{
    public static function createFromData(string $fileName, array $diffData): ReportFileDataInterface;

    public function toArray(): array;
}