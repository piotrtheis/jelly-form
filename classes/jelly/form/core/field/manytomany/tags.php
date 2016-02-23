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
abstract class Jelly_Form_Core_Field_Manytomany_Tags extends Jelly_Form_Field_Manytomany
{

    protected $_options;

    public function __construct($field, $smarty)
    {
//        parent::__construct($field, $smarty);
        return 123;
    }

    public function get_field($value = null, $attr = null)
    {
        
    }

    public function bootstrap_form_group()
    {
        echo 123;
    }

}
