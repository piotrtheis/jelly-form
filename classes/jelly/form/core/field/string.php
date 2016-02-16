<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_String extends Jelly_Form_Core_Field
{

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::input($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null)
    {
        $group_wrapper = '<div class="form-group %s">%s</div>';
        $error_helper = ' <span class="help-block">%s</span>';

        $group_body = $this->get_label(array('class' => 'control-label'));
        $group_body .= $this->get_field($value, array('class' => 'form-control'));
        $group_body .= sprintf($error_helper, $this->get_error());

        if ($this->has_error())
        {
            $form_group = sprintf($group_wrapper, 'has-error', $group_body);
        } else
        {
            $form_group = sprintf($group_wrapper, ' ', $group_body);
        }
        
        return $form_group;
    }

}
