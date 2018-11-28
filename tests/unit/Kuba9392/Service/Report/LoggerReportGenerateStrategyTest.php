<?php

namespace Kuba9392\Service\Report;

use Kuba9392\Service\Logger\Logger;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class LoggerReportGenerateStrategyTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | Logger
     */
    private $logger;

    /**
     * @var MockInterface | Report
     */
    private $report;

    /**
     * @var LoggerReportGenerateStrategy
     */
    private $strategy;

    public function setUp()
    {
        $this->report = \Mockery::mock(Report::class);
        $this->logger = \Mockery::mock(Logger::class);
        $this->strategy = new LoggerReportGenerateStrategy($this->report, $this->logger);
    }

    public function testGenerateWhenSingleReportRowExists()
    {
        $this->report->expects("toArray")->andReturn(["a"]);
        $this->logger->expects("log")->with("a");

        $this->strategy->generate();
    }

    public function testGenerateWhenMultipleReportRowExists()
    {
        $this->report->expects("toArray")->andReturn(["a", "b"]);
        $this->logger->expects("log")->with("a");
        $this->logger->expects("log")->with("b");

        $this->strategy->generate();
    }
}
