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
    protected $size=200;
    const GRAVATAR_SERVER="http://www.gravatar.com/avatar/";
    protected $default="http://www.gravatar.com/avatar";

    
    public function onContentBeforeDisplay($context, &$row, &$params, $page=0)
    {
        
       
        $emailid=$row->author_email;
        
        $gravurl="http://www.gravatar.com/avatar/".md5( strtolower( trim( $emailid ) ) )."?d=".urlencode($this->default )."&s=".  $this->size;
        
        $str=  file_get_contents("http://www.gravatar.com/".md5($emailid).".php");
        
        $profile=  unserialize($str);
        
         if ( is_array( $profile ) && isset( $profile['entry'] ) )
         {
                echo '<img src="' . "$gravurl" . '" alt =""/>';
                $name=$profile['entry'][0]['displayName'];   //Displaying My name
                echo "Gravatar Name: ".$name;
                echo "<br/>";
                $myemail=$profile['entry'][0]['emails'][0]['value'];    //Displaying my email
                echo "My Public email: ".$myemail;
                echo "<br/>";
                $im_accounts=$profile['entry'][0]['ims'][0]['value'];   //Displaying my Ims accounts
                echo "My IM account id: ".$im_accounts;
                echo "<br/>";
         }
         else
         {
            
             //echo '<img src=' . $grav_url  . 'alt="" />';
            echo '<img src="' . "http://en.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e.php" . '" alt =""/>';
             
         }    
    }
        
       
        
        
}
         
        
?>
