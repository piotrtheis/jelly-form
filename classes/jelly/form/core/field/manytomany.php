<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field Manytomany
 *
 * Wrapper class to call presentation forms
 *
 * @package    Jelly/Form
 * @category   Field
 * @category   Presentation
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core_Field_Manytomany extends Jelly_Form_Core_Field
{
    /**
     * Prefix for form field
     * @var  string
     */
    protected static $_field_prefix = 'Jelly_Form_Field_Manytomany_';
    
    /**
     *
     * @var \Jelly_Form_Core_Fields
     */
    protected $_presentation_field;

    public function __construct($field, $smarty)
    {
        parent::__construct($field, $smarty);
        
        //need presentation form
        if(!(bool)$field->presentation)
            throw new Kohana_Exception('Specified presentation form for field :field', array(':field' => $field->name));

        $field_class = self::$_field_prefix . ucfirst(strtolower($field->presentation));
        
        if(!class_exists($field_class))
            throw new Kohana_Exception('No class for presentation form :form', array(':from' => $field->presentation));
        
        $this->_presentation_field = new $field_class($field, $smarty);
    }
    
    public function get_field($value = null, $attr = null)
    {
        return call_user_method_array('get_field', $this->_presentation_field, array($value, $attr));
    }
    
    public function __call($name, $arguments)
    {   
        return call_user_method_array($name, $this->_presentation_field, $arguments);
    }
}
