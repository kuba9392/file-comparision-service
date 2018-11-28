<?php


namespace Kuba9392\Service\Logger;


interface Logger
{
    public function log(string $content, ...$args);
}