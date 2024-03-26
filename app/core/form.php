<?php

namespace app\core;

class Form {

    private string $action;
    private string $method;
    private array $inputs;

    public function __construct($action, $method = 'POST') {

        $this->action = $action;
        $this->method = $method;
    }
    // add inputs in the form by his parameters
    protected function addInput($type, $name, $label, $value) {

        $input = array(
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'value' => $value,
        );

        $this->inputs[] = $input;
    }

    protected function addButton($buttonType, $buttonValue) {
        
        $button = array(
            'type' => $type,
            'value' => $value
        );
    }

    protected function createForm() {

        echo '<form method="'.$this->method.'" action="'.$this->action.'">';

        foreach($this->inputs as $input) {
            echo '<div><label for="'.$input['name'].'">'.$input['label'].'</label>
            <input type="'.$input['type'].'" name="'.$input['name'].'" value="'.$inputValue.'"></div>';
        }
        echo '<input type="'.$buttonType.'" value="'.$buttonValue.'">';
        echo '</form>'; 
    }

    protected function verify(array $issue, array $fields) {

        foreach($fields as $field) {
            if (!isset($issue[$field]) || empty($issue[$field])) {
                return false;
            }
        }
        return true;
    }
}