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

use Twig_Token;
use Twig_TokenParser;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class TokenParser extends Twig_TokenParser
{
    /**
     * @var string
     */
    private $minifier;

    /**
     * @var string
     */
    private $tagName;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @param string $tagName
     * @param string $minifier
     * @param bool $enabled
     */
    public function __construct($tagName, $minifier, $enabled = true)
    {
        $this->tagName = $tagName;
        $this->minifier = $minifier;
        $this->enabled = (bool)$enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(Twig_Token $token)
    {
        $lineNumber = $token->getLine();

        $type = strtolower($this->parser->getStream()->expect(Twig_Token::NAME_TYPE)->getValue());

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse(
            function (Twig_Token $token) {
                return $token->test('end'.$this->tagName);
            },
            true
        );

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        if ($this->enabled) {
            return new Node($body, [], $lineNumber, $this->getTag(), $this->minifier, $type);
        }

        return $body;
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return $this->tagName;
    }
}
