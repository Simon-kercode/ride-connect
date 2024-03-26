<?php

namespace app\controllers;

abstract class Controller {

    protected function render(string $file, array $data = [], $template = 'default') {

        // extracting $data content : takes an associative array and treats keys as variable names and values as variable values
        extract($data);

        // starting output buffer
        ob_start();

        require_once ROOT.'app/views/'.$file.'.php';

        // store content into the variable
        $content = ob_get_clean();

        require_once ROOT. 'app/views/'.$template.'.php';
    } 
}