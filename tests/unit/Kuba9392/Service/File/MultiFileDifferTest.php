<?php

namespace Kuba9392\Service\File;


use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class MultiFileDifferTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | FileDiffer
     */
    private $fileDiffer1;

    /**
     * @var MockInterface | FileDiffer
     */
    private $fileDiffer2;

    /**
     * @var MultiFileDiffer
     */
    private $differ;

    public function setUp()
    {
        $this->fileDiffer1 = \Mockery::mock(FileDiffer::class);
        $this->fileDiffer2 = \Mockery::mock(FileDiffer::class);
        $this->differ = new MultiFileDiffer([
            $this->fileDiffer1,
            $this->fileDiffer2
        ]);
    }

    public function testDiffWhenDiffersReturnsNonEmptyArrays()
    {
        $file1 = new File();
        $file2 = $this->createTestFile("test_1");

        $this->mockDiff($this->fileDiffer1, "type_1", $file1, $file2, [1, 2]);
        $this->mockDiff($this->fileDiffer2, "type_2", $file1, $file2, [2, 3]);

        $this->assertEquals(["type_1" => [1, 2], "type_2" => [2, 3]], $this->differ->diff($file1, $file2));
    }

    public function testDiffWhenDifferReturnsEmptyArray()
    {
        $file1 = new File();
        $file2 = $this->createTestFile("test_1");

        $this->mockDiff($this->fileDiffer1, "type_1", $file1, $file2, [1, 2]);
        $this->mockDiff($this->fileDiffer2, "type_2", $file1, $file2, []);

        $this->assertEquals(["type_1" => [1, 2], "type_2" => []], $this->differ->diff($file1, $file2));
    }

    private function createTestFile(string $name)
    {
        $file = new File();
        $file->setName($name);
        return $file;
    }

    /**
     * @param MockInterface | FileDiffer $differ
     * @param string $type
     * @param File $file1
     * @param File $file2
     * @param $return
     */
    protected function mockDiff(MockInterface $differ, string $type, File $file1, File $file2, $return): void
    {
        $differ->expects("getType")->andReturn($type);
        $differ->expects("diff")->with($file1, $file2)->andReturn($return);
    }
}
