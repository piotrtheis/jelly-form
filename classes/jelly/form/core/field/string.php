<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_String extends Jelly_Form_Core_Field
{   
    public function get_field($value = null)
    {
        $value = ($value) ? $value : $this->_get_value();
        
        return Form::input($this->_field->name, $value);
    }
}
