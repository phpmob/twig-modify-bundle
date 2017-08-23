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

use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class HTMLPurify
{
    /**
     * @param $content
     * @param array $options
     *
     * @return bool|string
     */
    public static function purify($content, array $options = [])
    {
        $config = HTMLPurifier_Config::createDefault();

        foreach ($options as $key => $value) {
            $config->set($key, $value);
        }

        if (!file_exists($config->get('Cache.SerializerPath'))) {
            mkdir($config->get('Cache.SerializerPath'));
        }

        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }
}
