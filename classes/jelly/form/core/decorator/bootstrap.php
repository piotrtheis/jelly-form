<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Decorator_Bootstrap extends Jelly_Form_Decorator
{

    public function fields(array $fields = null)
    {
        //decor fields
        if (is_null($fields))
        {
            //convert model fields to form fields
            foreach ($this->_fields as $key => $field)
            {
                $this->_fields[$key] = Jelly_Form_Field::factory($field, $this->_view->smarty());
            }

            return $this->_fields;
        }

        //just set fields
        return $this->_form->fields($fields);
    }
}
