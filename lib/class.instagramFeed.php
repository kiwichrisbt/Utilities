<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2018 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

class instagramFeed {

    private $modulename = 'Utilities';
    private $mod;
    private $data = [];
    private $errors = [];
    private $media_url = "https://graph.instagram.com/me/media?fields=username,media_url,media_type,thumbnail_url,permalink,timestamp,caption&access_token=";   // + $token
    private $refresh_url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=";  // + $token
    private $template = 'instagramFeed_template.tpl';

    public $token_refresh_period = 7*24*60*60;   // 7 days
    public $media_refresh_period = 60*60; // 1 hour
    


    #---------------------
    # Magic methods
    #---------------------
    public function __construct() {

        $this->mod = cms_utils::get_module( $this->modulename );
        
    }



    /**
     * simple curl helper function 
     * 
     * @return array decoded repsonse
     */
    public function request($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $request = curl_exec($curl);
        curl_close($curl);
        $request = json_decode($request, true);
        return $request;
    }



    /**
     * returns current valid token or if current token older than refresh period (7 days) gets a new 
     * token from Instagram.
     * 
     * @return string token (or empty string)
     */
    function getToken()
    {
        $mod = $this->mod;
        $config = \CmsApp::get_instance()->GetConfig();
        $rootUrl = $config['root_url'];
        $token = $mod->GetPreference('instagram_token');
        $token_timestamp = intval($mod->GetPreference('instagram_token_timestamp'));  
        $now = time();

        if ( $now > ($token_timestamp + $this->token_refresh_period) ) {

            $response = $this->request( $this->refresh_url.$token );

            if ( isset($response['access_token']) && $response['access_token']!='' ) {
                // save new token & update timestamp
                $token = strval($response['access_token']);
                $mod->SetPreference( 'instagram_token', $token );
                $mod->SetPreference( 'instagram_token_timestamp', time() );
            } else {
                $error = $mod->Lang('instagram_token_error');
                $mod->Audit( 0, $mod->Lang('friendlyname'), $error );
                $errors[] = $error;
            }

        }

        return $token;
    }



    /**
     * retrieves media data either from Instagram or media data cached for (1hr?)
     */
    public function getMedia()
    {
        $mod = $this->mod;
        $media_timestamp = intval($mod->GetPreference('instagram_media_timestamp'));  
        $now = time();

        if ( $now > ($media_timestamp + $this->media_refresh_period) ) {
            // get fresh media data from Instagram
            $token = $this->getToken();
            $response = $this->request( $this->media_url.$token );

            if (isset( $response['data']) ) {
                $this->data = $response['data'];
                $mod->SetPreference( 'instagram_media', json_encode($this->data) );
                $mod->SetPreference( 'instagram_media_timestamp', time() );

            } else {
                $this->error = isset($response['error']) ? $response['error'] : $mod->Lang('instagram_media_error');
                $mod->SetPreference( 'instagram_media_timestamp', 0 );
                $mod->Audit( 0, $mod->Lang('friendlyname'), $error );
                $errors[] = $error;
            }
            
        } else {
            // use cached media data
            $this->data = json_decode( $mod->GetPreference('instagram_media'), true );

        }

    }



    /**
     * output smarty template
     */
    public function display($params, &$smarty)
    {
        if (!empty($params['template'])) {
            $template = strval($params['template']);
        } else {
            $template = $this->template ;
        }
        $tpl = $smarty->CreateTemplate( $this->mod->GetTemplateResource($template), null, null, $smarty );
        $tpl->assign('mod', $this->mod);
        $tpl->assign('errors', $this->errors);
        $tpl->assign('data', $this->data);
        $tpl->display();
    }



}