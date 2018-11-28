<?php
namespace Kuba9392\Service;

use Kuba9392\Service\File\FileReader;
use Kuba9392\Service\File\MultiFileReader;

class Bootstrap
{
    /**
     * @var MainFilePathProvider
     */
    private $mainFilePathProvider;

    /**
     * @var ComparingFilesPathsProvider
     */
    private $comparingFilesPathsProvider;

    /**
     * @var ReportGeneratorBootstrap
     */
    private $reportGeneratorBootstrap;

    public function __construct(
        MainFilePathProvider $mainFilePathProvider,
        ComparingFilesPathsProvider $comparingFilesPathsProvider,
        ReportGeneratorBootstrap $reportGeneratorBootstrap
    )
    {
        $this->mainFilePathProvider = $mainFilePathProvider;
        $this->comparingFilesPathsProvider = $comparingFilesPathsProvider;
        $this->reportGeneratorBootstrap = $reportGeneratorBootstrap;
    }

    /**
     * @throws File\FileReaderException
     */
    public function run()
    {
        $reader = new FileReader();
        $multiReader = new MultiFileReader($reader);

        $mainFile = $reader->read($this->mainFilePathProvider->get());
        $comparingFiles = $multiReader->read($this->comparingFilesPathsProvider->get());

        $this->reportGeneratorBootstrap->run($mainFile, $comparingFiles);
    }
}