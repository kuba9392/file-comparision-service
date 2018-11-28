<?php


namespace Kuba9392\Service\File;


class MultiFileDiffsReader
{
    /**
     * @var FileDiffer
     */
    private $differ;

    public function __construct(FileDiffer $multiDiffer)
    {
        $this->differ = $multiDiffer;
    }

    /**
     * @param File $file
     * @param File[] $filesToCompare
     * @return array
     */
    public function read(File $file, array $filesToCompare): array
    {
        $result = [];
        foreach($filesToCompare as $fileToCompare) {
            $result[$fileToCompare->getName()] = $this->differ->diff($file, $fileToCompare);
        }
        return $result;
    }
}