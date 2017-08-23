<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpMob\TwigModifyBundle\Twig;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Extension extends \Twig_Extension
{
    /**
     * @var object
     */
    private $modifier;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * Twig extension based on bundle optionsuration.
     *
     * @param object $modifier class
     * @param bool $enabled
     */
    public function __construct($modifier, $enabled = true)
    {
        $this->modifier = $modifier;
        $this->enabled = (bool)$enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            new TokenParser('modify', get_class($this->modifier), $this->enabled),
        );
    }
}
