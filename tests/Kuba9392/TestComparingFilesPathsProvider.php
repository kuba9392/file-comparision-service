<?php


namespace Kuba9392;

use Kuba9392\Service\ComparingFilesPathsProvider;

class TestComparingFilesPathsProvider implements ComparingFilesPathsProvider
{
    /**
     * @var array;
     */
    private $filePaths;

    public function __construct(array $filePaths)
    {
        $this->filePaths = $filePaths;
    }

    public function get(): array
    {
        return $this->filePaths;
    }
}