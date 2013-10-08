<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Authentication.joomla
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die; // Stopping Unauthorized access 
/**
 * Joomla Authentication plugin
 *
 * @package     Joomla.Plugin
 * @subpackage  Authentication.joomla
 * @since       1.5
 */
Class PlgContentGravatar extends JPlugin
{
    protected $autoloadLanguage = true;
    protected $default="localhost";
    protected $size=100;
    
    
    
    public function onContentBeforeDisplay($context, &$row, &$params, $page=0)
    {
        $db=JFactory::getDbo();
        $query	= $db->getQuery(true)       
			->select('email')
			->from('#__users')
			->where('username=' . $db->quote($credentials['username']));
        $db->setQuery($query);
	$result = $db->loadObject();
        
        if($result)
        {
            $emailid=$result->email;
            
            
        }
        $gravurl="http://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailid ) ) )."?d=".urlencode( $default )."&s=".$size;
        
    }
        
        
        
}
?>
