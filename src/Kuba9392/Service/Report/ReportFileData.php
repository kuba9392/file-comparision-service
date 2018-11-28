<?php


namespace Kuba9392\Service\Report;


class ReportFileData implements ReportFileDataInterface
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var ReportFileDataDiffs
     */
    private $contentDiffs;

    /**
     * @var ReportFileDataDiffs
     */
    private $encodingDiffs;

    /**
     * @var ReportFileDataDiffs
     */
    private $sizeDiffs;

    /**
     * @param string $fileName
     * @param array $diffData
     * @return ReportFileData
     */
    public static function createFromData(string $fileName, array $diffData): ReportFileDataInterface
    {
        $data = new ReportFileData();
        $data->setFileName($fileName);

        foreach($diffData as $diffType => $diffContent) {
            $diffs = ReportFileDataDiffs::createFromData($diffContent);

            switch($diffType) {
                case "content":
                    $data->setContentDiffs($diffs);
                    break;
                case "encoding":
                    $data->setEncodingDiffs($diffs);
                    break;
                case "size":
                    $data->setSizeDiffs($diffs);
                    break;
            }
        }

        return $data;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getContentDiffs(): ReportFileDataDiffs
    {
        return $this->contentDiffs;
    }

    public function setContentDiffs(ReportFileDataDiffs $contentDiffs): void
    {
        $this->contentDiffs = $contentDiffs;
    }

    public function getEncodingDiffs(): ReportFileDataDiffs
    {
        return $this->encodingDiffs;
    }

    public function setEncodingDiffs(ReportFileDataDiffs $encodingDiffs): void
    {
        $this->encodingDiffs = $encodingDiffs;
    }

    public function getSizeDiffs(): ReportFileDataDiffs
    {
        return $this->sizeDiffs;
    }

    public function setSizeDiffs(ReportFileDataDiffs $sizeDiffs): void
    {
        $this->sizeDiffs = $sizeDiffs;
    }

    public function toArray(): array
    {
        $removed = $this->getContentDiffs()->getOriginalDataJson();
        $added = $this->getContentDiffs()->getComparingDataJson();

        $oEncoding = $this->getEncodingDiffs()->getOriginalDataJson();
        $cEncoding = $this->getEncodingDiffs()->getComparingDataJson();

        $oSize = $this->getSizeDiffs()->getOriginalData();
        $cSize = $this->getSizeDiffs()->getComparingData();

        return [
            sprintf("Comparing file %s", $this->getFileName()),
            sprintf("[CONTENT] Removed values: %s, Added values: %s", $removed, $added),
            sprintf("[ENCODING] Original encoding: %s, Comparing file encoding: %s", $oEncoding, $cEncoding),
            sprintf("[SIZE] Original size: %d b, Comparing file size: %d b", $oSize, $cSize)
        ];
    }
}