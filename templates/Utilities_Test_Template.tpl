{* Utilities_Test_Template - v1.2 - 02Jul20

   - v1.2 - 02Jul20 - extra test for admin_user & move test template into Utilities/templates
   - v1.1 - 07Feb19 - remove some redundant content
   - v1.0 - 05Feb19 -

   Template stored in Utilities/templates/Utilities_Test_Template.tpl
      - create a very simple core:page template 'Utilities_Test' with just the 1 line:
            {include file='module_file_tpl:Utilities;Utilities_Test_Template.tpl'}
      - create 'Utilities Test' page, using the above template.

********************************************************************************************}{strip}
{content oneline=1 label="Utilities TEST Template" assign=content1}


{cgjs_require lib='jquery'}
{cgjs_require jsfile='assets/js/bootstrap.bundle.min.js'}
{cgjs_require lib='form'}
{cgjs_require jsfile='assets/js/slick.min.js'}
{cgjs_require jsfile='assets/js/main.js'}


{/strip}<!DOCTYPE html>
<html lang="en">
<head>
{include file='cms_template:Standard Global Metadata'}
   {*cms_stylesheet*}
   {cssMinifier css="{cms_stylesheet nolinks=true}"}
   <style>{literal}.pre {font-family:monospace; white-space:pre-wrap; word-wrap:break-word;
       background-color:#DDD; padding:1em;}{/literal}</style>
</head>

<body class="page-{$page_alias}">

{global_content name='header'}

<div class="main">
   <div class="container">
      <div class="row">
         <div class="col-12">

<h1>Utilities Test Page - Frontend Tests</h1>


<h2>Test 1: galleryCovers</h2>
<p>$galleryCovers dir='project-galleries' is:</p>
<div class="pre">{galleryCovers dir='project-galleries'}{$galleryCovers|print_r}</div>
<div class="row">
   {foreach $galleryCovers as $img}
      <div class="col-2"><img src="{uploads_url}/{$img}" alt=""></div>
   {/foreach}
</div><br>



<h2>Test 2: googleFontUrl</h2>
{content block=content2 label="googleFontUrl: check that correct fonts being used in TinyMCE" assign=content2}
<p>googleFontUrl is: '{googleFontUrl}'</p>
<br>


<h2>Test 3: cssMinifier</h2>
<p>To check <strong>cssMinifier</strong> output:</p>
<ol>
   <li>view page source</li>
   <li>find CSS link in head '...minified_stylesheet_combined_...'</li>
   <li>open in New Tab</li>
   <li>check that all CSS is minified :)</li>
</ol>
<br>


<h2>Test 4: youTubePlayer</h2>
<p>youTubePlayer - load YouTube iframe immediately (default)</p>
<div class="col-3">{youTubePlayer videoid="Jur1FO_nY98"}</div><br>

<p>youTubePlayer - load thumbnail only & YouTube popup only on click (needs js)</p>
<div class="col-3">{youTubePlayer videoid="Jur1FO_nY98" thumbnail=medium}</div><br>


<h2>Test 5: twitterFeed</h2>
<div class="col-5">{twitterFeed screen_name='cmsms'}</div><br>


<h2>Test 6: editContentTabs</h2>
{content block=content3 label="Test 6: editContentTabs: check that correct tabs and fields are being displayed. Could make additional changes & test if required" oneline=1 assign=content3}
<p>Nothing to see on the frontend!</p><br>


<h2>Test 7: facebookFeed</h2>
{facebookFeed pageId='BInnovativeWebDevelopment'}<br><br>


<h2>Test 8: getCustomGS</h2>
<p>Should show the CustomGS 'Facebook' setting here: '{getCustomGS customgs_field='Facebook'}'</p><br>


<h2>Test 9: admin_user</h2>
<p>admin_user:{if {adminUser}}Yes - IS ADMIN USER{else}NO - not Admin User{/if}<br>
   <small>open in incognito window to test if not logged in</small></p><br>



<h2>Test 10: adminActionUrl</h2>
<p>If NOT Admin User: button links to home page & url is blank<br>
   If IS Admin User: button & url shown below:<br>
   <ul>
      <li><a class="btn btn-default" href="{adminActionUrl module=CMSContentManager action=admin_editcontent content_id=$content_id}">Edit this page :)</a></li>
      <li>url: {adminActionUrl module=CMSContentManager action=admin_editcontent content_id=$content_id}</li>
   </ul>
   <small>open in incognito window to test if not logged in</small></p><br>
         </p><br>

         

   <h2>Test 11: googleMap - basic</h2>
   {content block=content11 label="googleMap apikey: enter apikey here (required)" oneline=1 assign=googleMapsApiKey}
   <p>default tag only api key: {ldelim}googleMap apikey=$googleMapsApiKey{rdelim}</p>
   {googleMap apikey=$googleMapsApiKey}
   <br>

   <h2>Test 11A: googleMap - no apikey</h2>
   <p>default tag without any parameters: {ldelim}googleMap{rdelim}</p>
   {googleMap height=100}
   <br>

   <h2>Test 11B: googleMap - with parameters</h2>
   <p>default tag without any parameters: {ldelim}googleMap apikey=$googleMapsApiKey q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c' height=400 zoom=19 maptype=satellite{rdelim}</p>
   {googleMap apikey=$googleMapsApiKey q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c' height=400 zoom=19 maptype=satellite}
   <br>
   <p>and the tag using in the help: {ldelim}googleMap apikey=YOUR_API_KEY q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c'{rdelim}</p>
   {googleMap apikey=$googleMapsApiKey q='place_id:ChIJ2dGMjMMEdkgRqVqkuXQkj7c'}
   <br>

   <h2>Test 11C: googleMap - view mode with parameters</h2>
   <p>{ldelim}$parametersC.center='-33.8569,151.2152'{rdelim}
      {ldelim}googleMap apikey=$googleMapsApiKey height=400 zoom=18 maptype=satellite mode=view  parameters=$parametersC{rdelim}</p>
   {$parametersC.center='-33.8569,151.2152'}
   {googleMap apikey=$googleMapsApiKey height=400 zoom=18 maptype=satellite mode=view  parameters=$parametersC}
   <br>

   <h2>Test 12: instagramFeed - ...</h2>
   <p>{ldelim}instagramFeed{rdelim}</p>
   {instagramFeed}
   <br>


<br><br><p>That's it. All Tests done :)</p>

         </div>
      </div>
   </div>
</div><!-- main-->


{global_content name='footer'}

{googleFontUrl urlonly=1 assign=googleFontUrl}
{if !empty($googleFontUrl)}
   <link rel="stylesheet" type="text/css" href="{$googleFontUrl}">
{/if}
{cgjs_render addkey='19Oct18'}

</body>
</html>