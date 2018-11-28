<?php

namespace Kuba9392\Service\File;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class MultiFileDiffsReaderTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | FileDiffer
     */
    private $multiDiffer;

    /**
     * @var MultiFileDiffsReader
     */
    private $differ;

    public function setUp()
    {
        $this->multiDiffer = \Mockery::mock(FileDiffer::class);
        $this->differ = new MultiFileDiffsReader($this->multiDiffer);
    }

    public function testDiffWhenDifferReturnsNonEmptyArray()
    {
        $file = new File();
        $filesToCompare = [$this->createTestFile("test_1"), $this->createTestFile("test_2")];

        $this->multiDiffer->expects("diff")->with($file, $filesToCompare[0])->andReturn([1, 2]);
        $this->multiDiffer->expects("diff")->with($file, $filesToCompare[1])->andReturn([2, 3]);

        $this->assertEquals(["test_1" => [1, 2], "test_2" => [2, 3]], $this->differ->read($file, $filesToCompare));
    }

    public function testDiffWhenDifferReturnsEmptyArray()
    {
        $file = new File();
        $filesToCompare = [$this->createTestFile("test_1"), $this->createTestFile("test_2")];

        $this->multiDiffer->expects("diff")->with($file, $filesToCompare[0])->andReturn([]);
        $this->multiDiffer->expects("diff")->with($file, $filesToCompare[1])->andReturn([]);

        $this->assertEquals(["test_1" => [], "test_2" => []], $this->differ->read($file, $filesToCompare));
    }

    private function createTestFile(string $name)
    {
        $file = new File();
        $file->setName($name);
        return $file;
    }
}
