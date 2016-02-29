<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field Timestamp
 *
 * Date form field as datetimepicker
 *
 * @package    Jelly/Form
 * @category   Field
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core_Field_Timestamp extends Jelly_Form_Core_Field
{

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();
        
        echo Debug::vars($value);

        return Form::input($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null, array $attr = null)
    {
        $group_wrapper = '<div class="form-group %s">%s%s%s</div>';
        $error_helper = ' <span class="help-block">%s</span>';
        
        $input_group = '<div class="input-group">%s%s</div>';
        $field_addon = '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>';
        
        $classes = isset($attr['class']) ? $attr['class'] . ' form-control' : 'form-control';
        $attr['class'] = $classes;

        $group_label = $this->get_label(array('class' => 'control-label'));
        $group_body  = $this->get_field($value, $attr);
        $group_error = sprintf($error_helper, $this->get_error());

        
        $input_group_wrapper = sprintf($input_group, $group_body, $field_addon);
        
        if ($this->has_error())
        {
            $form_group = sprintf($group_wrapper, 'has-error', $group_label, $input_group_wrapper, $group_error);
        } else
        {
            $form_group = sprintf($group_wrapper, ' ', $group_label, $input_group_wrapper, $group_error);
        }
        
        return $form_group;
    }

}
