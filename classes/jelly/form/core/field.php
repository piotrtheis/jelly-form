<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field
 *
 * This core class is the main interface to all
 * models, builders, and meta data.
 *
 * @package    Jelly/Form
 * @category   Core
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
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
     * Field value
     * @var mixed
     */
    protected $_value;

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
    public function get_label($attr)
    {
        return Form::label($this->_field->name, $this->_field->label, $attr);
    }

    public function has_error()
    {
        return (bool) $this->get_error();
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
            if ($this->_field instanceof Jelly_Field_ManyToMany)
            {

                if (array_key_exists(Inflector::singular($this->_field->name), $errors))
                {
                    return $errors[Inflector::singular($this->_field->name)];
                    //extra validation from controller
                } elseif (isset($errors['_external']))
                {
                    if (array_key_exists(Inflector::singular($this->_field->name), $errors['_external']))
                    {
                        return $errors['_external'][Inflector::singular($this->_field->name)];
                    }
                }
            } else
            {
                if (array_key_exists($this->_field->name, $errors))
                {
                    return $errors[$this->_field->name];
                    //extra validation from controller
                } elseif (isset($errors['_external']))
                {
                    if (array_key_exists($this->_field->name, $errors['_external']))
                    {
                        return $errors['_external'][$this->_field->name];
                    }
                }
            }
        }
    }

    public function is_required()
    {
        
    }

    public function set_value($value)
    {
        $this->_value = $value;
    }

    /**
     * Render form element
     */
    abstract function get_field($value = null, $attr = null);

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
        } elseif ($item_value)
        {
            if ($item_value instanceof Jelly_Model)
            {
                //value for belongsto and hasone
                if ($this->_field instanceof Jelly_Field_Supports_With)
                {
                    return $item_value->{$this->_field->name}->{$this->_field->foreign['field']};
                }

                return $item_value->{$this->_field->name};
            }
        }
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
