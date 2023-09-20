{* googleMap_template.tpl - v1.0 - 22Aug20

   - v1.0 - 26May20 - 1st version as a simple maps solution (can replace CGGoogleMaps in most cases)

   See: https://developers.google.com/maps/documentation/embed/guide

   Place IDs are stable way to uniquely identify a place:
      https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder

***************************************************************************************************}
   <iframe width="100%" height="{$height}" frameborder="0" style="display:block; border:0;" src="https://www.google.com/maps/embed/v1/{$mode}?key={$apikey}&{$parameters}" allowfullscreen></iframe>