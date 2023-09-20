<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function adminActionUrl($params, $smarty) {
//**************************************************************************************************
// based on function.my_admin_action_url.php - from Velden :)
//    + will only give a result if user is logged into admin
//
//**************************************************************************************************
   if ( !get_userid(false) ) return;

   $module = $smarty->getTemplateVars('actionmodule');
   //$returnid = $smarty->getTemplateVars('returnid');
   $returnid = '';
   $mid = $smarty->getTemplateVars('actionid');
   $action = null;
   $assign = null;
   $forjs  = 0;

   $actionparms = array();
   foreach( $params as $key => $value ) {
     switch( $key ) {
     case 'module':
         $module = trim($value);
         break;
     case 'action':
         $action = trim($value);
         break;
     case 'returnid':
         //$returnid = (int)trim($value);
         break;
     case 'mid':
         $mid = trim($value);
         break;
     case 'assign':
         $assign = trim($value);
         break;
     case 'forjs':
         $forjs = 1;
         break;
     default:
         $actionparms[$key] = $value;
         break;
     }
   }



   // validate params
   $gCms = CmsApp::get_instance();
   if( $module == '' ) return;
   if( $gCms->test_state(CmsApp::STATE_ADMIN_PAGE) ) {
     if( $mid == '' ) $mid = 'm1_';
     if( $action == '' ) $action = 'defaultadmin';
   }
   else if( $gCms->is_frontend_request() ) {
     if( $mid == '' ) $mid = 'cntnt01';
     if( $action == '' ) $action = 'default';
   }
   if( $action == '' ) return;

   $obj = cms_utils::get_module($module);
   if( !$obj ) return;

   $url = $obj->create_url($mid,$action,$returnid,$actionparms);
   if( !$url ) return;


   if( $forjs ) {
     $url = str_replace('&amp;','&',$url);
   }
   if( $assign ) {
     $smarty->assign($assign,$url);
     return;
   }
   return $url;

}


