<?php

namespace App;

class I18n {

    private $container;

    private $settings;

    private $twig;

    private $lang;

    public function __construct($container) {
        $this->container = $container;

        $this->settings = $this->container->get('settings')['lang'];

        $this->twig = $container['view']->getEnvironment();
    }

    public function __invoke($request, $response, $next)
    {
        $this->lang = $this->getLang();

        $STAILang = new STAILang($this->lang, $this->settings['folder']);

        $dictionaryArray = $STAILang->getFileAsArray();

        $this->twig->addGlobal('lang', $this->lang);

        $this->container['lang'] = function () {
            return $this->lang;
        };

        $this->container['dictionary'] = function () use ($dictionaryArray){
            return $dictionaryArray;
        };

        return $next($request, $response);
    }

    public function getLang()
    {
        // todo detect $requestedLang
        $requestedLang = $_GET['lang'];

        if (!in_array($requestedLang, $this->settings['available'])) {
            $requestedLang = $this->settings['default'];
        }

        return $requestedLang;
    }

    // todo function set lang



//    public function getBrowserLang(){
//        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
//            return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//        } else {
//            return $this->defaultLang;
//        }
//    }
}