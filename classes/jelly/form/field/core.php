<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Field_Core
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
     * Factory for instantiating form fields
     * 
     * @param Jelly_Field $field
     */
    public static function factory(Jelly_Field $field)
    {
        echo Debug::vars(get_class($field));
        $field_type = str_replace('Jelly_Field_', '', get_class($field));
        
        $field_class = Jelly_Form_Field::$_field_prefix . $field_type;
        
        return new $field_class($field);
        
    }
    

    /**
     * Constructor
     * 
     * @param \Jelly_Field $field
     */
    public function __construct($field)
    {
        $this->_field = $field;
    }
}
