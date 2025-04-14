<?php

namespace Morganchester\UnicodeCleaner;

class UnicodeCleaner
{
    public static function clean(string $str): string
    {
        $unicode_spaces = [
            "\u{0009}", "\u{000A}", "\u{000B}", "\u{000C}", "\u{000D}",
            "\u{0020}", "\u{0085}", "\u{00A0}", "\u{1680}", "\u{180E}",
            "\u{2000}", "\u{2001}", "\u{2002}", "\u{2003}", "\u{2004}",
            "\u{2005}", "\u{2006}", "\u{2007}", "\u{2008}", "\u{2009}",
            "\u{200A}", "\u{200B}", "\u{200C}", "\u{200D}", "\u{2028}",
            "\u{2029}", "\u{202F}", "\u{205F}", "\u{2060}", "\u{3000}",
            "\u{FEFF}", "\u{200E}", "\u{200F}",
        ];

        $pattern = '/(?:' . implode('|', array_map(fn($c) => preg_quote($c, '/'), $unicode_spaces)) . ')+/u';
        $cleaned = preg_replace($pattern, ' ', $str);
        return trim($cleaned);
    }
}
