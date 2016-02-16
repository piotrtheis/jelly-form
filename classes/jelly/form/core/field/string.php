<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_String extends Jelly_Form_Core_Field
{   
    public function get_field()
    {
        return Form::input($this->_field->name, $this->_get_value());
    }
}
