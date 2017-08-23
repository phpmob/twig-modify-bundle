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

use tubalmartin\CssMin\Minifier;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class CSSMin
{
    /**
     * @param $content
     * @param array $options
     *
     * @return string
     */
    public static function minify($content, array $options = [])
    {
        $compressor = new Minifier();

        if (array_key_exists('remove_important_comments', $options)) {
            $compressor->removeImportantComments($options['remove_important_comments']);
        }

        if (array_key_exists('keep_source_map_comment', $options)) {
            $compressor->keepSourceMapComment($options['keep_source_map_comment']);
        }

        return $compressor->run($content);
    }
}
