<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core
 *
 * This core class is the main interface to all
 * models, builders, and meta data.
 *
 * @package    Jelly/Form
 * @category   Base
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core
{

    /**
     * Model meat object
     * @var \Jelly_Meta
     */
    protected $_meta;

    /**
     * Form fields list
     * @var array
     */
    protected $_fields;

    /**
     * Form view template
     * @var \Smarty_View
     */
    protected $_view;

    /**
     * Current group key
     * @var string
     */
    protected $_group;

    /**
     * Constructor
     * 
     * @param Jelly_Meta $meta
     */
    public function __construct(Jelly_Meta $meta)
    {
        $this->_meta = clone $meta;
    }

    public function group($name)
    {
        $this->_group = $name;
        return $this;
    }

    /**
     * Gets or sets form fields
     * 
     * @param array $fields
     * @return \Jelly_Form_Core|array
     */
    public function fields(array $fields = null)
    {
        if (!(bool) $fields)
        {
            return $this->_get_fields();
        }

        $this->_set_fields($fields);

        return $this;
    }

    /**
     * Set form view template
     * 
     * @param Smarty_View $view
     * @return \Jelly_Form_Core
     */
    public function set_view(Smarty_View $view)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * 
     * @param array $fields
     */
    protected function _set_fields(array $fields)
    {
        if ((bool) $this->_group)
        {
            foreach ($fields as $field)
            {
                $this->_fields[$this->_group][$field] = $this->_meta->field($field);
            }

            //clear current group
            $this->_group = null;

            return;
        }


        foreach ($fields as $field)
        {
            $this->_fields['jelly_form_fields'][$field] = $this->_meta->field($field);
        }
    }

    protected function _get_fields()
    {
        if ((bool) $this->_group)
        {
            //convert model fields to form fields
            foreach ($this->_fields[$this->_group] as $key => $field)
            {
                $this->_fields[$this->_group][$key] = Jelly_Form_Field::factory($field, $this->_view->smarty());
            }
            
            $key = $this->_group;
            
            //clear current group
            $this->_group = null;

            return $this->_fields[$key];
        }

        //convert model fields to form fields
        foreach ($this->_fields['jelly_form_fields'] as $key => $field)
        {
            $this->_fields['jelly_form_fields'][$key] = Jelly_Form_Field::factory($field, $this->_view->smarty());
        }

        return $this->_fields['jelly_form_fields'];
    }

}
