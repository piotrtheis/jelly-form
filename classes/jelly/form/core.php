<?php defined('SYSPATH') or die('No direct access allowed.');

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
abstract class Jelly_Form_Core{
    
    
    
    /**
     * Model meta object
     * @var \Jelly_Meta
     */
    protected $_fields;


    public function __construct(Jelly_Meta $meta)
    {
        $this->_fields = $meta->fields();
    }

    
    
    public function fields(array $fields = null)
    {
        $meta_fields = array_keys($this->_fields);
        
        //unnecessary fields
        foreach(array_diff($meta_fields, $fields) as $field)
        {
            unset($this->_fields[$field]);
        }

        return $this;
    }    
}
