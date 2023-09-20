<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

if ( !defined('CMS_VERSION') ) exit;


if ($oldversion < '1.5') {
    // delete an unused test dir and template
    $test_dir = $this->GetModulePath().DIRECTORY_SEPARATOR.'test';
    unlink($test_dir.DIRECTORY_SEPARATOR.'Utilities_Test_Template.tpl'); 
    rmdir($test_dir);
}


// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded', $this->GetVersion()) );


