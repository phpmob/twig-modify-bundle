<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpMob\TwigModifyBundle\Modifier;

use JShrink\Minifier;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class JSMin
{
    /**
     * @param $content
     * @param array $options
     *
     * @return bool|string
     */
    public static function minify($content, array $options = [])
    {
        return Minifier::minify($content, $options);
    }
}
