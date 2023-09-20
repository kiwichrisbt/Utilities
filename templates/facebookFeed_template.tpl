{* facebookFeed_template.tpl - v1.2 - 06Feb19

   - v1.2 - 06Feb19 - added into Utilities
   - v1.1 - 01Dec15

   See https://developers.facebook.com/docs/plugins/page-plugin/ for details.

***************************************************************************************************}
   <div id="fb-root"></div>
   <script>{literal}(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   {/literal}</script>
   <div class="fb-page" data-href="https://www.facebook.com/{$pageId}/" data-width="{$width}" data-height="{$height}" data-hide-cover="{$hideCover}" data-show-facepile="{$showFacepile}" data-show-posts="{$showPosts}" data-hide-cta="{$hideCta}" data-small-header="{$smallHeader}" data-adapt-container-width="{$adaptContainerWidth}">
      <div class="fb-xfbml-parse-ignore">
         <blockquote cite="https://www.facebook.com/{$pageId}/">
            <a href="https://www.facebook.com/{$pageId}/">{$sitename}</a>
         </blockquote>
      </div>
   </div>