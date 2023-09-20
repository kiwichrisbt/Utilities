<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function facebookFeed($params, $smarty) {
//**************************************************************************************************
// based on GCB - v1.1 - 01Dec15
//**************************************************************************************************
   // set defaults
   $width = 500;                    // The pixel width of the plugin. Min. is 180 and Max. is 500
   $height = 400;                   // The pixel height of the plugin. Min. is 70
   $hideCover = 'false';            // Hide cover photo in the header
   $showFacepile = 'false';         // Show profile photos when friends like this
   $showPosts = 'true';             // Show posts from the Page's timeline
   $hideCta = 'true';               // Hide the custom call to action button (if available)
   $smallHeader = 'true';           // Use the small header instead
   $adaptContainerWidth = 'true';   // Try to fit inside the container width - semi-responsive


   // pageId (required) is param or CustomGS.Facebook if set
   if ( !empty($params['pageId']) ){
      $pageId = $params['pageId'];
   } else {
      $CustomGS = cms_utils::get_module('CustomGS');
      if( is_object($CustomGS) ) {
         $CustomGS_Facebook = $CustomGS->GetField('Facebook');
         if ( !empty($CustomGS_Facebook['value']) ) {
            $pageId = $CustomGS_Facebook['value'];
         }
      }
   }

   $mod = cms_utils::get_module('Utilities');
   if( is_object($mod) && !empty($pageId) ) {
      // use other params if set
      if (!empty($params['width'])) $width = $params['width'];
      if (!empty($params['height'])) $height = $params['height'];
      if (!empty($params['hideCover'])) $hideCover = $params['hideCover'];
      if (!empty($params['showFacepile'])) $showFacepile = $params['showFacepile'];
      if (!empty($params['showPosts'])) $showPosts = $params['showPosts'];
      if (!empty($params['hideCta'])) $hideCta = $params['hideCta'];
      if (!empty($params['smallHeader'])) $smallHeader = $params['smallHeader'];
      if (!empty($params['adaptContainerWidth'])) $adaptContainerWidth = $params['adaptContainerWidth'];


      $tpl = $smarty->CreateTemplate( $mod->GetTemplateResource('facebookFeed_template.tpl'), null, null, $smarty );
      $tpl->assign('pageId', $pageId);
      $tpl->assign('width', $width);
      $tpl->assign('height', $height);
      $tpl->assign('hideCover', $hideCover);
      $tpl->assign('showFacepile', $showFacepile);
      $tpl->assign('showPosts', $showPosts);
      $tpl->assign('hideCta', $hideCta);
      $tpl->assign('smallHeader', $smallHeader);
      $tpl->assign('adaptContainerWidth', $adaptContainerWidth);
      $tpl->display();
   }

}


