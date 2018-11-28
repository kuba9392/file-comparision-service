<?php


namespace Kuba9392\Service\Email;


class BasicEmailSenderOptionsProvider implements EmailSenderOptionsProvider
{
    public function get()
    {
        return "sender_options";
    }
}