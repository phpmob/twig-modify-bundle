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

use Twig_Compiler;
use Twig_Node;

/**
 * @author Ishmael Doss <nukboon@gmail.com>
 */
class Node extends Twig_Node
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $minifier;

    public function __construct(Twig_Node $body, array $attrs, $lineNumber, $tag, $minifier, $type)
    {
        parent::__construct(['body' => $body], $attrs, $lineNumber, $tag);

        $this->minifier = $minifier;
        $this->type = strtolower($type);

    }

    /**
     * {@inheritdoc}
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write("echo $this->minifier::modify(")
            ->raw('trim(ob_get_clean()), \''.$this->type."'")
            ->raw(");\n");
    }
}
