<?php


namespace Kuba9392\Service\Sms;


class SmsSender
{
    /**
     * @var SmsSenderOptionsProvider
     */
    private $options;

    public function __construct(SmsSenderOptionsProvider $options)
    {
        $this->options = $options;
    }

    public function send(string $title, string $message, array $extra=null)
    {
        printf("sending sms message %s with content %s and extraData(%s). options: %s".PHP_EOL,
            $title,
            $message,
            json_encode($extra),
            $this->options->get()
        );
    }
}