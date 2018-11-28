<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\File\File;

class Report implements ReportInterface
{
    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var File
     */
    private $file;

    /**
     * @var ReportFileData[]
     */
    private $data;

    /**
     * @param \DateTime $date
     * @param File $file
     * @param array $filesData
     * @return Report
     */
    public static function create(\DateTime $date, File $file, array $filesData): ReportInterface
    {
        $report = new self();
        $report->setFile($file);
        $report->setDate($date);

        $data = [];
        foreach($filesData as $fileName => $diffsData) {
            $data[] = ReportFileData::createFromData($fileName, $diffsData);
        }

        $report->setData($data);
        return $report;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): void
    {
        $this->file = $file;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        $reportArray = $this->getReportHeader();
        foreach($this->getData() as $fileData) {
            foreach ($fileData->toArray() as $fileDataRow) {
                $reportArray[] = $fileDataRow;
            }
        }
        return $reportArray;
    }

    private function getReportHeader(): array
    {
        return [
            sprintf("Date: %s", $this->getDate()->format("Y-m-d H:i:s")),
            sprintf("Size: %d b", $this->getFile()->getSize()),
            "Differences:",
        ];
    }
}