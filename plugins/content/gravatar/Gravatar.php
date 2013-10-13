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
    protected $size=250;
    const GRAVATAR_SERVER="http://www.gravatar.com/avatar/";
    protected $default="http://www.gravatar.com/avatar";

    
    public function onContentBeforeDisplay($context, &$row, &$params, $page=0)
    {
        
        $db=JFactory::getDbo();
        $jinput=JFactory::getApplication()->input;
        
        //$user_id=(int)$article->created_by; 
        
        $id=JFactory::getApplication()->input->getInt('id');
        $article = JTable::getInstance('content');
        $article->load($id);
        $created_user_id = $article->created_by;
        echo $created_user_id; 
        var_dump($created_user_id);
      
        
        $query = $db->getQuery(true);
        $query->select ('email');
        $query->from($db->quoteName('#__users'));
        $query->where($db->quoteName('id').  " = " .$created_user_id);  
        
        $db->execute($query);
	
        echo GRAVATAR_SERVER;
        $result = $db->loadObject();
       
        if($result)
        {
            
            $emailid=$result->email;
            
        }
        echo $emailid;
        
        $gravurl="http://www.gravatar.com/avatar/".md5( strtolower( trim( $emailid ) ) )."?d=".urlencode( $default )."&s=".$size;
        
        $str=  file_get_contents("http://www.gravatar.com/".md5($emailid).".php");
        
        $profile=  unserialize($str);
        
         if ( is_array( $profile ) && isset( $profile['entry'] ) )
         {
         
                $name=$profile['entry'][0]['displayName'];   //Displaying My name
                echo $name;
                $myemail=$profile['entry'][0]['emails'][0]['value'];    //Displaying my email
                echo $myemail;
                $im_accounts=$profile['entry'][0]['ims'][0]['value'];   //Displaying my Ims accounts
                echo $im_accounts;
         }
         else
         {
            
             //echo '<img src=' . $grav_url  . 'alt="" />';
            echo '<img src="' . "http://en.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e.php" . '" alt =""/>';
             
         }    
    }
        
       
        
        
}
         
        
?>
