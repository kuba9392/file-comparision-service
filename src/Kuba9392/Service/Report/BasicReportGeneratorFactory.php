<?php


namespace Kuba9392\Service\Report;

use Kuba9392\Service\Email\BasicEmailSenderOptionsProvider;
use Kuba9392\Service\Email\EmailSender;
use Kuba9392\Service\Logger\ConsoleLogger;
use Kuba9392\Service\Logger\FileLogger;
use Kuba9392\Service\Sms\BasicSmsSenderOptionsProvider;
use Kuba9392\Service\Sms\SmsSender;

class BasicReportGeneratorFactory extends ReportGeneratorFactory
{
    public function createStrategies(ReportInterface $report): array
    {
        return [
            new LoggerReportGenerateStrategy($report, new ConsoleLogger()),
            new LoggerReportGenerateStrategy($report, new FileLogger()),
            new EmailReportGenerateStrategy(new EmailSender(new BasicEmailSenderOptionsProvider()), $report),
            new SmsReportGenerateStrategy(new SmsSender(new BasicSmsSenderOptionsProvider()), $report),
        ];
    }
}