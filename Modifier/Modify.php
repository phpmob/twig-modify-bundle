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

use Symfony\Component\Cache\Adapter\AdapterInterface;

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
     * @param AdapterInterface $cache
     * @param array $types
     */
    public function __construct(AdapterInterface $cache = null, array $types = [])
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
     * @param $type
     * @return mixed
     *
     * @throws \Psr\Cache\InvalidArgumentException
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

        if (self::$cache && self::$cache->hasItem($cacheId)) {
            return self::$cache->getItem($cacheId)->get();
        }

        $content = call_user_func_array(
            [$modifier['class'], $modifier['method']],
            [$content, $modifier['options']]
        );

        self::$cache && self::$cache->save(self::$cache->getItem($cacheId)->set($content));

        return $content;
    }
}
