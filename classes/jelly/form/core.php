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
     * Form fields list
     * @var array
     */
    protected $_fields;

    /**
     * Constructor
     * 
     * @param Jelly_Meta $meta
     */
    public function __construct(Jelly_Meta $meta)
    {
        $this->_fields = $meta->fields();
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
            return $this->_fields;

        $meta_fields = array_keys($this->_fields);

        //unnecessary fields
        foreach (array_diff($meta_fields, $fields) as $field)
        {
            unset($this->_fields[$field]);
        }

        //convert model fields to form fields
        foreach ($this->_fields as $key => $field)
        {
            $this->_fields[$key] = Jelly_Form_Field::factory($field);
        }

        return $this;
    }

}
