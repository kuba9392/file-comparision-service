<?php


namespace Kuba9392\Service\Email;


class EmailSender
{
    /**
     * @var EmailSenderOptionsProvider
     */
    private $options;

    public function __construct(EmailSenderOptionsProvider $options)
    {
        $this->options = $options;
    }

    public function send(string $title, string $message, array $extra=null)
    {
        printf("sending email message %s with content %s and extraData(%s). options: %s".PHP_EOL,
            $title,
            $message,
            json_encode($extra),
            $this->options->get()
        );
    }
}