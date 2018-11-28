<?php


namespace Kuba9392;


use Kuba9392\Service\Report\LoggerReportGenerateStrategy;
use Kuba9392\Service\Report\ReportGeneratorFactory;
use Kuba9392\Service\Report\ReportInterface;

class TestReportGeneratorFactory extends ReportGeneratorFactory
{
    /**
     * @var ArrayStorage
     */
    private $storage;

    public function __construct(ArrayStorage $storage)
    {
        $this->storage = $storage;
    }

    public function createStrategies(ReportInterface $report): array
    {
        return [
            new LoggerReportGenerateStrategy($report, new ArrayLogger($this->storage))
        ];
    }

    public function getStorage(): ArrayStorage
    {
        return $this->storage;
    }
}