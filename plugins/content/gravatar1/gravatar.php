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
    const GRAVATAR_SERVER="http://www.gravatar.com/avatar/";
    

    
    public function onContentBeforeDisplay($context, &$row, &$params, $page=0,$article, $limitstart)
    {
        
        $db=JFactory::getDbo();
        $jinput=JFactory::getApplication()->input;
        
        $articleid=$article->id;
        
        $query	= $db->getQuery(true)       
			->select('email')
			->from('#__users join #__content')
			->where("id='{$articleid}'");
        
        $db->setQuery($query);
	
        $result = $db->loadObject();
        
        if($result)
        {
            
            $emailid=$result->email;
            
        }
        
        $gravurl=GRAVATAR_SERVER.md5( strtolower( trim( $emailid ) ) )."?d=".urlencode( $default )."&s=".$size;
        
        $str=  file_get_contents(GRAVATAR_SERVER.md5($emailid)."php");
        
        $profile=  unserialize($str);
        
         if ( is_array( $profile ) && isset( $profile['entry'] ) )
         {
         
                $name=$profile['entry'][0]['displayName'];   //Displaying My name
                echo $name;
                $myemail=$profile['entry'][0]['emails'][0]['value'];    //Displaying my email
                
                $im_accounts=$profile['entry'][0]['ims'][0]['value'];   //Displaying my Ims accounts
                
         }
         
    }
        
        
        
        
}
?>
