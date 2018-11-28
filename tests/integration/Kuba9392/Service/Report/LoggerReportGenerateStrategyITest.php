<?php

namespace Kuba9392\Service\Report;

use Kuba9392\ArrayLogger;
use Kuba9392\ArrayStorage;
use Kuba9392\Service\File\File;
use PHPUnit\Framework\TestCase;


class LoggerReportGenerateStrategyITest extends TestCase
{
    /**
     * @var ArrayStorage
     */
    private $storage;

    /**
     * @var ArrayLogger
     */
    private $logger;

    public function setUp()
    {
        $this->storage = new ArrayStorage();
        $this->logger = new ArrayLogger($this->storage);
    }

    public function testGenerate()
    {
        $report = $this->createTestReport($this->createTestTimestamp());
        $strategy = new LoggerReportGenerateStrategy($report, $this->logger);
        $strategy->generate();

        $generatedReport = [
            "Date: 1970-01-01 00:00:01",
            "Size: 1 b",
            "Differences:",
            "Comparing file test",
            "[CONTENT] Removed values: [\"z\"], Added values: [\"za\"]",
            "[ENCODING] Original encoding: null, Comparing file encoding: \"generatedReport\"",
            "[SIZE] Original size: 1 b, Comparing file size: 2 b"
        ];

        $this->assertEquals($generatedReport, $this->storage->getStorageData());
    }

    private function createTestFile(string $fileName, string $content): File
    {
        $file = new File();
        $file->setName($fileName);
        $file->setContent($content);
        $file->setEncoding(null);
        $file->setSize(strlen($content));
        $file->setPath("test/" . $fileName);
        return $file;
    }

    protected function createTestReport($date)
    {
        return Report::create($date, $this->createTestFile("test1", "z"), [
            "test" => [
                "content" => [
                    ["z"], ["za"]
                ],
                "encoding" => [
                    null, "generatedReport"
                ],
                "size" => [
                    1, 2
                ]
            ]
        ]);
    }

    /**
     * @return \DateTime
     */
    protected function createTestTimestamp(): \DateTime
    {
        $date = new \DateTime();
        $date->setTimestamp('1');
        return $date;
    }
}
