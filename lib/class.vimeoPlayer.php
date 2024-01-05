<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2018 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

class vimeoPlayer {

    const MODULE_NAME = 'Utilities';
    const DEFAULT_TEMPLATE = 'vimeoPlayer_template.tpl';

    private $mod;



    public function __construct() 
    {
        $this->mod = cms_utils::get_module( $this::MODULE_NAME );
    }



    /**
     * output smarty template
     */
    public function output($params, &$smarty)
    {
        if ( empty($params['videoid'])) return;

        if (!empty($params['template'])) {
            $template = strval($params['template']);
        } else {
            $template = $this::DEFAULT_TEMPLATE;
        }

        $tpl = $smarty->CreateTemplate( $this->mod->GetTemplateResource($template), null, null, $smarty );
        $tpl->assign('mod', $this->mod);
        // add sanitised params to template
        if (isset($params['class'])) $class = $params['class'];
        
        $tpl->assign('class', $params['class'] ?? '');
        $aspect = isset($params['aspect']) && $params['aspect']=='4by3' ? '4by3' : '16by9';
        $tpl->assign('aspect', $aspect);
        // $tpl->assign('autoplay', isset($params['autoplay']) ? TRUE : FALSE);
        $tpl->assign('videoid', trim($params['videoid']));

        $tpl->display();
    }



}