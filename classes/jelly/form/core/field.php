<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Field
{

    /**
     * Prefix for form field
     * @var  string
     */
    protected static $_field_prefix = 'Jelly_Form_Field_';

    /**
     * Model field to convert
     * @var \Jelly_Field 
     */
    protected $_field;

    /**
     * Smarty template object
     * @var \Smarty
     */
    protected $_smarty;

    /**
     * Factory for instantiating form fields
     * 
     * @param Jelly_Field $field
     */
    public static function factory(Jelly_Field $field, Smarty $smarty)
    {
        $field_type = str_replace('Jelly_Field_', '', get_class($field));

        $field_class = Jelly_Form_Field::$_field_prefix . $field_type;

        return new $field_class($field, $smarty);
    }

    /**
     * Constructor
     * 
     * @param \Jelly_Field $field
     */
    public function __construct($field, $smarty)
    {
        $this->_field = $field;
        $this->_smarty = $smarty;
    }

    /**
     * Get field label
     * @return string
     */
    public function get_label()
    {
        return Form::label($this->_field->name, $this->_field->label);
    }

    /**
     * Get field validation messages
     * 
     * @return string
     */
    public function get_error()
    {
        $errors = $this->_get_view_var('errors');

        if ($errors)
        {
            if (array_key_exists($this->_field->name, $errors))
            {
                return $errors[$this->_field->name];
                //extra validation
            } elseif (isset($errors['_external']))
            {
                if (array_key_exists($this->_field->name, $errors['_external']))
                {
                    return $errors['_external'][$this->_field->name];
                }
            }
        }
    }

    /**
     * Render form element
     */
    abstract function get_field();

    /**
     * Get field value
     * 
     * @return string
     */
    protected function _get_value()
    {
        return null;
    }

    /**
     * Find view variable
     * 
     * @param string $var view var name
     * @return boolean|$var
     */
    protected function _get_view_var($var)
    {
        if (isset($this->_smarty->tpl_vars[$var]))
        {
            return $this->_smarty->tpl_vars[$var]->value;
        }

        return FALSE;
    }

}
