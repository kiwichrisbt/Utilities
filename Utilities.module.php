<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Module's homepage is: http://dev.cmsmadesimple.org/projects/utilities
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2019 by CMS Made Simple Foundation (copyright@cmsmadesimple.org)
# Project's homepage is: http://www.cmsmadesimple.org
#---------------------------------------------------------------------------------------------------
# This program is free software; you can redistribute it and/or modify it under the terms of the
# GNU General Public License as published by the Free Software Foundation; either version 3
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License along with this program.
# If not, see <http://www.gnu.org/licenses/>.
#---------------------------------------------------------------------------------------------------


// put more complex functions in separate function.Name.php file - but require here:
$fn = cms_join_path(__DIR__,'function.cssMinifier.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.youTubePlayer.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.twitterFeed.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.editContentTabs.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.facebookFeed.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.adminActionUrl.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.googleMap.php'); require_once($fn);


class Utilities extends \CMSModule {

   public function GetVersion() { return '1.9'; }
   public function GetFriendlyName() { return 'Utilities'; }
   public function GetAdminDescription() { return $this->Lang('admindescription'); }
   public function IsPluginModule() { return TRUE; }
   public function HasAdmin() { return TRUE; }
   public function VisibleToAdminUser() { return $this->CheckPermission('Modify Site Preferences'); }
   public function GetHelp() { return $this->Lang('help'); }
   public function GetAuthor() { return 'Chris Taylor'; }
   public function GetAuthorEmail() { return 'chris@binnovative.co.uk'; }
   public function GetChangeLog() { return $this->Lang('changelog'); }
   public function MinimumCMSVersion() { return '2.0'; }
   public function InstallPostMessage() { return $this->Lang('install_msg'); }
   public function UninstallPreMessage() { return $this->Lang('ask_uninstall'); }


    public function __construct() 
    {
        parent::__construct();

        $smarty = \CmsApp::get_instance()->GetSmarty();
        if( !$smarty ) return;

        // register functions - leave simple functions in this file
        $smarty->register_function('content_type', array($this, 'content_type') );
        $smarty->register_function('galleryCovers', array($this, 'galleryCovers') );
        $smarty->register_function('googleFontUrl', array($this, 'googleFontUrl') );
        $smarty->register_function('getCustomGS', array($this, 'getCustomGS') );
        $smarty->register_function('adminUser', array($this, 'adminUser') );
        $smarty->register_function('instagramFeed', array($this, 'instagramFeed') );
        $smarty->register_function('vimeoPlayer', array($this, 'vimeoPlayer') );


        // register functions - put more complex functions in separate function.Name.php file
        $smarty->register_function('cssMinifier', 'cssMinifier');
        $smarty->register_function('youTubePlayer', 'youTubePlayer');
        $smarty->register_function('editContentTabs', 'editContentTabs');
        $smarty->register_function('twitterFeed', 'twitterFeed');
        $smarty->register_function('facebookFeed', 'facebookFeed');
        $smarty->register_function('adminActionUrl', 'adminActionUrl');
        $smarty->register_function('googleMap', 'googleMap');

    }



   public function InitializeFrontend() {
      $this->SetParameterType('screen_name', CLEAN_STRING);
      $this->SetParameterType('width', CLEAN_INT);
      $this->SetParameterType('height', CLEAN_INT);
      $this->SetParameterType('theme', CLEAN_STRING);
      $this->SetParameterType('link_color', CLEAN_STRING);
      $this->SetParameterType('border_color', CLEAN_STRING);
      $this->SetParameterType('chrome_options', CLEAN_STRING);
      $this->SetParameterType('assign', CLEAN_STRING);
      $this->SetParameterType('customgs_field', CLEAN_STRING);
      $this->SetParameterType('move_tab_content', CLEAN_STRING);
      $this->SetParameterType('move_fields', CLEAN_STRING);
      $this->SetParameterType('rename_tab', CLEAN_STRING);
      $this->SetParameterType('pageId', CLEAN_STRING);
      $this->SetParameterType('hideCover', CLEAN_STRING);
      $this->SetParameterType('showFacepile', CLEAN_STRING);
      $this->SetParameterType('showPosts', CLEAN_STRING);
      $this->SetParameterType('hideCta', CLEAN_STRING);
      $this->SetParameterType('smallHeader', CLEAN_STRING);
      $this->SetParameterType('adaptContainerWidth', CLEAN_STRING);
      $this->SetParameterType('customgs_field', CLEAN_STRING);
      // don't add any more parameters here - just clean when each is used by function
      // to do - move these to each function also
   }



