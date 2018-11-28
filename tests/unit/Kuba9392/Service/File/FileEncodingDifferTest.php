<?php

namespace Kuba9392\Service\File;

use PHPUnit\Framework\TestCase;

class FileEncodingDifferTest extends TestCase
{
    /**
     * @var FileEncodingDiffer
     */
    private $differ;

    public function setUp()
    {
        $this->differ = new FileEncodingDiffer();
    }

    public function testDiffWhenFileEncodingAreDifferent()
    {
        $file1 = $this->createTestFile("a");
        $file2 = $this->createTestFile("b");

        $this->assertEquals(["a", "b"], $this->differ->diff($file1, $file2));
    }

    public function testDiffWhenFileEncodingAreEqual()
    {
        $file1 = $this->createTestFile("a");
        $file2 = $this->createTestFile("a");

        $this->assertEquals(["a", "a"], $this->differ->diff($file1, $file2));
    }

    private function createTestFile(string $encoding)
    {
        $file = new File();
        $file->setEncoding($encoding);
        return $file;
    }
}
