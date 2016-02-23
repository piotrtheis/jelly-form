<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Core Field Text
 *
 * Text form field as textarea
 *
 * @package    Jelly/Form
 * @category   Field
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
abstract class Jelly_Form_Core_Field_Text extends Jelly_Form_Core_Field
{

    public function get_field($value = null, $attr = null)
    {
        $value = ($value) ? $value : $this->_get_value();

        return Form::textarea($this->_field->name, $value, $attr);
    }

    public function bootstrap_form_group($value = null,array $attr = null)
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
