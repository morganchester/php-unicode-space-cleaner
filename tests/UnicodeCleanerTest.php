<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Morganchester\UnicodeCleaner\UnicodeCleaner;

final class UnicodeCleanerTest extends TestCase
{
    public function testBasicCleanup(): void
    {
        $input = "\u{200B}\u{00A0} Hello\u{202F}\u{FEFF} World \u{3000}";
        $expected = "Hello World";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }

    public function testRemovesMultipleSpecialSpaces(): void
    {
        $input = "\u{200B}\u{200C}\u{200D}\u{202F}Text\u{200E}\u{3000}\u{FEFF}Here";
        $expected = "Text Here";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }

    public function testTrimsEdgeCases(): void
    {
        $input = "\u{3000}\u{200B}\u{FEFF}Trim me\u{200B}\u{3000}";
        $expected = "Trim me";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }

    public function testMultipleReplacementsBecomeOneSpace(): void
    {
        $input = "One\u{2009}\u{200A}\u{202F}\u{200B}Two";
        $expected = "One Two";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }

    public function testNoSpecialCharacters(): void
    {
        $input = "Nothing to clean here.";
        $expected = "Nothing to clean here.";
        $this->assertSame($expected, UnicodeCleaner::clean($input));
    }
}
