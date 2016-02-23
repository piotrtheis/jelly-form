<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Jelly Form Presentation ManyToMany
 *
 * Form field presentation types
 * for manytomany field
 *
 * @package    Jelly/Form
 * @category   Presentation
 * @author     Piotr Theis <piotr_theis@o2.pl>
 * @copyright  (c) 2016-2017 Piotr Theis
 * @license    http://www.opensource.org/licenses/isc-license.txt
 */
interface Jelly_Form_Presentation_Manytomany
{

    const TAGS = 'tags';
    const CHECKBOX = 'checkbox';
    const MULTISELECT = 'multiselect';

}
