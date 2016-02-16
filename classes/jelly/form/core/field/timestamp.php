<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_Timestamp extends Jelly_Form_Core_Field
{

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::input($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null)
    {
        $group_wrapper = '<div class="form-group %s">%s%s%s</div>';
        $error_helper = ' <span class="help-block">%s</span>';
        
        $input_group = '<div class="input-group date datetimepicker">%s%s</div>';
        $field_addon = '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
        
        

        $group_label = $this->get_label(array('class' => 'control-label'));
        $group_body  = $this->get_field($value, array('class' => 'form-control'));
        $group_error = sprintf($error_helper, $this->get_error());

        
        $input_group_wrapper = sprintf($input_group, $group_body, $field_addon);
        
        if ($this->has_error())
        {
            $form_group = sprintf($group_wrapper, 'has-error', $group_label, $input_group_wrapper, $group_error);
        } else
        {
            $form_group = sprintf($group_wrapper, ' ', $group_label, $input_group_wrapper, $group_error);
        }
        
        return $form_group;
    }

}
