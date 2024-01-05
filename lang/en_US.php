<?php
#---------------------------------------------------------------------------------------------------
# Module: Utilities
# Author: Chris Taylor
# Copyright: (C) 2016 Chris Taylor, chris@binnovative.co.uk
# Licence: GNU General Public License version 3
#          see /Utilities/lang/LICENCE.txt or <http://www.gnu.org/licenses/>
#---------------------------------------------------------------------------------------------------

$lang['friendlyname'] = 'Utilities';
$lang['admindescription'] = 'Provides a set of additional functions useful across many websites.';

$lang['install_msg'] = "You have successfully installed the 'Utilities' module.";
$lang['install_BIExtensions_error'] = "Module 'BIExtensions' needs to be uninstalled before installing 'Utilities'";
$lang['ask_uninstall'] = 'Are you sure you want to uninstall the Utilities module?';


$lang['need_permission'] = 'You need permission to be able to view or edit this page';


$lang['tab_options'] = 'Options';
$lang['token_updated'] = 'Instagram token updated';
$lang['token_not_updated'] = 'Instagram token not updated';

$lang['instagram_feed_options'] = 'instagramFeed options';
$lang['instagram_access_token'] = 'Instagram Access Token';
$lang['instagram_token_error'] = 'Instagram Token Error';
$lang['valid_token'] = 'Valid Token, refreshes at';
$lang['media_cache_refresh'] = 'Media cache, refreshes at';
$lang['no_token'] = 'no token saved';
$lang['new_instagram_token'] = 'New Instagram long-lived access token';
$lang['update_token'] = 'Update token';
$lang['new_token_field_note'] = 'Note: this field is normally empty, unless you need to submit a new token.';
$lang['instagram_media_cache'] = 'Instagram Media Cache';
$lang['clear_cache'] = 'clear cache';









###    ###   #########   ###        #########
###    ###   #########   ###        #########
###    ###   ###         ###        ###   ###
##########   #########   ###        #########
##########   #########   ###        #########
###    ###   ###         ###        ###
###    ###   #########   #########  ###
###    ###   #########   #########  ###

$lang['help'] = <<<'EOD'

<h3 name="">What does this do?</h3>
<p>'Utilities' provides a set of additional functions useful across many websites. Previously these were Plugins or UDTs.</p><br>
<p>Tags / Smarty Functions:</p>
<ul>
   <li>content_type</li>
   <li>editContentTabs</li>
   <li>googleFontUrl</li>
   <li>galleryCovers</li>
   <li>youTubePlayer</li>
   <li>vimeoPlayer</li>
   <li>cssMinifier</li>
   <li>twitterFeed</li>
   <li>facebookFeed</li>
   <li>getCustomGS</li>
   <li>adminUser</li>
   <li>adminActionUrl</li>
   <li>googleMap</li>
</ul>
<br>



<h2>Tags / Smarty Functions</h2>

<h3>content_type</h3>
<p>{content_type type='string_mime_type'}</p>
<p>Sets the request content type to a valid mime type.</p>
<p>Parameters:</p>
<ul>
   <li>type (required) - a valid mime type.</li>
</ul>
<br>



<h3>editContentTabs</h3>
<p>{editContentTabs ...} is included at the start of the admin template 'module_custom\CMSContentManager\templates\admin_editcontent.tpl'. Edits admin smarty arrays $tab_names & $tab_contents_array, to hide some tabs and move some fields.</p>
<p>Ideally this functionality would be replaced by CMSMS core functionality at some point in the future.</p>
<p>To change the displayed Admin field titles, just use the core admin_custom functionality. Add a file into /assets/admin_custom/lang/en_US.php (or similar - C<S<S v2.2+) that changes the language strings from /admin/lang/en_US.php.</p><br>
<p>Tip: if moving individual fields add one at a time to the move_fields parameter and set debug=1 - makes it easier to work out the new positions!</p>
<p>Parameters:</p>
<ul>
   <li>debug (optional) - set debug=1 to turn on output of Content Manager tabs and fields, before and after editContentTabs changes. Just to make it easier to define changes.</li>
   <li>move_tab_content (optional) - moves all content from one Tab to another Tab. Format is move_tab_content="fromTab,toTab|fromTab,toTab" e.g. move_tab_content="Logic,Options|Permissions,Options" </li>
   <li>move_fields (optional) - moves a single field from one Tab / Position to another Tab / Position. Format is move_fields="fromTab,fromPosition,toTab,toPosition|fromTab,fromPosition,toTab,toPosition" e.g. move_fields="Navigation,0,Main,0|'Navigation',1,'Main',1" </li>
   <li>rename_tab (optional) - just renames one or more tabs. Format rename_tab="fromTab,toTab|fromTab,toTab" e.g. rename_tab="Navigation,Menu". Yes - I know there can be achieved through the module_custom/lang files - it just seemed more consistent to mess with tabs/fields all in the one place!</li>
