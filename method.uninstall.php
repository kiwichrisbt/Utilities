<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

if( !defined('CMS_VERSION') ) exit;

// unregister all functions
$smarty->unregister_function('content_type');
$smarty->unregister_function('galleryCovers');
$smarty->unregister_function('googleFontUrl');
$smarty->unregister_function('getCustomGS');
$smarty->unregister_function('is_admin_user');
$smarty->unregister_function('admin_user_action_url');

$smarty->unregister_function('cssMinifier');
$smarty->unregister_function('youTubePlayer');
$smarty->unregister_function('editContentTabs');
$smarty->unregister_function('twitterFeed');
$smarty->unregister_function('facebookFeed');


