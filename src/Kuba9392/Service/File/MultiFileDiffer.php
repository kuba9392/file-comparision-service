<?php


namespace Kuba9392\Service\File;


class MultiFileDiffer implements FileDiffer
{
    /**
     * @var FileDiffer[]
     */
    private $differs;

    /**
     * @param FileDiffer[] $differs
     */
    public function __construct(array $differs)
    {
        $this->differs = $differs;
    }

    public function diff(File $firstFile, File $secondFile): array
    {
        $result = [];
        foreach($this->differs as $differ) {
            $result[$differ->getType()] = $differ->diff($firstFile, $secondFile);
        }
        return $result;
    }

    public function getType(): string
    {
        return "multi";
    }
}