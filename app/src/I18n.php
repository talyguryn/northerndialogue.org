<?php

namespace App;

use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;

class I18n {

    const COOKIE_NAME = 'lang';
    const GET_PARAM_NAME = 'lang';

    private $container;

    private $settings;

    private $twig;

    private $lang;

    public function __construct($container) {
        $this->container = $container;

        $this->settings = $this->container->get('settings')['lang'];

        $this->twig = $container['view']->getEnvironment();
    }

    public function __invoke($request, $response, $next) {
        /**
         * Detect language
         */
        $this->lang = $this->getLang($request);

        /**
         * Save lang param to cookies
         */
        $response = $this->setLang($response);

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

    public function getLang($request): string
    {
        /**
         * Get lang from GET params
         */
        $langFromGET = $_GET[self::GET_PARAM_NAME];

        /**
         * Get lang from cookies
         */
        $langFromCookie = FigRequestCookies::get($request, self::COOKIE_NAME)->getValue();

        /**
         * Get lang from headers
         */
        $langFromHeaders = $this->getBrowserLang();

        /**
         * Detect requested lang by variables fallback chain
         */
        $requestedLang = $langFromGET ?: $langFromCookie ?: $langFromHeaders;

        /**
         * If this lang is not available then use default for site
         */
        if (!in_array($requestedLang, $this->settings['available'])) {
            $requestedLang = $this->settings['default'];
        }

        return $requestedLang;
    }

    private function setLang($response) {
        return FigResponseCookies::set(
            $response,
            SetCookie::create(self::COOKIE_NAME)
                     ->withValue($this->lang)
        );
    }

    public function getBrowserLang() {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }

        return;
    }
}