<?php

namespace Kuba9392\Service\File;


use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class FileReaderITest extends TestCase
{
    private const ROOT_DIR_NAME = 'home';

    /**
     * @var vfsStreamDirectory
     */
    private $fileSystem;

    /**
     * @var FileReader
     */
    private $fileReader;

    public function setUp()
    {
        $this->fileSystem = vfsStream::setup(self::ROOT_DIR_NAME);
        $this->fileReader = new FileReader();
    }

    /**
     * @throws FileReaderException
     */
    public function testReadFileThenCreateFileEntityWhenFileExists()
    {
        $fileName = 'testFile.txt';
        $content = "test_content1";
        vfsStream::newFile($fileName)->at($this->fileSystem)->setContent($content);
        $file = $this->createTestFile($fileName, $content);

        $result = $this->fileReader->read($this->getFilePath($fileName));

        $this->assertEquals($file, $result);
    }

    /**
     * @throws FileReaderException
     */
    public function testReadFileThenCreateFileEntityWithProperlyFormattedContentWhenContentHasSpecialChars()
    {
        $fileName = 'testFile.txt';
        $content = "śążćł";
        vfsStream::newFile($fileName)->at($this->fileSystem)->setContent($content);
        $file = $this->createTestFile($fileName, $content);

        $result = $this->fileReader->read($this->getFilePath($fileName));

        $this->assertEquals($file, $result);
    }

    /**
     * @expectedException \Kuba9392\Service\File\FileReaderException
     * @expectedExceptionMessage File not found (file path: test.txt)
     */
    public function testReadFileThenThrowExceptionWhenFileNotExists()
    {
        $this->fileReader->read('test.txt');
    }

    private function createTestFile(string $fileName, string $content): File
    {
        $file = new File();
        $file->setName($fileName);
        $file->setContent($content);
        $file->setEncoding(mb_detect_encoding($content));
        $file->setSize(strlen($content));
        $file->setPath($this->getFilePath($fileName));
        return $file;
    }

    private function getFilePath(string $fileName): string
    {
        return vfsStream::url(self::ROOT_DIR_NAME . "/" . $fileName);
    }
}
