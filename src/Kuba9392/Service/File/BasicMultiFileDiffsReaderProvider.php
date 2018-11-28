<?php


namespace Kuba9392\Service\File;


use Diff\Differ\ListDiffer;

class BasicMultiFileDiffsReaderProvider implements MultiFileDiffsReaderProvider
{
    public function get(): MultiFileDiffsReader
    {
        return new MultiFileDiffsReader(new MultiFileDiffer([
            new FileContentDiffer(new ListDiffer()),
            new FileEncodingDiffer(),
            new FileSizeDiffer()
        ]));
    }
}