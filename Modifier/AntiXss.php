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

use voku\helper\AntiXSS as VokuAntiXss;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class AntiXss
{
    /**
     * @param $content
     * @param array $options
     *
     * @return bool|string
     */
    public static function modify($content, array $options = [])
    {
        $antiXss = new VokuAntiXss();

        return $antiXss->xss_clean($content);
    }
}
