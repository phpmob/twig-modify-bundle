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

use Doctrine\Common\Cache\Cache;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Modify
{
    static private $cache;

    /**
     * @var array
     */
    static private $types = [];

    /**
     * @param Cache $cache
     * @param array $types
     */
    public function __construct(Cache $cache = null, array $types = [])
    {
        self::$cache = $cache;
        self::$types = $types;
    }

    /**
     * @param $type
     * @param $minifier
     */
    public static function addType($type, $minifier)
    {
        self::$types[$type] = $minifier;
    }

    /**
     * @param $content
     * @param string $type
     *
     * @return string
     */
    public static function modify($content, $type)
    {
        if (!array_key_exists($type, self::$types)) {
            throw new \LogicException(sprintf("Unsuported type `%s` of minifier.", $type));
        }

        $modifier = self::$types[$type];

        if (!$modifier['enabled']) {
            return $content;
        }

        $cacheId = md5($content);

        if (self::$cache && self::$cache->contains($cacheId)) {
            return self::$cache->fetch($cacheId);
        }

        $content = call_user_func_array(
            [$modifier['class'], $modifier['method']],
            [$content, $modifier['options']]
        );

        self::$cache && self::$cache->save($cacheId, $content);

        return $content;
    }
}
