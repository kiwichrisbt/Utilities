<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function cssMinifier($params, $smarty) {
//**************************************************************************************************
// based on Plugin cssMinifier v1.0, by Magal Hezi @author Steffen Becker
//
// Credits for some of this code go to:
//    - Magal Hezi @author Steffen Becker - cssMinifier plugin
//    - Christian Schaefer: twitter.com/derSchepp, github.com/Schepp/CSS-JS-Booster
//
//**************************************************************************************************

   $data_field = isset($params['css']) ? $params['css'] : '';
   $cssFiles = explode(",", $data_field);
   $cssContents = '';
   $config = \cms_config::get_instance();

   foreach($cssFiles as $file) {
      $filename = basename($file);

      if ( isset($params['nominify']) ) {
         echo '<link rel="stylesheet" type="text/css" href="'.$config['tmp_cache_location'].'/'.$filename.'" />';

      } else { // minify
         $cssContents = file_get_contents($config['tmp_cache_location'].'/'.$filename);
         $minFileName = 'minified_'.$filename;
         $minFileFullPath = $config['tmp_cache_location'].'/'.$minFileName;

         if (!file_exists($minFileFullPath)) {
            file_put_contents($minFileFullPath, minifyCss($cssContents));
         }
         echo '<link rel="stylesheet" type="text/css" href="'.$config['public_cache_url'].'/'.$minFileName.'" />';
      }
   }
}



function minifyCss($css) {
   // some of the following functions to minimize the css-output are directly taken
   // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
   // all credits to Christian Schaefer: http://twitter.com/derSchepp

   // remove comments
   $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

   // backup values within single or double quotes
   preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
   for ($i=0; $i < count($hit[1]); $i++) {
      $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
   }

   // remove traling semicolon of selector's last property
   $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
   // remove any whitespace between semicolon and property-name
   $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
   // remove any whitespace surrounding property-colon
   $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
   // remove any whitespace surrounding selector-comma
   $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
   // remove any whitespace surrounding opening parenthesis
   $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
   // remove any whitespace between numbers and units
   $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
   // shorten zero-values
   $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
   // constrain multiple whitespaces
   $css = preg_replace('/\p{Zs}+/ims',' ', $css);
   // remove newlines
   $css = str_replace(array("\r\n", "\r", "\n"), '', $css);

   // Restore backupped values within single or double quotes
   for ($i=0; $i < count($hit[1]); $i++) {
      $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
   }

   return $css;
}