</ul>
<br>



<h3>googleFontUrl</h3>
<p>{googleFontUrl} returns the full url for including Google Fonts, e.g. for use in TinyMCE js file.</p>
<p>Actual fonts are set by the CustomGS variable 'Google Fonts'. Empty string is returned if that field is blank.</p>
<p>Parameters:</p>
<ul>
   <li>customgs_field (optional) - specify an alternative CustomGS field to use (default: 'Google Fonts').</li>
</ul>

<pre>
Create CustomGS Textfield 'Google Fonts', set help to:
e.g. 'Open+Sans|Roboto' or 'Open+Sans|Roboto:wght@700;900'  Uses Google Fonts v2 API and '&display=swap' is added to the url

Use the following in the page template:
{if !empty($googleFontUrl)}
    &lt;link rel="preconnect" href="https://fonts.googleapis.com"&gt;
    &lt;link rel="preconnect" href="https://fonts.gstatic.com" crossorigin&gt;
    &lt;link rel="stylesheet" href="{$googleFontUrl}"&gt;
{/if}
</pre>
<br>



<h3>galleryCovers</h3>
<p>sets $galleryCovers array containing the coverfile & coverpath of the full size cover images of the galleries in $dir parameter (required)</p>
<p>this is required as by default the Gallery module only provides a pre-processed thumbnail for any directories, not a url to the full image. Also doesn't handle auto-rotate correctly.</p>
<p>Parameters:</p>
<ul>
   <li> dir (required) - Gallery directory </li>
</ul>
<br>



<h3>youTubePlayer</h3>
<p>{youTubePlayer videoid='Jur1FO_nY98'} imbeds a YouTube video player in the page. Requires Bootstrap CSS.</p>
<p>uses "?rel=0&modestbranding=1" to hide related videos at end and show minimal YouTube branding</p>
<p>iframe is now always responsive - height & width paramaters no longer supported (v1.8)</p>
<p>If the 'thumbnail' option is used an image will be displayed inline and when clicked will popup a modal containing the YouTube iframe. (requires additional js)</p>
<p>Parameters:</p>
<ul>
   <li>videoid  (required)</li>
   <li>start    (optional) - begins playing the video at the given number of seconds from the start of the video</li>
   <li>class    (optional) - additional classes to be added into the class attribute</li>
   <li>autoplay (optional) - set to 1 to turn on autoplay</li>
   <li>aspect   (optional) - specify aspect ratio '16by9' (default) or '4by3'</li>
   <li>thumbnail (optional) - will display an image inline, and when clicked will popup a modal containing the YouTube iframe. Use either: 'small', 'medium', 'max', or the url of an image to use.<br>
   'small' (320x180px), 'medium' (480x360px) and 'max' (1920x1080px) are all YouTube generated thumbnails.
   <li>size     (optional) - sets the size of the popup modal (when 'thumbnail' is used) use 'sm', 'md', 'lg', 'xl'</li>
</ul>
<p>Note: if you wish to modify the template copy /Utilities/templates/youTubePlayer_template.tpl into assets/module_custom/Utilities/templates/youTubePlayer_template.tpl and modify that version. (Not changed by module upgrades).</p>
<br>



