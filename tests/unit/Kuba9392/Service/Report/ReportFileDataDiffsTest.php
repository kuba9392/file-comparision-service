<?php

namespace Kuba9392\Service\Report;

use PHPUnit\Framework\TestCase;

class ReportFileDataDiffsTest extends TestCase
{

    public function testCreateFromDataWhenDataExists()
    {
        $diffData = [
            "a", "b"
        ];

        $diff = ReportFileDataDiffs::createFromData($diffData);
        $this->assertEquals("a", $diff->getOriginalData());
        $this->assertEquals("b", $diff->getComparingData());
    }
}
