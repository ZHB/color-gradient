<?php

/*
 * (c) ZHB <vincent.huck.pro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Zhb\Color\ColorContrast;
use Zhb\Color\ColorGradient;

require_once __DIR__.'/../vendor/autoload.php';

echo '<br />White to purple without text color contrast ratio<br />';
for ($i = 0; $i <= 30; ++$i) {
    $color = ColorGradient::numberToGradientColor($i, $min = 0, $max = 30, $gradientColors = ['#ffffff', '#FF00FF', '#000000']);

    echo addCell($i, '#000000', $color);
}

echo '<br /><br />White to purple with text color contrast ratio<br />';
for ($i = 0; $i <= 30; ++$i) {
    $color = ColorGradient::numberToGradientColor($i, $min = 0, $max = 30, $gradientColors = ['#ffffff', '#FF00FF', '#000000']);

    echo addCell($i, ColorContrast::blackOrWhite($color), $color);
}

echo '<br /><br />White to green to white<br />';
for ($i = 0; $i <= 20; ++$i) {
    $color = ColorGradient::numberToGradientColor($i, $min = 0, $max = 20, $gradientColors = ['#ffffff', '#00FF00', '#ffffff']);

    echo addCell($i, ColorContrast::blackOrWhite($color), $color);
}

echo '<br /><br />Red to cyan to yellow to lime to brown<br />';
for ($i = 0; $i <= 40; ++$i) {
    $color = ColorGradient::numberToGradientColor($i, $min = 0, $max = 40, $gradientColors = ['#ff0000', '#00ffff', '#ffff00', '#00ff00', '#a52a2a']);

    echo addCell($i, ColorContrast::blackOrWhite($color), $color);
}

function addCell($value, $textColor, $backgroundColor)
{
    return "<div style='font-weight:bold; display:inline-block; width:30px; font-size:16px; color: ".$textColor.'; background-color:'.$backgroundColor."; text-align:center'>".$value.'</div>';
}
