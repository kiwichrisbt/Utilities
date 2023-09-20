<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function googleMap($params, $smarty) {
//**************************************************************************************************
// see: https://developers.google.com/maps/documentation/embed/get-started
//**************************************************************************************************

   // set defaults
   $apikey = ''; // YOUR_API_KEY - required to function
   $height = 500;
   $mode = 'place'; // is one of place, search, view, directions, or streetview
   $parameters['q'] = 'London, UK'; // q defines the place to highlight on the map
   $parameters['zoom'] = 11;  //  0 (the whole world) to 21 (individual buildings)
   $parameters['maptype'] = 'roadmap'; // roadmap (the default) or satellite

   // set other params if used
   if (!empty($params['apikey'])) $apikey = (string) $params['apikey'];
   if (!empty($params['height'])) $height = (int) $params['height'];
   if (!empty($params['mode'])) $mode = (string) $params['mode'];
   if (!empty( $params['parameters']) && is_array($params['parameters']) ) {
      $parameters = array_merge($parameters, $params['parameters']);
   }
   if ($mode!='place') unset( $parameters['q'] ); // remove default place for this mode
   if (!empty($params['q'])) $parameters['q'] = (string) $params['q'];
   if (!empty($params['zoom'])) $parameters['zoom'] = (int) $params['zoom'];
   if (!empty($params['maptype'])) $parameters['maptype'] = (string) $params['maptype'];
   $parameters = str_replace( '%3A', ':', http_build_query($parameters) );
   
   $mod = cms_utils::get_module('Utilities');
   $tpl = $smarty->CreateTemplate( $mod->GetTemplateResource('googleMap_template.tpl'), null, null, $smarty );
   $tpl->assign('apikey', $apikey);
   $tpl->assign('height', $height);
   $tpl->assign('mode', $mode);
   $tpl->assign('parameters', $parameters);
   $tpl->display();

}


