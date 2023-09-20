{* admin_options.tpl *}


<fieldset>
    <legend>{$mod->Lang('instagram_feed_options')}</legend>
    {form_start action=defaultadmin}
        <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('instagram_access_token')}:</p>
            <p class="pageinput">
            {if !empty($instagram_token)}
                {$mod->Lang('valid_token')}: {($instagram_token_timestamp+$token_refresh_period)|cms_date_format}
            {else}
                {$mod->Lang('no_token')}
            {/if}
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('new_instagram_token')}:</p>
            <p class="pageinput">
                <input type="text" name="{$actionid}instagram_token" value="" size="100"/>
                <button type="submit" class="" name="{$actionid}submit" value="update_token">{$mod->Lang('update_token')}</button><br>
                <i>{$mod->Lang('new_token_field_note')}</i>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext">{$mod->Lang('instagram_media_cache')}:</p>
            <p class="pageinput">
            {if !empty($instagram_media_timestamp)}
                {$mod->Lang('media_cache_refresh')}: {($instagram_media_timestamp+$media_refresh_period)|cms_date_format}
            {else}
                not cached, refreshes at next request
            {/if}
                <button type="submit" class="important" style="font-style:italic;" name="{$actionid}submit" value="clear_media_cache">{$mod->Lang('clear_cache')}</button><br>
            </p>
        </div>
    {form_end}

</fieldset>

<p>&nbsp;</p>