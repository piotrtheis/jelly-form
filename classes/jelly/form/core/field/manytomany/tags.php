<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field ManyToMany Tags
 *
 * Manytomant field tags presentation adapter
 *
 * @package    Jelly/Form
 * @category   Field
 * @category   Presentation
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core_Field_Manytomany_Tags extends Jelly_Form_Field
{

    protected $_tags = array();

    public function __construct($field, $smarty)
    {
        parent::__construct($field, $smarty);

        $tags = Jelly::query($this->_field->model)
                ->select();

    }

    public function get_field($value = null, $attr = null)
    {
        
    }

    public function bootstrap_form_group($value = null, array $attr = null)
    {
        $view = View::factory('fields/bootstrap/presentation/manytomany/tags.tpl')
                ->set('form', $this)
                ->set('field', $this->_field)
                ->bind('value', $value);


        if (!(bool) $value)
        {
            $value = $this->_get_value();

            if ($value instanceof Jelly_Collection)
            {
                $value = implode(',', $value->as_array(null, 'tag'));
            }
        }

        return $view->render();
    }

}
