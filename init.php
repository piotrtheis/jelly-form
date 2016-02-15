<?php defined('SYSPATH') or die('No direct access allowed.');

//check jelly exists
if(!array_key_exists('jelly', Kohana::modules()))
    throw new Kohana_Exception('Jelly-form need jelly module loaded');

//check smarty exists
if(!array_key_exists('smarty', Kohana::modules()))
    throw new Kohana_Exception('Jelly-form need smarty module loaded');