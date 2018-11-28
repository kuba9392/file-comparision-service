<?php


namespace Kuba9392\Service;


class EnvComparingFilesPathsProvider implements ComparingFilesPathsProvider
{
    const ENV_COMPARING_FILES_PATHS = "COMPARING_FILES_PATHS";

    public function get(): array
    {
        return explode(",", getenv(self::ENV_COMPARING_FILES_PATHS));
    }
}