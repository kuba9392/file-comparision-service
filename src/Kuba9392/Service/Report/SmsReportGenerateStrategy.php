<?php


namespace Kuba9392\Service\Report;



use Kuba9392\Service\Sms\SmsSender;

class SmsReportGenerateStrategy implements ReportGenerateStrategy
{
    /**
     * @var SmsSender
     */
    private $sender;

    /**
     * @var Report
     */
    private $report;

    public function __construct(SmsSender $sender, ReportInterface $report)
    {
        $this->sender = $sender;
        $this->report = $report;
    }

    public function generate()
    {
        /** @var ReportFileData $fileData */
        foreach ($this->report->getData() as $fileData) {
            if ($fileData->getEncodingDiffs()->getOriginalData() !== $fileData->getEncodingDiffs()->getComparingData()) {
                $this->sender->send("test", "test");
                break;
            }
        }
    }
}