<h3>vimeoPlayer</h3>
<p>{vimeoPlayer videoid='32001208'} imbeds a vimeo video player in the page. Requires Bootstrap CSS.</p>
<p>uses "?rel=0&modestbranding=1" to hide related videos at end and show minimal vimeo branding</p>
<p>iframe is always responsive - height & width paramaters no longer supported (v1.8)</p>
<p>Parameters:</p>
<ul>
   <li>videoid  (required)</li>
   <li>class    (optional) - additional classes to be added into the class attribute</li>
   <li>aspect   (optional) - specify aspect ratio '16by9' (default) or '4by3'</li>
</ul>
<p>Note: if you wish to modify the template copy /Utilities/templates/vimeoPlayer_template.tpl into assets/module_custom/Utilities/templates/vimeoPlayer_template.tpl and modify that version. (Not changed by module upgrades).</p>
<br>



<h3>cssMinifier</h3>
<p>This CMSMS cssMinifier plugin lets a user convert the default {cms_stylesheet} into a minified css file.</p>
<p>This function takes css and compresses it, removing unneccessary whitespace, colons, removing unneccessary px/em declarations etc.</p>
<p>Replace the default {cms_stylesheet} tag with:<br>
   <code>{cssMinifier css="{cms_stylesheet nolinks=true}"}</code></p>
<p>Parameters:</p>
<ul>
   <li>(required) css (string) - css filename </li>
   <li>(optional) nominify (string) - if set the unminified css is output (for debugging)</li>
</ul>
<br>



