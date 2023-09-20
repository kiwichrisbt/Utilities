{* twitterFeed_template.tpl - v1.0 - 09Jun16

   - v1.0 - 09Jun16 - initial version

   See https://dev.twitter.com/web/embedded-timelines for details.

***************************************************************************************************}
{if $twitterScreenName!=''}
{if $twitterHeight}
   <div class="twitter-timeline-outer" style="height:{$twitterHeight}px;{if $twitterBorderColor} border:1px solid {$twitterBorderColor};{/if}">
{/if}
      <a class="twitter-timeline" href="//twitter.com/{$twitterScreenName}"{strip}
         {if $twitterWidth} data-width="{$twitterWidth}" {/if}
         {if $twitterHeight} data-height="{$twitterHeight}" style="height:{$twitterHeight}px"{/if}
         {if $twitterTheme} data-theme="{$twitterTheme}" {/if}
         {if $twitterChromeOptions} data-chrome="{$twitterChromeOptions}" {/if}
         data-dnt="true"
      {/strip}>Tweets by {$twitterScreenName}</a>
      {literal}<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>{/literal}
{if $twitterHeight}   </div>{/if}
{/if}