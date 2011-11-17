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
var vimeoprerollad_config = {};
var debug = false; //Output to console

/**
 * Entry point
 */
function init_preroll_ad(config){
	vimeoprerollad_config.video_container = config.container;
	vimeoprerollad_config.vimeo_url = config.vimeo_url;
	vimeoprerollad_config.ad_url = config.ad_url;
	vimeoprerollad_config.video_width = config.width ? config.width : 640;
	vimeoprerollad_config.video_height = config.height ? config.height : 360;
	vimeoprerollad_config.autoplay = config.autoplay ? config.autoplay : true;
	vimeoprerollad_config.vimeo_info_path = config.vimeo_info_path ? config.vimeo_info_path : "vimeo.php";
	vimeoprerollad_config.link_url = config.link_url ? config.link_url : "";
	
	//Away we go!
	init_jwplayer();
}
			
			
/**
 * Initialize JWPlayer
 */
function init_jwplayer()
{
	//Setup the JWPlayer
	jwplayer(vimeoprerollad_config.video_container).setup({
		flashplayer: "js/jwplayer/player.swf",
		file: vimeoprerollad_config.ad_url,
		controlbar: "none",
		autostart: vimeoprerollad_config.autoplay,
		width: vimeoprerollad_config.video_width,
		height: vimeoprerollad_config.video_height,
		link: vimeoprerollad_config.link_url,
		displayclick: "link"
	});
				
	//Setup the event to fire on the completion of the pre-roll ad
	jwplayer(vimeoprerollad_config.video_container).onComplete(switch_to_vimeo);
}
			
/**
 * Switch to Vimeo
 */
function switch_to_vimeo(event)
{
	//unload the jwplayer
	jwplayer(vimeoprerollad_config.video_container).remove();
				
	//Load in vimeo player
	embed_code = get_vimeo_embed(vimeoprerollad_config.vimeo_url);
				
	jQuery("#mediaplayer").html(embed_code);
}
			
/**
 * Get Vimeo embed code
 */
function get_vimeo_embed(url)
{
	data = {};
	data.url = url;
	data.width = vimeoprerollad_config.video_width;
	data.height = vimeoprerollad_config.video_height;
	api_endpoint = vimeoprerollad_config.vimeo_info_path;
	
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
			