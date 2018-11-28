<?php


namespace Kuba9392\Service\Report;


use Kuba9392\Service\Email\EmailSender;

class EmailReportGenerateStrategy implements ReportGenerateStrategy
{
    /**
     * @var EmailSender
     */
    private $sender;

    /**
     * @var Report
     */
    private $report;

    public function __construct(EmailSender $sender, ReportInterface $report)
    {
        $this->sender = $sender;
        $this->report = $report;
    }

    public function generate()
    {
        /** @var ReportFileData $fileData */
        foreach ($this->report->getData() as $fileData) {
            if (!empty($fileData->getContentDiffs()->getComparingData())) {
                $this->sender->send("test", "test");
                break;
            }
        }
    }
}