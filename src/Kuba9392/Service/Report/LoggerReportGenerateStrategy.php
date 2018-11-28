<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\Logger\Logger;

class LoggerReportGenerateStrategy implements ReportGenerateStrategy
{
    /**
     * @var ReportInterface
     */
    private $report;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(ReportInterface $report, Logger $logger)
    {
        $this->report = $report;
        $this->logger = $logger;
    }

    public function generate()
    {
        foreach($this->report->toArray() as $reportRow) {
            $this->logger->log($reportRow);
        }
    }
}