<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2019 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------


//***********************************************************************************************
// based on UDT youTubePlayer - v1.2 - 26Sep16
//***********************************************************************************************
function youTubePlayer($params, $smarty) 
{
    $mod = cms_utils::get_module('Utilities');

    if ( is_object($mod) && !empty($params['videoid']) ) {
        $videoid = trim($params['videoid']);
        $class = '';
        $start = '';
        $autoplay = '';
        $text = '';
        $aspect = '16by9';
        $thumbnail = '';
        $size = 'lg';
        if (isset($params['class'])) $class = $params['class'];
        if (isset($params['start'])) $start = '&start='.(int)$params['start'];
        if (isset($params['autoplay']) && $params['autoplay']==1) $autoplay = '&autoplay=1';
        if (isset($params['aspect']) && $params['aspect']=='4by3') $aspect = '4by3';
        if (isset($params['text'])) $text = $params['text'];
        if (isset($params['thumbnail'])) {
            $thumb = trim($params['thumbnail']);
            switch ($thumb) {
                case 'small':
                $thumbnail = '//i1.ytimg.com/vi/'.$videoid.'/mqdefault.jpg';  // small - 320 x 180px
                break;
                case 'medium':
                $thumbnail = '//i1.ytimg.com/vi/'.$videoid.'/0.jpg';  // medium - 480 x 360px
                break;
                case 'max':
                $thumbnail = '//i1.ytimg.com/vi/'.$videoid.'/maxresdefault.jpg';  // max - 1920 x 1080px
                break;
                default:
                $thumbnail = $thumb;
            }
        }
        if (isset($params['size']) && in_array($params['size'], ['sm','md','lg','xl']) ) {
            $size = $params['size'];
        }

        $tpl = $smarty->CreateTemplate( $mod->GetTemplateResource('youTubePlayer_template.tpl'), null, null, $smarty );
        $tpl->assign('videoid', $videoid);
        $tpl->assign('class', $class);
        $tpl->assign('start', $start);
        $tpl->assign('autoplay', $autoplay);
        $tpl->assign('aspect', $aspect);
        $tpl->assign('text', $text);
        $tpl->assign('thumbnail', $thumbnail);
        $tpl->assign('size', $size);
        $tpl->display();

    }
}


