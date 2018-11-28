<?php

namespace Kuba9392\Service\Report;

use Kuba9392\Service\Sms\SmsSender;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class SmsReportGenerateStrategyTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | SmsSender
     */
    private $sender;

    /**
     * @var MockInterface | Report
     */
    private $report;

    /**
     * @var SmsReportGenerateStrategy
     */
    private $strategy;

    public function setUp()
    {
        $this->sender = \Mockery::mock(SmsSender::class);
        $this->report = \Mockery::mock(Report::class);
        $this->strategy = new SmsReportGenerateStrategy($this->sender, $this->report);
    }

    public function testGenerateWhenSingleFileDataWithChangedDataExist()
    {
        $reportFileData = \Mockery::mock(ReportFileData::class);
        $this->report->expects("getData")->andReturn([$reportFileData]);
        $this->mockDataDiffs($reportFileData)->expects("getOriginalData")->andReturn("test");
        $this->mockDataDiffs($reportFileData)->expects("getComparingData")->andReturn("test1");
        $this->sender->expects("send");

        $this->strategy->generate();
    }

    public function testGenerateWhenManyFileDataWithChangedDataExists()
    {
        $reportFileData1 = \Mockery::mock(ReportFileData::class);
        $reportFileData2 = \Mockery::mock(ReportFileData::class);
        $this->report->expects("getData")->andReturn([$reportFileData1, $reportFileData2]);
        $this->mockDataDiffs($reportFileData1)->expects("getOriginalData")->andReturn(null);
        $this->mockDataDiffs($reportFileData1)->expects("getComparingData")->andReturn(null);
        $this->mockDataDiffs($reportFileData2)->expects("getOriginalData")->andReturn("test");
        $this->mockDataDiffs($reportFileData2)->expects("getComparingData")->andReturn("test1");
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
        $reportFileData1->expects("getEncodingDiffs")->andReturn($dataDiffs);
        return $dataDiffs;
    }
}
