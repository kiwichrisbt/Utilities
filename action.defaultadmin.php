<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

if ( !defined('CMS_VERSION') ) exit;


if ( !$this->CheckPermission('Modify Site Preferences') ) { // core permission
   $this->ShowErrors( $this->Lang('need_permission') );
   return;
}


if ( isset($params['submit']) )  {

    if ( $params['submit']=='update_token' ) {
       if ( !empty($params['instagram_token']) ) {
        $this->SetPreference( 'instagram_token', strval($params['instagram_token']) );
        $this->SetPreference( 'instagram_token_timestamp', time() );
        $this->ShowMessage( $this->Lang('token_updated') ); 

        } else {
            $this->ShowErrors( $this->Lang('token_not_updated') ); 
        }   

    } elseif ( $params['submit']=='clear_media_cache' ) {
        $this->SetPreference( 'instagram_media_timestamp', 0 ); 
        
    }
}



// Create Admin tabs
echo $this->StartTabHeaders();
   echo $this->SetTabHeader("options", $this->Lang("tab_options"));
echo $this->EndTabHeaders();


// create Tab content
echo $this->StartTabContent();

    echo $this->StartTab("options");
        $tpl = $smarty->CreateTemplate( $this->GetTemplateResource('admin_options.tpl'), null, null, $smarty );
        // create all required smarty vars
        $tpl->assign( '$mod', $this );
        $tpl->assign( 'instagram_token', $this->GetPreference('instagram_token') );
        $tpl->assign( 'instagram_token_timestamp', $this->GetPreference('instagram_token_timestamp') );
        $tpl->assign( 'instagram_media_timestamp', $this->GetPreference('instagram_media_timestamp') );
        $instagram = new instagramFeed;
        $tpl->assign( 'token_refresh_period', $instagram->token_refresh_period );
        $tpl->assign( 'media_refresh_period', $instagram->media_refresh_period );
        $tpl->display();
    echo $this->EndTab();

echo $this->EndTabContent();


