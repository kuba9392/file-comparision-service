<?php


namespace Kuba9392\Service;


use Kuba9392\Service\File\File;
use Kuba9392\Service\File\MultiFileDiffsReaderProvider;
use Kuba9392\Service\Report\ReportFactory;
use Kuba9392\Service\Report\ReportGeneratorFactory;

class ReportGeneratorBootstrap
{
    /**
     * @var ReportGeneratorFactory
     */
    private $reportGeneratorFactory;

    /**
     * @var MultiFileDiffsReaderProvider
     */
    private $multiFileDiffsReaderProvider;

    /**
     * @var ReportFactory
     */
    private $reportFactory;

    public function __construct(
        ReportGeneratorFactory $reportGeneratorFactory,
        MultiFileDiffsReaderProvider $multiFileDiffsReaderProvider,
        ReportFactory $reportFactory
    )
    {
        $this->reportGeneratorFactory = $reportGeneratorFactory;
        $this->multiFileDiffsReaderProvider = $multiFileDiffsReaderProvider;
        $this->reportFactory = $reportFactory;
    }

    public function run(File $mainFile, array $comparingFiles)
    {
        $fileDiffsData = $this->multiFileDiffsReaderProvider->get()->read($mainFile, $comparingFiles);
        $report = $this->reportFactory->create($mainFile, $fileDiffsData);

        $this->reportGeneratorFactory->create($report)->generate();
    }
}