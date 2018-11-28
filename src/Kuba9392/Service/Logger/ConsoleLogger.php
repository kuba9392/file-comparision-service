<?php


namespace Kuba9392\Service\Logger;


class ConsoleLogger implements Logger
{
    public function log(string $content, ...$args)
    {
        printf($content.PHP_EOL, ...$args);
    }
}