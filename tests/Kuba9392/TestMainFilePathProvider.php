<?php


namespace Kuba9392;

use Kuba9392\Service\MainFilePathProvider;

class TestMainFilePathProvider implements MainFilePathProvider
{
    /**
     * @var string;
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function get(): string
    {
        return $this->filePath;
    }
}