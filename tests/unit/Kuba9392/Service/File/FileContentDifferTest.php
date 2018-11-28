<?php

namespace Kuba9392\Service\File;


use Diff\Differ\Differ;
use Diff\DiffOp\DiffOpAdd;
use Diff\DiffOp\DiffOpRemove;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class FileContentDifferTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var MockInterface | Differ
     */
    private $childDiffer;

    /**
     * @var FileContentDiffer
     */
    private $differ;

    public function setUp()
    {
        $this->childDiffer = \Mockery::mock(Differ::class);
        $this->differ = new FileContentDiffer($this->childDiffer);
    }

    /**
     * @throws \Exception
     */
    public function testDiffWhenFilesAreDifferent()
    {
        $file1 = $this->createTestFile("test 1");
        $file2 = $this->createTestFile("test 2");

        $this->childDiffer->expects("doDiff")->with(["test", "1"], ["test", "2"])->andReturn([
            new DiffOpAdd(2),
            new DiffOpRemove(1),
        ]);

        $this->assertEquals([[1], [2]], $this->differ->diff($file1, $file2));
    }

    /**
     * @throws \Exception
     */
    public function testDiffWhenFilesContentAreEqual()
    {
        $file1 = $this->createTestFile("test 1");
        $file2 = $this->createTestFile("test 1");

        $this->childDiffer->expects("doDiff")->with(["test", "1"], ["test", "1"])->andReturn([]);

        $this->assertEquals([[], []], $this->differ->diff($file1, $file2));
    }

    private function createTestFile(string $content)
    {
        $file = new File();
        $file->setContent($content);
        return $file;
    }
}
