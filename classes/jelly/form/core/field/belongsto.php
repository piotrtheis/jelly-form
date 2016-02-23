<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field Belongsto
 *
 * Belongsto form field as select list
 *
 * @package    Jelly/Form
 * @category   Field
 * @category   Presentation
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core_Field_Belongsto extends Jelly_Form_Core_Field
{

    protected $_options;

    public function __construct($field, $smarty)
    {
        parent::__construct($field, $smarty);

        //first empty element
        $this->_options[0] = __('select');
        
        $options = Jelly::query($this->_field->foreign['model'])
                ->select()
                ->as_array('id', $this->_field->form_field);
        
        //push options
        array_walk($options, function(&$item, $key){
            $this->_options[$key] = $item;
        });
    }

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        
        return Form::select($this->_field->name, $this->_options, $value, $attr);
    }

    public function bootstrap_form_group($value = null, array $attr = null)
    {
        $group_wrapper = '<div class="form-group %s">%s</div>';
        $error_helper = ' <span class="help-block">%s</span>';
        
        $classes = isset($attr['class']) ? $attr['class'] . ' form-control' : 'form-control';
        $attr['class'] = $classes;

        $group_body = $this->get_label(array('class' => 'control-label'));
        $group_body .= $this->get_field($value, $attr);
        $group_body .= sprintf($error_helper, $this->get_error());

        if ($this->has_error())
        {
            $form_group = sprintf($group_wrapper, 'has-error', $group_body);
        } else
        {
            $form_group = sprintf($group_wrapper, ' ', $group_body);
        }

        return $form_group;
    }

}
