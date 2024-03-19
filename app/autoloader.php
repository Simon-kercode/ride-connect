<?php 
    namespace app;

    class Autoloader {

        // allow to activate the autoload without instantiate the class
        static function register(){
            spl_autoload_register([
                // CLASS contains complete path of the class
                __CLASS__,
                'autoload'
            ]);
        }

        static function autoload($class){

            $class = str_replace(__NAMESPACE__.'\\', '', $class);
            $class = str_replace('\\', '/', $class);

            if (file_exists(__DIR__.'/'.$class.'.php')) {
                require __DIR__.'/'.$class.'.php';
            }
        }
    }