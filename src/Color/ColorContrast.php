<?php

/*
 * (c) ZHB <vincent.huck.pro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zhb\Color;

class ColorContrast
{
    /**
     * Return the best white or black hexadecimal based on the luminosity ratio between a given background color.
     *
     * @param string $backgroundColor
     * @param string $textColor
     *
     * @return string
     */
    public static function brightnessContrastRatio(string $backgroundColor, string $textColor): string
    {
        list($r1, $g1, $b1) = sscanf($backgroundColor, '#%02x%02x%02x');
        list($r2, $g2, $b2) = sscanf($textColor, '#%02x%02x%02x');

        $l1 = 0.2126 * (($r1 / 255) ** 2.2) + 0.7152 * (($g1 / 255) ** 2.2) + 0.0722 * (($b1 / 255) ** 2.2);
        $l2 = 0.2126 * (($r2 / 255) ** 2.2) + 0.7152 * (($g2 / 255) ** 2.2) + 0.0722 * (($b2 / 255) ** 2.2);

        if ($l1 > $l2) {
            $ratio = ($l1 + 0.05) / ($l2 + 0.05);
        } else {
            $ratio = ($l2 + 0.05) / ($l1 + 0.05);
        }

        return $ratio;
    }

    /**
     * Return black or white hexadecimal color that fit best (best contrast ratio) with a given background color.
     *
     * @param string $backgroundColor
     * @param int    $ratioBreak
     *
     * @return string
     */
    public static function blackOrWhite(string $backgroundColor, int $ratioBreak = 5): string
    {
        $ratio = self::brightnessContrastRatio($backgroundColor, '#000000');

        return $ratio < $ratioBreak ? '#ffffff' : '#000000';
    }
}
