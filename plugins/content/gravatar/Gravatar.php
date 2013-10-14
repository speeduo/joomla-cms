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
    protected $defaultsize=100;
    protected $GRAVATAR_SERVER="http://www.gravatar.com/avatar/";
    protected $default="http://www.gravatar.com/";
    protected $GRAVATAR_SECURE_SERVER="https://secure.gravatar.com/avatar";
    protected $securedefault="https://secure.gravatar.com/";
    protected $uri;


    public function onContentBeforeDisplay($context, &$row, &$params, $page=0)
    {
    if($context=='com_content.featured')
        {
            $uri=JURI::base();
            $array[]=(JString::parse_url($uri));
            $size=$this->params->get('size',$this->defaultsize);
            $emailid=$row->author_email;
            
            if ($array[0]['scheme']=='http')
            {
                
                $gravurl=  $this->GRAVATAR_SERVER.md5( strtolower( trim( $emailid ) ) )."?d=".urlencode($this->default )."&s=".$size;
                $str=  file_get_contents("$this->default".md5($emailid).".php");
                $profile=  unserialize($str);
                 
                if ( is_array( $profile ) && isset( $profile['entry'] ) )
                {      
             
                $name=$profile['entry'][0]['displayName'];   //Displaying My name
                $myemail=$profile['entry'][0]['emails'][0]['value'];    //Displaying my email
                $im_accounts=$profile['entry'][0]['ims'][0]['value'];   //Displaying my Ims accounts
                
                
                $html[] = '<span class="gravatar_image">';
                $html[] = JHtml::_('image', $gravurl, JText::_('MY_AVATAR'), null, true);
                $html[] = '</span>';
                
                
                $html[]='<span class="gravatar_name" style="color:blue">';
                $html[]= "My Gravatar Name: ".$name;
                $html[]='</span>';
                
                $html[]='<span class="My public Email" style="color:blue">';
                $html[]= "My public Email: ".$myemail;
                $html[]='</span>';
                
                $html[]='<span class="gravatar_im accounts" style="color:blue">';
                $html[]= "My IM account id: ".$im_accounts;
                $html[]='</span>';
                
             
                }
                 else
                {
            
                //echo '<img src=' . $grav_url  . 'alt="" />';
                $default_url="$this->GRAVATAR_SERVER".md5( strtolower( trim( $emailid ) ) );
                $selection=  $this->params->get('default','identicon');
                $default_url=$default_url."?d=".$selection;
                //echo '<img src="' . "$default_url". '" alt =""/>';
             
                $html[] = '<span class="gravatar">';
                $html[] = JHtml::_('image', $default_url, JText::_('MY_AVATAR'), null, true);
                $html[] = '</span>';
             
             
                } 
                
                
            }
            if($array[0]['scheme']=='https')
            {
                $gravurl=  $this->GRAVATAR_SECURE_SERVER.md5( strtolower( trim( $emailid ) ) )."?d=".urlencode($this->default )."&s=".$size;
                $str=  file_get_contents("$this->securedefault".md5($emailid).".php");
                $profile=  unserialize($str);
                 
                if ( is_array( $profile ) && isset( $profile['entry'] ) )
                {      
             
                $name=$profile['entry'][0]['displayName'];   //Displaying My name
                $myemail=$profile['entry'][0]['emails'][0]['value'];    //Displaying my email
                $im_accounts=$profile['entry'][0]['ims'][0]['value'];   //Displaying my Ims accounts
                
                
                $html[] = '<span class="gravatar_image">';
                $html[] = JHtml::_('image', $gravurl, JText::_('MY_AVATAR'), null, true);
                $html[] = '</span>';
                
                
                $html[]='<span class="gravatar_name" style="color:blue">';
                $html[]= "My Gravatar Name: ".$name;
                $html[]='</span>';
                
                $html[]='<span class="My public Email" style="color:blue">';
                $html[]= "My public Email: ".$myemail;
                $html[]='</span>';
                
                $html[]='<span class="gravatar_im accounts" style="color:blue">';
                $html[]= "My IM account id: ".$im_accounts;
                $html[]='</span>';
                
             
                }
                 else
                {
            
                //echo '<img src=' . $grav_url  . 'alt="" />';
                $default_url="$this->GRAVATAR_SECURE_SERVER".md5( strtolower( trim( $emailid ) ) );
                $selection=  $this->params->get('default','identicon');
                $default_url=$default_url."?d=".$selection;
                //echo '<img src="' . "$default_url". '" alt =""/>';
             
                $html[] = '<span class="gravatar">';
                $html[] = JHtml::_('image', $default_url, JText::_('MY_AVATAR'), null, true);
                $html[] = '</span>';
             
             
                } 
                
                
                
            }
            
            
            
            
           
            
            
        
           
            
           
               
        }
        return implode("</br> ", $html);
    }
        
}


