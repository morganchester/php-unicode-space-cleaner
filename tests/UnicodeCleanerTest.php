<?php

use PHPUnit\Framework\TestCase;
use UnicodeCleaner\UnicodeCleaner;

class UnicodeCleanerTest extends TestCase
{
    public function testCleaning()
    {
        $input = "\u{200B}\u{00A0} Hello\u{202F}\u{FEFF} World \u{3000}";
        $expected = "Hello World";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }
}
