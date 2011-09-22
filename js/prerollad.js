/**
 * Pre Roll Ad Script
 * @author Leonard Teo, Ballistiq Digital
 * 
 * 	Copyright (C) 2011 by Ballistiq Digital

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
 */

//Configuration
var ad_url;
var vimeo_url;
var video_width;
var video_height;
var video_container;
var autoplay;
			
var debug = false; //Output to console


/**
 * Entry point
 */
function init_preroll_ad(config){
	video_container = config.container;
	vimeo_url = config.vimeo_url;
	ad_url = config.ad_url;
	video_width = config.width ? config.width : 640;
	video_height = config.height ? config.height : 360;
	autoplay = config.autoplay ? config.autoplay : true;
	
	//Away we go!
	init_jwplayer();
}
			
			
/**
 * Initialize JWPlayer
 */
function init_jwplayer()
{
	
	//Setup the JWPlayer
	jwplayer(video_container).setup({
		flashplayer: "js/jwplayer/player.swf",
		file: ad_url,
		controlbar: "none",
		autostart: autoplay,
		width: video_width,
		height: video_height
	});
				
	//Setup the event to fire on the completion of the pre-roll ad
	jwplayer(video_container).onComplete(switch_to_vimeo);
}
			
/**
 * Switch to Vimeo
 */
function switch_to_vimeo(event)
{
	//unload the jwplayer
	jwplayer(video_container).remove();
				
	//Load in vimeo player
	embed_code = get_vimeo_embed(vimeo_url);
				
	jQuery("#mediaplayer").html(embed_code);
}
			
/**
 * Get Vimeo embed code
 */
function get_vimeo_embed(url)
{
	data = {};
	data.url = url;
	data.width = video_width;
	data.height = video_height;
	api_endpoint = "vimeo.php";
	
	if (debug) console.log("Data sent to server:");
	if (debug) console.debug(data);
	
	var returndata;
				
	jQuery.ajax({
		type: "GET",
		url: api_endpoint,
		dataType: "json",
		data: data,
		async: false,
		success: function(response){

			if (debug){
				console.log("Vimeo response:");
				console.debug(response);
			}

			//Deal with response
			if (response.status == "success"){
				returndata = response;
			} else {
				alert("Error: " + response.message);
			}
						
			
		},
		error: function(request, status, error){
			
			alert("Error: " + error);
			
		}
	});
				
	return returndata.data.embed_code;
				
}
			