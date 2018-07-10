<?php

/*
 * (c) ZHB <vincent.huck.pro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zhb\Color\Exception;

class OutOfRangeException extends AbstractException
{
    protected $message = '$value is not between $min and $max range.';
}
