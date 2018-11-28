<?php


namespace Kuba9392\Service\Sms;


class BasicSmsSenderOptionsProvider implements SmsSenderOptionsProvider
{
    public function get()
    {
        return "sender_options";
    }
}