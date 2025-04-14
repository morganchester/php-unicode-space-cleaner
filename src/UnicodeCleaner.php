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


    public static function cleanTotal(string $str): string
    {
        $unicode_trash = [
            // ASCII standard
            "\u{0000}", "\u{0001}", "\u{0002}", "\u{0003}", "\u{0004}", "\u{0005}", "\u{0006}", "\u{0007}",
            "\u{0008}", "\u{0009}", "\u{000A}", "\u{000B}", "\u{000C}", "\u{000D}", "\u{001C}", "\u{001D}",
            "\u{001E}", "\u{001F}", "\u{0020}", "\u{007F}",

            // Special symbols and formatting
            "\u{0085}", "\u{00A0}", "\u{1680}", "\u{180E}", "\u{2000}", "\u{2001}", "\u{2002}", "\u{2003}",
            "\u{2004}", "\u{2005}", "\u{2006}", "\u{2007}", "\u{2008}", "\u{2009}", "\u{200A}", "\u{2028}",
            "\u{2029}", "\u{202F}", "\u{205F}", "\u{2060}", "\u{3000}", "\u{FEFF}",

            // Zero-width & joiners
            "\u{200B}", "\u{200C}", "\u{200D}",

            // bi-directional control chars
            "\u{200E}", "\u{200F}", "\u{202A}", "\u{202B}", "\u{202C}", "\u{202D}", "\u{202E}",
            "\u{2066}", "\u{2067}", "\u{2068}", "\u{2069}",

            // Hidden and dangerous symbols / Unicode spoofing
            "\u{034F}",   // COMBINING GRAPHEME JOINER
            "\u{061C}",   // ARABIC LETTER MARK (direction control)
            "\u{17B4}", "\u{17B5}", // Khmer invisible characters
            "\u{180B}", "\u{180C}", "\u{180D}", // Mongolian free variation selectors
            "\u{200E}", "\u{200F}", "\u{202A}",

            // Additional variations
            "\u{FFF9}", "\u{FFFA}", "\u{FFFB}", // Interlinear annotation
            "\u{1D173}", "\u{1D174}", "\u{1D175}", "\u{1D176}", "\u{1D177}", "\u{1D178}", "\u{1D179}", "\u{1D17A}", // Musical notation control
        ];

        $pattern = '/(?:' . implode('|', array_map(fn($c) => preg_quote($c, '/'), $unicode_trash)) . ')+/u';
        $cleaned = preg_replace($pattern, ' ', $str);
        return trim($cleaned);
    }

}
