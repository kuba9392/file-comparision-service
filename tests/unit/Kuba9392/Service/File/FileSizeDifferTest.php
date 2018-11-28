<?php

namespace Kuba9392\Service\File;


use PHPUnit\Framework\TestCase;

class FileSizeDifferTest extends TestCase
{
    /**
     * @var FileSizeDiffer
     */
    private $differ;

    public function setUp()
    {
        $this->differ = new FileSizeDiffer();
    }

    public function testDiffWhenFileSizesAreDifferent()
    {
        $file1 = $this->createTestFile(1);
        $file2 = $this->createTestFile(2);

        $this->assertEquals([1, 2], $this->differ->diff($file1, $file2));
    }

    public function testDiffWhenFileSizesAreEqual()
    {
        $file1 = $this->createTestFile(1);
        $file2 = $this->createTestFile(1);

        $this->assertEquals([1, 1], $this->differ->diff($file1, $file2));
    }

    private function createTestFile(int $size)
    {
        $file = new File();
        $file->setSize($size);
        return $file;
    }
}
