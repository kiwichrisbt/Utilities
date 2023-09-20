{* instagramFeed_template.tpl - v1.0 - 01Jun21 
    
    smarty variables available:
        $data - array of all media items returned from Instagram
        $mod - this modules object, e.g. for accessing lang array

    Recommend to use either SmartImage or CGSmartImage to locally cache images
        
***************************************************************************************************}
{if !empty($errors)}
    <div class="alert alert-warning" role="alert">{'<br>'|implode:$errors}</div>
{/if}

{if !empty($data)}
    <div class="instagram-images card-deck justify-content-center align-items-center">
    {foreach $data as $image}
        {if $image@index<10}
        {$imageAlt=$image->titlename|escape}
        <a class="card card-5 mb-grid" href="{$image.permalink}" target="_blank">
            {if $image.media_type==VIDEO}
                {$imgsrc=$image.thumbnail_url}
            {else}
                {$imgsrc=$image.media_url}
            {/if}
            {CGSmartImage src=$imgsrc alt="$image.username Instagram $image.timestamp|date_format" class='card-img' filter_croptofit='320,320,c,1' noembed=1}
        </a>
        {/if}
    {/foreach}
    </div>
{/if}