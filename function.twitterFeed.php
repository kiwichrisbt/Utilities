<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function twitterFeed($params, $smarty) {
//**************************************************************************************************
// based on GCB v1.0 - 09Jun16
//**************************************************************************************************
   // set defaults
   $twitterWidth = '';        // leave empty for responsive
   $twitterHeight = 300;
   $twitterTheme = 'light';   // 'light' (default) or 'dark'
   $twitterLinkColor = '';    // e.g. '#AAAA52' optional
   $twitterBorderColor = '';  // optional or set in CSS
   $twitterChromeOptions = 'nofooter transparent ';   // 1 or more (space separated) 'noheader nofooter noborders noscrollbar transparent'


   // screen_name (required) is param or CustomGS.Twitter if set
   if ( !empty($params['screen_name']) ){
      $twitterScreenName = $params['screen_name'];

   } else {
      $CustomGS = cms_utils::get_module('CustomGS');
      if( is_object($CustomGS) ) {
         $CustomGS_Twitter = $CustomGS->GetField('Twitter');
         if ( !empty($CustomGS_Twitter['value']) ) {
            $twitterScreenName = $CustomGS_Twitter['value'];
         }
      }
   }

   $mod = cms_utils::get_module('Utilities');
   if( is_object($mod) && !empty($twitterScreenName) ) {

      // use other params if set
      if (!empty($params['width'])) $twitterWidth = $params['width'];
      if (!empty($params['height'])) $twitterHeight = $params['height'];
      if (!empty($params['theme'])) $twitterTheme = $params['theme'];
      if (!empty($params['link_color'])) $twitterLinkColor = $params['link_color'];
      if (!empty($params['border_color'])) $twitterBorderColor = $params['border_color'];
      if (!empty($params['chrome_options'])) $twitterChromeOptions = $params['chrome_options'];

      $tpl = $smarty->CreateTemplate( $mod->GetTemplateResource('twitterFeed_template.tpl'), null, null, $smarty );
      $tpl->assign('twitterScreenName', $twitterScreenName);
      $tpl->assign('twitterWidth', $twitterWidth);
      $tpl->assign('twitterHeight', $twitterHeight);
      $tpl->assign('twitterTheme', $twitterTheme);
      $tpl->assign('twitterLinkColor', $twitterLinkColor);
      $tpl->assign('twitterBorderColor', $twitterBorderColor);
      $tpl->assign('twitterChromeOptions', $twitterChromeOptions);
      $tpl->display();
   }

}


