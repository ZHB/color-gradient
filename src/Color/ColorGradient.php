<?php

/*
 * (c) ZHB <vincent.huck.pro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zhb\Color;

use Zhb\Color\Exception\MissingGradientColorException;
use Zhb\Color\Exception\OutOfRangeException;

class ColorGradient
{
    /**
     * Return an hexadecimal color between a gradient colors range based on the current value.
     *
     * @param int   $value
     * @param int   $min
     * @param int   $max
     * @param array $gradientColors
     *
     * @throws MissingGradientColorException
     * @throws OutOfRangeException
     *
     * @return string
     */
    public static function numberToGradientColor(int $value, int $min, int $max, array $gradientColors): string
    {
        if ($min > $value) {
            throw new OutOfRangeException(sprintf('$value must be greater than %d.', $min));
        }

        if ($max < $value) {
            throw new OutOfRangeException(sprintf('$value must be smaller than %d.', $max));
        }

        if (2 > count($gradientColors)) {
            throw new MissingGradientColorException();
        }

        $distFromMin = $value / $max;

        $startColor = $gradientColors[0];
        $endColor = $gradientColors[1];

        if (count($gradientColors) > 2) {
            $startColor = $gradientColors[(int) floor($distFromMin * (count($gradientColors) - 1))];
            $endColor = $gradientColors[(int) ceil($distFromMin * (count($gradientColors) - 1))];

            $distFromMin *= count($gradientColors) - 1;
            while ($distFromMin > 1) {
                --$distFromMin;
            }
        }

        list($ra, $ga, $ba) = sscanf($startColor, '#%02x%02x%02x');
        list($rz, $gz, $bz) = sscanf($endColor, '#%02x%02x%02x');

        $distDiff = 1 - $distFromMin;
        $r = min(max(0, (int) (($rz * $distFromMin) + ($ra * $distDiff))), 255);
        $g = min(max(0, (int) (($gz * $distFromMin) + ($ga * $distDiff))), 255);
        $b = min(max(0, (int) (($bz * $distFromMin) + ($ba * $distDiff))), 255);

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
