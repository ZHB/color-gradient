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
     * @param int   $value           Value to get the color
     * @param int   $min             Minimal gradient value
     * @param int   $max             maximal gradient value
     * @param array $gradientColors  Colors range
     *
     * @throws MissingGradientColorException
     * @throws OutOfRangeException
     *
     * @return string
     */
    public static function numberToGradientColor(int $value, int $min, int $max, array $gradientColors): string
    {
        if ($min > $value) {
            throw new OutOfRangeException(sprintf('Value must be greater than %d.', $min));
        }

        if ($max < $value) {
            throw new OutOfRangeException(sprintf('Value must be smaller than %d.', $max));
        }

        if (2 > $gradientsCount = count($gradientColors)) {
            throw new MissingGradientColorException();
        }

        $distFromMin = $value / $max;

        list($startColor, $endColor) = $gradientColors;

        if (2 < $gradientsCount) {
            $startColor = $gradientColors[(int) floor($distFromMin * ($gradientsCount - 1))];
            $endColor = $gradientColors[(int) ceil($distFromMin * ($gradientsCount - 1))];

            $distFromMin *= $gradientsCount - 1;
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
