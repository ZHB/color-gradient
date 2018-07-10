<?php

/*
 * (c) ZHB <vincent.huck.pro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zhb\Color\Exception;

class MissingGradientColorException extends AbstractException
{
    protected $message = 'Gradient colors must contain at least two hexadecimal colors.';
}
