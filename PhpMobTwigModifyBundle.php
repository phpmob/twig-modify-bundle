<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpMob\TwigModifyBundle;

use PhpMob\TwigModifyBundle\DependencyInjection\PhpMobTwigModifyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class PhpMobTwigModifyBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new PhpMobTwigModifyExtension();
    }
}
