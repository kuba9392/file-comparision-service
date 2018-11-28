<?php

namespace Kuba9392\Service\File;


use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class MultiFileReaderTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | FileReader
     */
    private $fileReader;

    /**
     * @var MultiFileReader
     */
    private $multiFileReader;

    public function setUp()
    {
        $this->fileReader = \Mockery::mock(FileReader::class);
        $this->multiFileReader = new MultiFileReader($this->fileReader);
    }

    /**
     * @throws FileReaderException
     */
    public function testReadThenCreateFiles()
    {
        $filePath1 = "file1";
        $file1 = $this->createTestFile($filePath1);
        $filePath2 = "file2";
        $file2 = $this->createTestFile($filePath2);

        $this->fileReader->expects("read")->with($filePath1)->andReturn($file1);
        $this->fileReader->expects("read")->with($filePath2)->andReturn($file2);

        $files = $this->multiFileReader->read([$filePath1, $filePath2]);
        $this->assertEquals([$file1, $file2], $files);
    }

    /**
     * @expectedException \Kuba9392\Service\File\FileReaderException
     */
    public function testReadWhenExceptionThrownThenPassIt()
    {
        $filePath = "not_existing_file";

        $this->fileReader->expects("read")->with($filePath)->andThrow(FileReaderException::class);
        $this->multiFileReader->read([$filePath]);
    }

    private function createTestFile(string $path)
    {
        $file = new File();
        $file->setPath($path);
        return $file;
    }
}