   // ******************************************************************************************* //
   // Simple functions - start here
   // ******************************************************************************************* //



   function content_type ($params) {
   // ******************************************************************************************* //
   // Sets the request content type to a valid mime type
   // ******************************************************************************************* //

      if ( isset($params['type']) )
         $content_type = strval( $params['type'] );

      if ( !empty( $content_type ) )
         CMSApp::get_instance()->set_content_type($content_type);

   }


   function galleryCovers($params, $smarty) {
   // **********************************************************************************************
   // sets $galleryCovers array containing the coverfile & coverpath of the full size cover images
   // of the galleries in $dir parameter  required
   // **********************************************************************************************
      $out = '';
      $dir = strval($params['dir']);

      $galleryCovers = array();
      $Gallery = cms_utils::get_module('Gallery');
      if( is_object($Gallery) && !empty($dir) ) {
         // PG = Parent Gallery, CG = Child Gallery, CI = Cover Image
         $sql = "SELECT CG.*, CI.filename AS coverfile, CI.filepath AS coverpath
            FROM ".cms_db_prefix()."module_gallery AS PG
            JOIN ".cms_db_prefix()."module_gallery AS CG
               ON PG.fileid = CG.galleryid
            JOIN ".cms_db_prefix()."module_gallery AS CI
                  ON CG.defaultfile = CI.fileid
            WHERE PG.filename='".$dir."/'";
         $db = \cms_utils::get_db();
         $res = $db->GetArray($sql, $dir.'/');
      }
      foreach ($res as $gallery) {
         $galleryCovers[$gallery['filepath'].$gallery['filename']] =
            'images/Gallery/'.$gallery['coverpath'].$gallery['coverfile'];
      }

      $smarty->assign('galleryCovers', $galleryCovers);
   }



    /**
     *  @return string google font url to fonts specified in CustomGS 
     *  @param string customgs_field - 'Google Fonts' (default)
     */
    function googleFontUrl($params, $smarty) 
    {
        $out='';
        $CustomGS = cms_utils::get_module('CustomGS');
        $CustomGSFieldName = 'Google Fonts';
        $display = 'swap';

        if ( !empty($params['customgs_field']) ) {
            $CustomGSFieldName = filter_var($params['customgs_field'], FILTER_SANITIZE_STRING);
        }
        if ( is_object($CustomGS) ) {
            //  $googleFonts = $CustomGS->GetField($CustomGSField);
            $CustomGSField = $CustomGS->GetField($CustomGSFieldName);

            if ( !empty($CustomGSField['value']) ) {
            // str_replace($CustomGSField['value'], '|', '&family=')
                $font_families = str_replace('|', '&family=', $CustomGSField['value']);
                // $CustomGSField['value'] implode('&family=',)
                //  output full googleapis url
                $out = '//fonts.googleapis.com/css2?family='.$font_families.'&display='.$display;
            }
        }
        if ( !empty($params['assign']) ) {
            $smarty->assign( $params['assign'], $out );
        } else {
            echo $out;
        }
    }



   function getCustomGS($params, $smarty) {
   //***********************************************************************************************
   // based on pageVars getCustomGS
   //***********************************************************************************************
      $CustomGS = cms_utils::get_module('CustomGS');

      if( is_object($CustomGS) && !empty($params['customgs_field']) ) {
         $tmp = $CustomGS->GetField( $params['customgs_field'] );
         $value = $tmp['value'];
         return $value;
      }
   }


   function adminUser($params, $smarty) {
   //***********************************************************************************************
   // based on Veldens suggestion
   //***********************************************************************************************

      $assign = (isset($params['assign']) ? $params['assign'] : false);
      $redirect = (isset($params['redirect']) ? (boolean) $params['redirect'] : false);

      $userid = get_userid($redirect);

      if ( $assign ) {
         $smarty->assign($assign, (boolean) $userid );
      } else {
         return (boolean) $userid;
      }

   }



    /**
     *  outputs an instagram feed
     *
     *  @param template - optional DM template to use
     */ 
    function instagramFeed($params, $smarty) 
    {
        $feed = new instagramFeed;
        $feed->getMedia();
        $feed->display($params, $smarty);
    }



    /**
     *  outputs an vimeo video
     *
     */ 
    function vimeoPlayer($params, $smarty) 
    {
        $video = new vimeoPlayer;
        $video->output($params, $smarty);
    }



}