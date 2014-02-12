<?php
// Markdown Parser Extension for Bolt, by Prasetyo Wicaksono

namespace MarkdownParser;

require_once "vendor/autoload.php";

use Ciconia\Ciconia;
use Ciconia\Extension\Gfm;

class Extension extends \Bolt\BaseExtension
{

    /**
     * Info block for Markdown Parser Extension.
     */
    function info()
    {
        $data = array(
            'name' => "Markdown Parser",
            'description' => "Parse mardown text",
            'keywords' => "markdown",
            'author' => "Prasetyo Wicaksono",
            'link' => "http://google.com/",
            'version' => "0.1",
            'required_bolt_version' => "1.0",
            'highest_bolt_version' => "1.0",
            'type' => "Twig function",
            'first_releasedate' => "2014-02-12",
            'latest_releasedate' => "2014-02-12",
        );

        return $data;

    }

    /**
     * Initialize Markdown Parser. Called during bootstrap phase.
     */
    function initialize()
    {
        // If your extension has a 'config.yml', it is automatically loaded.
        // $foo = $this->config['bar'];

        // Initialize the Twig function
        $this->addTwigFunction('markdown', 'twigMarkdown');

    }


    /**
     * Twig function {{ markdown('foo') }} in Markdown Parser extension.
     */
    function twigMarkdown($param="")
    {
        $ciconia = new Ciconia();

        $ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
        $ciconia->addExtension(new Gfm\TaskListExtension());
        $ciconia->addExtension(new Gfm\InlineStyleExtension());
        $ciconia->addExtension(new Gfm\WhiteSpaceExtension());
        $ciconia->addExtension(new Gfm\TableExtension());
        $ciconia->addExtension(new Gfm\UrlAutoLinkExtension());

        $html = $ciconia->render($param);

        return new \Twig_Markup($html, 'UTF-8');

    }


}


