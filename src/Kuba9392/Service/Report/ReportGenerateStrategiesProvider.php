<?php


namespace Kuba9392\Service\Report;


interface ReportGenerateStrategiesProvider
{
    /**
     * @return ReportGenerateStrategy[]
     */
    public function get(): array;

    public function getReport(): ReportInterface;

    public function setReport(ReportInterface $report);
}