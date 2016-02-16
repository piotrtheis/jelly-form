<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Jelly_Form_Core_Decorator
{

    /**
     * Form to decore
     * @var \Jelly_Form 
     */
    protected $_form;

    public function __construct(Jelly_Form $form)
    {
        $this->_form = $form;
    }

    public function fields(array $fields = null);

    abstract public function render();
}
