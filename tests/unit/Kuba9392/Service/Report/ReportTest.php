<?php

namespace Kuba9392\Service\Report;

use Kuba9392\Service\File\File;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testCreate()
    {
        $filesData = [
            "test" => [
                "size" => [
                    1, 2
                ]
            ]
        ];

        $file = new File();
        $date = new \DateTime();
        $report = Report::create($date, $file, $filesData);
        $fileData = ReportFileData::createFromData("test", $filesData["test"]);

        $this->assertEquals([$fileData], $report->getData());
        $this->assertEquals($date, $report->getDate());
        $this->assertEquals($file, $report->getFile());
    }

    public function testToArrayWhenDiffsAreSet()
    {
        $file = $this->createTestFile();
        $date = $this->createTestDate();
        /** @var MockInterface | ReportFileDataInterface $reportFileData */
        $reportFileData = \Mockery::mock(ReportFileDataInterface::class);
        $reportFileData->expects("toArray")->andReturn(["test"]);
        $report = $this->createTestReport($file, $date, $reportFileData);

        $this->assertEquals([
            "Date: 1970-01-01 00:00:01",
            "Size: 1 b",
            "Differences:",
            "test"
        ], $report->toArray());
    }

    protected function createTestFile(): File
    {
        $file = new File();
        $file->setSize(1);
        return $file;
    }

    protected function createTestDate(): \DateTime
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp(1);
        return $dateTime;
    }

    protected function createTestReport($file, $date, $reportFileData): Report
    {
        $report = new Report();
        $report->setFile($file);
        $report->setDate($date);
        $report->setData([
            $reportFileData
        ]);
        return $report;
    }
}
