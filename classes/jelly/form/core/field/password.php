<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_Password extends Jelly_Form_Core_Field
{

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::password($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null, array $attr = null)
    {
        $group_wrapper = '<div class="form-group %s">%s</div>';
        $error_helper = ' <span class="help-block">%s</span>';
        
        $classes = isset($attr['class']) ? $attr['class'] . ' form-control' : 'form-control';
        $attr['class'] = $classes;

        $group_body = $this->get_label(array('class' => 'control-label'));
        $group_body .= $this->get_field($value, $attr);
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
    
     /**
     * Get field value
     * 
     * @return string
     */
    protected function _get_value()
    {
        $item_value = $this->_get_view_var('item');

        //value from post
        if (isset($_POST[$this->_field->name]))
        {
            return $_POST[$this->_field->name];
            //value from get
        } elseif (isset($_GET[$this->_field->name]))
        {
            return $_GET[$this->_field->name];

            //value set manualy   
        } elseif ((bool) $this->_value)
        {
            return $this->_value;
            //value item var
        }
    }

}
