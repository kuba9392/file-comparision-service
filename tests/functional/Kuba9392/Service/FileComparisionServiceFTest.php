<?php

namespace Kuba9392\Service;

use Kuba9392\ArrayStorage;
use Kuba9392\Service\File\BasicMultiFileDiffsReaderProvider;
use Kuba9392\Service\Report\BasicReportFactory;
use Kuba9392\TestComparingFilesPathsProvider;
use Kuba9392\TestMainFilePathProvider;
use Kuba9392\TestReportGeneratorFactory;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class FileComparisionServiceFTest extends TestCase
{
    private const ROOT_DIR_NAME = 'home';

    /**
     * @var vfsStreamDirectory
     */
    private $fileSystem;

    /**
     * @var ArrayStorage
     */
    private $storage;

    /**
     * @var ReportGeneratorBootstrap
     */
    private $reportGeneratorBootstrap;

    public function setUp()
    {
        $this->fileSystem = vfsStream::setup(self::ROOT_DIR_NAME);
        $this->storage = new ArrayStorage();
        $this->reportGeneratorBootstrap = new ReportGeneratorBootstrap(
            new TestReportGeneratorFactory($this->storage),
            new BasicMultiFileDiffsReaderProvider(),
            new BasicReportFactory()
        );
    }

    /**
     * @throws File\FileReaderException
     */
    public function testRun()
    {
        $mainFileName = "test";
        vfsStream::newFile($mainFileName)->at($this->fileSystem)->setContent("1");
        $compareFileName1 = "test1";
        vfsStream::newFile($compareFileName1)->at($this->fileSystem)->setContent("11");

        $this->createBootstrap($mainFileName, $compareFileName1)->run();

        $storageData = $this->storage->getStorageData();
        $this->assertEquals(sizeof($storageData), 7);
        $this->assertEquals("Size: 1 b", $storageData[1]);
        $this->assertEquals("Comparing file test1", $storageData[3]);
        $this->assertEquals("[CONTENT] Removed values: [\"1\"], Added values: [\"11\"]", $storageData[4]);
        $this->assertEquals("[ENCODING] Original encoding: \"ASCII\", Comparing file encoding: \"ASCII\"", $storageData[5]);
        $this->assertEquals("[SIZE] Original size: 1 b, Comparing file size: 2 b", $storageData[6]);
    }

    private function getFilePath(string $fileName): string
    {
        return vfsStream::url(self::ROOT_DIR_NAME . "/" . $fileName);
    }

    protected function createBootstrap($mainFileName, $compareFileName1): Bootstrap
    {
        $bootstrap = new Bootstrap(
            new TestMainFilePathProvider($this->getFilePath($mainFileName)),
            new TestComparingFilesPathsProvider([$this->getFilePath($compareFileName1)]),
            $this->reportGeneratorBootstrap
        );
        return $bootstrap;
    }
}
