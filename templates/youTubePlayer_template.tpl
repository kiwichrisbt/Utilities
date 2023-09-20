{* youTubePlayer_template.tpl - v1.0 - 07Feb19

   - v1.0 - 07Feb19 - initial version

   See https://support.google.com/youtube/answer/171780?hl=en-GB for details.

***************************************************************************************************}
{if $thumbnail==''}
{* insert YouTube iframe inline & responsive using bootstrap css *}
      <div class="video-container embed-responsive embed-responsive-{$aspect} {$class}">
         <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{$videoid}?rel=0&modestbranding=1{$start}{$autoplay}"></iframe>
      </div>

{else}
{* insert specified thumbnail and load popup video on click
   note: this option requires smoe custom js and css to function *}
      <a class="video-thumbnail card modal-auto" data-toggle="modal" data-video-src="//www.youtube.com/embed/{$videoid}" data-target="#modal-auto" data-modal-size="{$size}" href="#">
         <img src="{$thumbnail}" alt="{$text}">
         <span class="card-img-overlay d-flex flex-column justify-content-center text-center">
            <i class="icon-youtube icon-5x" style="color:red;"></i>
            <span class="text">{$text}</span>
         </span>
      </a>
{/if}