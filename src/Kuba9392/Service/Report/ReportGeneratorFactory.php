<?php


namespace Kuba9392\Service\Report;


abstract class ReportGeneratorFactory
{
    public function create(ReportInterface $report): ReportGenerator
    {
        return (new ReportGenerator())->setStrategies($this->createStrategies($report));
    }

    public abstract function createStrategies(ReportInterface $report): array;
}