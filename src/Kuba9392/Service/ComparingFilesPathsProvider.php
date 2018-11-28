<?php


namespace Kuba9392\Service;


interface ComparingFilesPathsProvider
{
    /**
     * @return string[]
     */
    public function get(): array;
}