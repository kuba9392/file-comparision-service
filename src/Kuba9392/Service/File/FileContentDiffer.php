<?php


namespace Kuba9392\Service\File;


use Diff\Differ\Differ;
use Diff\Differ\ListDiffer;
use Diff\DiffOp\DiffOpAdd;
use Diff\DiffOp\DiffOpRemove;

class FileContentDiffer implements FileDiffer
{
    /**
     * @var null | Differ
     */
    private $differ;

    public function __construct(?Differ $differ = null)
    {
        $this->differ = $differ ? $differ : new ListDiffer();
    }

    /**
     * @param File $firstFile
     * @param File $secondFile
     * @return array
     * @throws \Exception
     */
    public function diff(File $firstFile, File $secondFile): array
    {
        $words1 = explode(" ", $firstFile->getContent());
        $words2 = explode(" ", $secondFile->getContent());

        return $this->getDiffValues($this->differ->doDiff($words1, $words2));
    }

    protected function getDiffValues($diffs): array
    {
        $addedValues = [];
        $removedValues = [];
        foreach ($diffs as $diff) {
            if ($diff instanceof DiffOpAdd) {
                $addedValues[] = $diff->getNewValue();
            }

            if ($diff instanceof DiffOpRemove) {
                $removedValues[] = $diff->getOldValue();
            }
        }
        return array($removedValues, $addedValues);
    }

    public function getType(): string
    {
        return "content";
    }
}