<h3>twitterFeed</h3>
<p>outputs a Twitter Feed (see: https://dev.twitter.com/web/embedded-timelines for details).</p>
<p>Add the tag {twitterFeed} into a Widget or Footer, etc. Uses CustomGS.Twitter as default screen_name or the provided parameters</p>
<p>test with: {twitterFeed screen_name='No1FarmerJake' width=500 height=500 theme=dark link_color='#AAAA52' border_color=red chrome_options='noheader nofooter noborders noscrollbar'}</p>
<p>Parameters:</p>
<ul>
   <li>(optional) screen_name (string) - uses CustomGS.Twitter as default, or e.g. 'No1FarmerJake'</li>
   <li>(optional) width (int) - leave empty for responsive</li>
   <li>(optional) height (int) - default is 300</li>
   <li>(optional) theme (string) - 'light' (default) or 'dark</li>
   <li>(optional) link_color (string) - e.g. '#AAAA52' </li>
   <li>(optional) border_color (string) - optional or set in CSS</li>
   <li>(optional) chrome_options (string) - 1 or more of (space separated):
                        'noheader nofooter noborders noscrollbar transparent'</li>
</ul>
<p>Note: if you wish to modify the template copy /Utilities/templates/twitterFeed_template.tpl into assets/module_custom/Utilities/templates/twitterFeed_template.tpl and modify that version. (Not changed by module upgrades).</p>
<br>



<h3>facebookFeed</h3>
<p>outputs a Facebook Page Feed (see: https://developers.facebook.com/docs/plugins/page-plugin/ for details).</p>
<p>Add the tag {facebookFeed} into a Widget or Footer, etc. Uses CustomGS.Facebook as default pageId or the provided parameters</p>
<p>test with: {facebookFeed pageId='No1FarmerJake' width=500 height=500 theme=dark link_color='#AAAA52' border_color=red chrome_options='noheader nofooter noborders noscrollbar'}</p>
<p>Parameters:</p>
<ul>
   <li>width (optional) - The pixel width of the plugin. Min. is 180 and Max. is 500</li>
   <li>height (optional) - The pixel height of the plugin. Min. is 70</li>
   <li>hideCover (optional) - Hide cover photo in the header</li>
   <li>showFacepile (optional) - Show profile photos when friends like this</li>
   <li>showPosts (optional) - Show posts from the Page's timeline</li>
   <li>hideCta (optional) - Hide the custom call to action button (if available)</li>
   <li>smallHeader (optional) - Use the small header instead</li>
   <li>adaptContainerWidth (optional) - Try to fit inside the container width - semi-responsive</li>
</ul>
<p>Note: if you wish to modify the template copy /Utilities/templates/facebookFeed_template.tpl into assets/module_custom/Utilities/templates/facebookFeed_template.tpl and modify that version. (Not changed by module upgrades).</p>
<br>



<h3>getCustomGS</h3>
<p>Returns the value of the CustomGS setting.  Will work in admin page when CustomGS hasn't been set, e.g. for setting the Widget styles the same as Section styles.</p>
<p>Usage -  add the tag: {getCustomGS customgs_field='setting name'}</p>
<p>Parameters:</p>
<ul>
   <li>customgs_field (required) - The name (with spaces) of the CustomGS field to return the value of.</li>
</ul>
<br>



<h3>adminUser</h3>
<p>Tests in the front end visitor is also logged in to the CMSMS Admin. Returns true or false.</p>
<p>Usage -  add the tag: {if {adminUser}}Yes - IS ADMIN USER{else}NO - not Admin User{/if}</p>
<p>Parameters:</p>
<ul>
   <li>redirect (optional) - not recommended in most cases. If set and vistor not logged in, will redirect to the admin login page.</li>
   <li>assign (optional) - will assign the boolean result to the given variable name</li>
   redirect
</ul>
<br>



<h3>adminActionUrl</h3>
<p>Generates an admin action url for use on a frontend page, but only if the front end visitor is also logged in to the CMSMS Admin. Similar to {cms_action_url}.</p>
<p>Usage -  e.g. add the tag: {adminActionUrl module=CMSContentManager action=admin_editcontent content_id=$content_id} into a button href.</p>
<p>Parameters:</p>
<ul>
   <li>module - (optional) - The module name to generate a URL for. This parameter is not necessary if generating a URL from within a module action to an action within the same module.</li>
   <li>action - (required) - The action name to generate a URL to.</li>
   <li>returnid - (optional) - The integer pageid to display the results of the action in. This parameter is not necessary if the action is to be displayed on the current page, or if the URL is to an admin action from within an admin action.</li>
   <li>mid - (optional) - The module action id. This defaults to "m1_" for admin actions, and "cntnt01" for frontend actions.</li>
   <li>forjs - (optional) - An optional integer indicating that the generated URL should be suitable for use in JavaScript.</li>
   <li>assign - (optional) - Assign the output URL to the named smarty variable.</li>
</ul>
<br>



<h3 id="googleMap">googleMap</h3>
<p>Creates a simple Google Map using the Google Maps Embed API. See: <a target="_blank" href="https://developers.google.com/maps/documentation/embed/guide">https://developers.google.com/maps/documentation/embed/guide</a></p>
<p>This is also a simple replacement for the CGGoogleMaps module. Works fine for 1 'place' and for many other options.</p>
<p>Note: recommend using Place IDs as a stable way to uniquely identify a place. See: <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder">https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder</a></p>
<p>Usage -  e.g. add the tag: {googleMap apikey=YOUR_API_KEY q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c'} into a template.<br>See: <a target="_blank" href="https://developers.google.com/maps/documentation/embed/get-api-key">https://developers.google.com/maps/documentation/embed/get-api-key</a> for how to get 'YOUR_API_KEY'</p>
<p>Parameters:</p>
<ul>
   <li>apikey - (required) - Your Google issued API Key.</li>
   <li>height - (optional) default:500 - width is set to 100% for responsive behaviour</li>
   <li>mode - (optional) default:'place' - one of place, search, view, directions, or streetview.</li>
   <li>q - (optional) - the place to highlight on the map. It accepts a location as either a place name, address, or place ID.<br>
   Place IDs should be prefixed with place_id: e.g. q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c' </li>
   <li>zoom - (optional) default:11 - 0 (the whole world) to 21 (individual buildings)</li>
   <li>maptype - (optional) default:'roadmap' - 'roadmap' or 'satellite'</li>
   <li>parameters - (optional) - an array key & value pairs to be passed to Google Maps api. See <a target="_blank" href="https://developers.google.com/maps/documentation/embed/guide">https://developers.google.com/maps/documentation/embed/guide</a></li>
</ul>
<br>



<h3 id="instagramFeed">instagramFeed</h3>
<p>Creates an Instagram media feed of up to the last 25 images. Using the Instagram Basic Display API. See: <a target="_blank" href="https://developers.facebook.com/docs/instagram-basic-display-api/">https://developers.facebook.com/docs/instagram-basic-display-api/</a></p>
<p>The access token is valid for 60 days, but is automatically regenerated every 7 days, to keep it current. The media data is refreshed hourly and cached locally to improve speed. It is also recommended to use either SmartImage or CGSmartImage in the template to generate locally cached and optimised thumbnails.</p>
<p>Usage -  e.g. add the tag: {instagramFeed template='your_instagram_template'} into a template.</p>
<p>Parameters:</p>
<ul>
   <li>template - (optional but recommended) - name of a Design Manager template. You can copy the default template from '/Utilities/templates/instagramFeed_template.tpl'</li>
</ul>
<p>To get access to the Instagram feed details, you need to complete multiple steps to setup a Facebook for Developers App. Sorry there are so many steps, but this is the best option I could identify.</p>
<pre>
Register a Facebook Developer App:
1. Login to Facebook, then go to Facebook for Developers: <a target="_blank" href="https://developers.facebook.com/apps/">https://developers.facebook.com/apps/</a>
2. Click on 'Create App' and select the option 'Consumer' & Continue
3. Set the 'App Display Name', 'App Contact Email' then click 'Create App':
    • App Display Name: e.g. 'CMSMS Utilities - website_name' (cannot include Instagram, Insta, Facebook, etc, 32 characters max.)
    • App Contact Email: your Facebook or other email account
    • Do you have a Business Manager account?: can leave empty
4. Then 'Add Products to Your App’. Find 'Instagram Basic Display', and click the 'Set Up' button to proceed.
5. On the next page, scroll down to the bottom and click the 'Create New App' button. This should trigger a pop up window, double check your 'Display Name' and then click the 'Create App' button.

Now, you need to finalize some of the settings:
6. Scroll down to the bottom of the app dashboard to 'My Products' > 'Instagram Basic Display' and click 'Settings'.
7. Scroll down and fill following fields with your website’s root URL (https required):
    • Valid OAuth Redirect URIs
    • Deauthorize Callback URL
    • Data Deletion Requests
8. Scroll to the page bottom to 'App Review for Instagram Basic Display' and click 'Add to Submission' for both 'instagram_graph_user_profile' and 'instagram_graph_user_media' permissions. Then 'Save Changes'. 
9. Then find the 'User Token Generator' section, click 'Add or Remove Instagram Testers'. 
    • scroll to the 'Instagram Testers' section, click 'Add Instagram Testers'
    • add the username of the Instagram account you want to add to the website.

Authorise Instagram access:
10. Then you (or the owner of that Instagram account) needs to authorise access:
    Could you please authorise the website to have access to your Instagram photos and display them. (It can only display photos & cannot change anything)
    • Open a new web browser and go to www.instagram.com and sign into your Instagram account. 
    • Navigate to (Profile Icon) > Edit Profile > Apps and Websites > Tester Invites and accept the invitation.

Generate User Token for 'Utilities' module:
11. Once authorised, back in Facebook for Developers > Products > Instagram > Basic Display > User Token Generator, the newly authorised Instagram account should appear.
    • Then click 'Generate Token' button to authorize and generate a long-lived access token for Instagram and copy it.
    • Then in 'Utilities' module > Options, paste this into the 'New Instagram long-lived access token' and 'Update Token.
</pre>
<br>



<h3>Support</h3>
<p>As per the GPL licence, this software is provided as is. Please read the text of the license for the full disclaimer.
The module author is not obligated to provide support for this code. However you might get support through the following:</p>
<ul>
   <li>For support, first <strong>search</strong> the <a href="//forum.cmsmadesimple.org">CMS Made Simple Forum</a>, for issues with the module similar to those you are finding.</li>
   <li>Then, if necessary, open a <strong>new forum topic</strong> to request help, with a thorough description of your issue, and steps to reproduce it.</li>
   <li>If you find a bug you can <a href="http://dev.cmsmadesimple.org/bug/list/1421">submit a Bug Report</a>.</li>
   <li>For any good ideas you can <a href="http://dev.cmsmadesimple.org/feature_request/list/1421">submit a Feature Request</a>.</li>
   <li>If you found the Module useful - shout out to me on Twitter <a href="//twitter.com/KiwiChrisBT">@KiwiChrisBT</a></li>
</ul><br>


<h3>Copyright &amp; Licence</h3>
<p>Copyright © 2019, Chris Taylor <chris at binnovative dot co dot uk>. All Rights Are Reserved.</p><br>
<p>This module has been released under the GNU Public License v3. However, as a special exception to the GPL, this software is distributed as an addon module to CMS Made Simple. You may only use this software when there is a clear and obvious indication in the admin section that the site was built with CMS Made Simple!</p><br>
<br>
EOD;








#########  ###    ###  ##########  ###    ###  #########  ########  ###       #########  #########
#########  ###    ###  ##########  ####   ###  #########  ########  ###       #########  #########
###        ###    ###  ###    ###  #####  ###  ###        ###       ###       ###   ###  ###
###        ##########  ##########  ### ## ###  ###        ########  ###       ###   ###  ###
###        ##########  ##########  ###  #####  ###   ###  ########  ###       ###   ###  ###   ###
###        ###    ###  ###    ###  ###   ####  ###   ###  ###       ###       ###   ###  ###   ###
#########  ###    ###  ###    ###  ###    ###  #########  ########  ######### #########  #########
#########  ###    ###  ###    ###  ###    ###  #########  ########  ######### #########  #########

$lang['changelog'] = <<<'EOD'

<h3>Version 1.9 - 05Jan24</h3>
<ul>
   <li>vimeoPlayer - added new functionality</li>
</ul>
<br>


<h3>Version 1.8 - 02Aug23</h3>
<ul>
   <li>googleFontUrl - updated to use v2 API and '&display=swap' is added to the url. Should also work for v1 style field value ('|' replaced by '&family=').</li>
</ul>
<br>


<h3>Version 1.7.2 - 21Jun23</h3>
<ul>
   <li>fix warning messages php8+ - ($smarty) must be passed by reference, value given</li>
</ul>
<br>


<h3>Version 1.7.1 - 15Jun23</h3>
<ul>
   <li>editContentTabs - bug fixes for php warning & error resilience</li>
</ul>
<br>


<h3>Version 1.7 - 22May23</h3>
<ul>
   <li>youTubePlayer - added size parameter + upgraded to use BS5.</li>
</ul>
<br>


<h3>Version 1.6.1 - 10Jan23</h3>
<ul>
   <li>improvements to editContentTabs to make it more resilient to missing tabs & fields</li>
</ul>
<br>


<h3>Version 1.6 - 30Nov22</h3>
<ul>
   <li>update to cssMinifier code - thanks to Magal for the code and heads up :)</li>
</ul>
<br>


<h3>Version 1.5 - 02Jun21</h3>
<ul>
   <li>added instagramFeed tag - Creates an Instagram media feed of up to the last 25 images. Using the Instagram Basic Display API.</li>
   <li>adds an admin page for Utilities module</li>
</ul>
<br>


<h3>Version 1.4 - 22Aug20</h3>
<ul>
   <li>added googleMap tag - a simple replacement for CGGoogleMaps</li>
</ul>
<br>


<h3>Version 1.3 - 15Jul20</h3>
<ul>
   <li>added adminActionUrl tag - thanks Velden :)</li>
</ul>
<br>


<h3>Version 1.2 - 02Jul20</h3>
<ul>
   <li>added adminUser tag - thanks Velden :)</li>
</ul>
<br>

<h3>Version 1.1.1 - 17Jun19</h3>
<ul>
   <li>minor bug fix in help</li>
</ul>
<br>

<h3>Version 1.1 - 14Mar19</h3>
<ul>
   <li>added nominify parameter</li>
   <li>Extra help notes for editContentTabs</li>
</ul>
<br>

<h3>Version 1.0 - 16Feb19</h3>
<ul>
   <li>first public release</li>
</ul>
<br>

EOD;


