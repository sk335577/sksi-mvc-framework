<?php

namespace SKSI\Lib\Framework;

class View {

    protected $paths = array();
    protected $translator = null;

    public function __construct($paths = array()) {
        $this->paths = $paths;
    }

    public function setTranslator($translator) {
        $this->translator = $translator;
    }

    public function translate($string, $default = '') {
        return $this->translator->translate($string,$default);
    }

    public function setData($data) {
        foreach ($data as $data_key => $value) {
            $this->{$data_key} = $value;
        }
    }

    public function renderTemplate($template = null) {
//        extract($data, EXTR_SKIP);

        if ($template == null) {
            $class = debug_backtrace()[1]['class'];
            $class = (explode('\\', $class));
            $class = strtolower(end($class));
            $fun = debug_backtrace()[1]['function'];
            $fun = str_replace('Action', '', $fun);
            $file = $this->paths['app'] . '/' . $class . '/' . $fun . '.phtml';
        }

        if (is_readable($file)) {
            require_once $file;
        }
        else {
            throw new \Exception("$file not found");
        }
    }

//    public function renderTemplate($template, $data = []) {
//        static $twig = null;
//        if ($twig === null) {
//            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/modules/app/Views');
//            $twig = new \Twig_Environment($loader);
//        }
//        echo $twig->render($template, $data);
//    }
}
