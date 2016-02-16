<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_Belongsto extends Jelly_Form_Core_Field
{

    protected $_options;

    public function __construct($field, $smarty)
    {
        parent::__construct($field, $smarty);

        //first empty element
        $this->_options[0] = __('select');
        
        $options = Jelly::query($this->_field->foreign['model'])
                ->select()
                ->as_array('id', $this->_field->form_field);
        
        //push options
        array_walk($options, function(&$item, $key){
            $this->_options[$key] = $item;
        });
    }

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::select($this->_field->name, $this->_options, $value, $attr);
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
