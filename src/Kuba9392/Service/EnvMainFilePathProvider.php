<?php


namespace Kuba9392\Service;


class EnvMainFilePathProvider implements MainFilePathProvider
{
    const ENV_MAIN_FILE_PATH = "MAIN_FILE_PATH";

    public function get(): string
    {
        return getenv(self::ENV_MAIN_FILE_PATH);
    }
}