<?php

namespace Kuba9392\Service\Report;

use PHPUnit\Framework\TestCase;

class ReportFileDataTest extends TestCase
{
    public function testCreateWhenSizeIsSet()
    {
        $diffData = [
            "size" => [
                1, 2
            ]
        ];

        $fileName = "test";
        $data = ReportFileData::createFromData($fileName, $diffData);
        $diffs = new ReportFileDataDiffs();
        $diffs->setOriginalData(1);
        $diffs->setComparingData(2);

        $this->assertEquals($fileName, $data->getFileName());
        $this->assertEquals($diffs, $data->getSizeDiffs());
    }

    public function testCreateWhenContentIsSet()
    {
        $diffData = [
            "content" => [
                ["a"], ["b"]
            ]
        ];

        $fileName = "test";
        $data = ReportFileData::createFromData($fileName, $diffData);
        $diffs = new ReportFileDataDiffs();
        $diffs->setOriginalData(["a"]);
        $diffs->setComparingData(["b"]);

        $this->assertEquals($fileName, $data->getFileName());
        $this->assertEquals($diffs, $data->getContentDiffs());
    }

    public function testCreateWhenEncodingIsSet()
    {
        $diffData = [
            "encoding" => [
                "a", "b"
            ]
        ];

        $fileName = "test";
        $data = ReportFileData::createFromData($fileName, $diffData);
        $diffs = new ReportFileDataDiffs();
        $diffs->setOriginalData("a");
        $diffs->setComparingData("b");

        $this->assertEquals($fileName, $data->getFileName());
        $this->assertEquals($diffs, $data->getEncodingDiffs());
    }

    public function testToArrayWhenDiffsAreSet()
    {
        $data = new ReportFileData();
        $data->setFileName("testFile.txt");
        $data->setContentDiffs($this->createTestReportDiffs(["a"], ["bb"]));
        $data->setEncodingDiffs($this->createTestReportDiffs("c", "d"));
        $data->setSizeDiffs($this->createTestReportDiffs(1, 2));

        $this->assertEquals([
            "Comparing file testFile.txt",
            "[CONTENT] Removed values: [\"a\"], Added values: [\"bb\"]",
            "[ENCODING] Original encoding: \"c\", Comparing file encoding: \"d\"",
            "[SIZE] Original size: 1 b, Comparing file size: 2 b"
        ], $data->toArray());
    }

    private function createTestReportDiffs($originalData, $comparingData): ReportFileDataDiffs
    {
        $diffs = new ReportFileDataDiffs();
        $diffs->setOriginalData($originalData);
        $diffs->setComparingData($comparingData);
        return $diffs;
    }
}
