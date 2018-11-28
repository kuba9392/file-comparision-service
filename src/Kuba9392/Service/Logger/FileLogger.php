<?php


namespace Kuba9392\Service\Logger;


class FileLogger implements Logger
{
    public function log(string $content, ...$args)
    {
        file_put_contents($this->getProjectHomeDir() ."/diff.txt", $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    protected function getProjectHomeDir(): string
    {
        return dirname(dirname(dirname(dirname(__DIR__))));
    }
}