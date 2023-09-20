<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


function editContentTabs($params, $smarty) {
//***********************************************************************************************
// edits admin smarty arrays $tab_names & $tab_contents_array, to hide some tabs and
// move some fields to other tabs
//***********************************************************************************************
   $tab_names = $smarty->get_template_vars('tab_names');
   $tab_contents_array = $smarty->get_template_vars('tab_contents_array');
   $tab_lookup = !empty($tab_names) ? array_flip($tab_names) : [];

   if ( isset($params['debug']) ) {
      echo "<pre>editContentTabs - debug ON - before changes \n\n";
      echo "Tabs & Content are:\n";
      foreach ($tab_contents_array as $tabkey => $tab) {
         echo "Tab: '".$tab_names[$tabkey]."'\n";
         foreach ($tab as $contentpos => $content) {
            echo "    [$contentpos] '".$content[0]."'\n";
         }
      }
      echo "</pre>";
   }

   // move_tab_content - moves all content from: Tab to: Tab
   if ( !empty($params['move_tab_content']) ) {
      $moveTabs = explode('|', $params['move_tab_content']);
      foreach ($moveTabs as $moveTab) {
         $tmp = explode(',', trim($moveTab) );
         if ( count($tmp)==2 ) {
            $from_tab_name = trim(trim($tmp[0], '"'), "'");
            $fromTab = isset($tab_lookup[$from_tab_name]) ? $tab_lookup[$from_tab_name] : NULL;
            $to_tab_name = trim(trim($tmp[1], '"'), "'");
            $toTab = isset($tab_lookup[$to_tab_name]) ? $tab_lookup[$to_tab_name] : NULL;
            if ( $fromTab && $toTab ) {
                $tab_contents_array[$toTab] = array_merge ( $tab_contents_array[$toTab],
                                                            $tab_contents_array[$fromTab] );
                unset($tab_names[$fromTab]);
                unset($tab_contents_array[$fromTab]);
            }
         }
      }
   }


   // move_fields - from: Tab / Position to: Tab / Position
   if ( !empty($params['move_fields']) ) {
      $moves = explode('|', $params['move_fields']);
      foreach ($moves as $move) {
         $tmp = explode(',', trim($move) );
         if ( count($tmp)==4 ) {
            $from_tab_name = trim(trim($tmp[0], '"'), "'");
            $fromTab = isset($tab_lookup[$from_tab_name]) ? $tab_lookup[$from_tab_name] : NULL;
            $fromPos = trim(trim($tmp[1], '"'), "'");
            $to_tab_name = trim(trim($tmp[2], '"'), "'");
            $toTab = isset($tab_lookup[$to_tab_name]) ? $tab_lookup[$to_tab_name] : NULL;
            $toPos = trim(trim($tmp[3], '"'), "'");
            if ( $fromTab && $toTab && is_integer($fromPos) && is_integer($toPos) ) {
                // now move & remove
                array_splice( $tab_contents_array[$toTab], $toPos, 0,
                array($tab_contents_array[$fromTab][$fromPos]) );
                unset( $tab_contents_array[$fromTab][$fromPos] );
            }
         }
      }
   }


   // rename_tab
   if ( !empty($params['rename_tab']) ) {
      $renameTabs = explode('|', $params['rename_tab']);
      foreach ($renameTabs as $renameTab) {
         $tmp = explode(',', trim($renameTab) );
         if ( count($tmp)==2 ) {
            $from_tab_name = trim(trim($tmp[0], '"'), "'");
            $fromTab = isset($tab_lookup[$from_tab_name]) ? $tab_lookup[$from_tab_name] : NULL;
            $to_tab_name = trim(trim($tmp[0], '"'), "'");
            $toTab = isset($tab_lookup[$to_tab_name]) ? $tab_lookup[$to_tab_name] : NULL;
            if ( $fromTab && $toTab ) {
                $fromTab = $tab_lookup[trim(trim($tmp[0], '"'), "'")];
                $toTab = trim(trim($tmp[1], '"'), "'");
                $tab_names[$fromTab] = $toTab;
            }
         }
      }
   }


   // hide tabs - automatically remove any empty tabs
   foreach ($tab_contents_array as $tabkey => $tab) {
      if ( empty($tab) ) {
         unset($tab_names[$tabkey]);
         unset($tab_contents_array[$tabkey]);
      }
   }


   // set smarty vars
   $smarty->assign('tab_names', $tab_names);
   $smarty->assign('tab_contents_array', $tab_contents_array);


   if ( isset($params['debug']) ) {
      echo "<pre>editContentTabs - debug ON - after changes\n\n";
      echo "Tabs & Content are:\n";
      foreach ($tab_contents_array as $tabkey => $tab) {
         echo "Tab: '".$tab_names[$tabkey]."'\n";
         foreach ($tab as $contentpos => $content) {
            echo "    [".$contentpos."] '";
               print_r($content[0]);
            echo "'\n";
         }
      }
      echo "</pre>";
   }
}


