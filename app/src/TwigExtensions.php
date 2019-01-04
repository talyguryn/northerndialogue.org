<?php

namespace App;

use Slim\Views\TwigExtension;

class TwigExtensions extends TwigExtension {

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;

        parent::__construct($container->get('router'), $container->get('request')->getUri());
    }

    public function getName() {
        return 'twigExtensions';
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('dict', array($this, 'dict')),
            new \Twig_SimpleFunction('filemtime', array($this, 'filemtime')),
        ];
    }

    public function dict($phrase) {
        return $this->container->dictionary[$phrase] ?? $phrase;
    }

    /**
     * {{ filemtime('/public/bundle.js') }} -> /public/bundle.js?v=1546556483
     *
     * @param string $file_path
     *
     * @return string
     */
    public function filemtime($file_path) {
        $change_date = @filemtime(PROJECT_ROOT . 'public' . $file_path);

        if (!$change_date) {
            $change_date = 0;
        }

        return $file_path . '?v=' . $change_date;
    }
}