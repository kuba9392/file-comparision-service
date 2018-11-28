<?php

namespace Kuba9392\Service\Report;

use Kuba9392\Service\Email\EmailSender;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EmailReportGenerateStrategyITest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | EmailSender
     */
    private $sender;

    /**
     * @var MockInterface | Report
     */
    private $report;

    /**
     * @var EmailReportGenerateStrategy
     */
    private $strategy;

    public function setUp()
    {
        $this->sender = \Mockery::mock(EmailSender::class);
        $this->report = \Mockery::mock(Report::class);
        $this->strategy = new EmailReportGenerateStrategy($this->sender, $this->report);
    }

    public function testGenerateWhenSingleFileDataWithChangedDataExist()
    {
        $reportFileData = \Mockery::mock(ReportFileData::class);
        $this->report->expects("getData")->andReturn([$reportFileData]);
        $this->mockDataDiffs($reportFileData)->expects("getComparingData")->andReturn(["changed_value"]);
        $this->sender->expects("send");

        $this->strategy->generate();
    }

    public function testGenerateWhenManyFileDataWithChangedDataExists()
    {
        $reportFileData1 = \Mockery::mock(ReportFileData::class);
        $reportFileData2 = \Mockery::mock(ReportFileData::class);
        $this->report->expects("getData")->andReturn([$reportFileData1, $reportFileData2]);
        $this->mockDataDiffs($reportFileData1)->expects("getComparingData")->andReturn([]);
        $this->mockDataDiffs($reportFileData2)->expects("getComparingData")->andReturn(["changed_value"]);
        $this->sender->expects("send");

        $this->strategy->generate();
    }

    /**
     * @param MockInterface | ReportFileData $reportFileData1
     * @return ReportFileDataDiffs|MockInterface
     */
    protected function mockDataDiffs(MockInterface $reportFileData1)
    {
        $dataDiffs = \Mockery::mock(ReportFileDataDiffs::class);
        $reportFileData1->expects("getContentDiffs")->andReturn($dataDiffs);
        return $dataDiffs;
    }
}
