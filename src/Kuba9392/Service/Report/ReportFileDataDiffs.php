<?php


namespace Kuba9392\Service\Report;


class ReportFileDataDiffs
{
    /**
     * @var mixed
     */
    private $originalData;

    /**
     * @var mixed
     */
    private $comparingData;

    public static function createFromData(array $diffData): self
    {
        $diffs = new ReportFileDataDiffs();
        $diffs->setOriginalData($diffData[0]);
        $diffs->setComparingData($diffData[1]);
        return $diffs;
    }

    public function getOriginalData()
    {
        return $this->originalData;
    }

    public function getOriginalDataJson(): string
    {
        return json_encode($this->getOriginalData(), JSON_UNESCAPED_UNICODE);
    }

    public function setOriginalData($originalData): void
    {
        $this->originalData = $originalData;
    }

    public function getComparingData()
    {
        return $this->comparingData;
    }

    public function getComparingDataJson(): string
    {
        return json_encode($this->getComparingData(), JSON_UNESCAPED_UNICODE);
    }

    public function setComparingData($comparingData): void
    {
        $this->comparingData = $comparingData;
    }
}