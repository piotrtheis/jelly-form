<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field_File extends Jelly_Form_Core_Field
{

    protected $_options;
    public $post_file_helper_name;

    public function __construct($field, $smarty)
    {
        parent::__construct($field, $smarty);

        //post populate helper name
        $this->post_file_helper_name = Jelly_Field_File::$post_file_helper_prefix . $this->_field->name;

        //first empty element
        $this->_options[0] = __('select');
    }

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::input($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null)
    {
        $field_wrapper = View::factory('fields/bootstrap/file.tpl')
                ->set('form', $this)
                ->set('field', $this->_field)
                ->set('post_helper', $this->post_file_helper_name)
                ->bind('accept', $types)
                ->bind('path', $path);

        
        $path = str_replace(DOCROOT, '', $this->_field->path);
        
        $types = array_map(function($item)
        {
            return '.' . $item;
        }, $this->_field->types);
        
        $types = implode(',', $types); 
        

        return $field_wrapper->render();
    }

}
