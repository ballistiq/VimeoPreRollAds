<?php
/**
 * Vimeo Embed Code Grabber
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

//Gets vimeo embed and returns it
main();

//Main entry point
function main()
{
	if (!isset($_GET['url']) || $_GET['url'] == "")
	{
		fail("No URL provided");
	}
	
	$width = isset($_GET['width']) ? $_GET['width'] : 640;
	$height = isset($_GET['height']) ? $_GET['height'] : 360;	

	$data = get_vimeo_share_data(urldecode($_GET['url']), $width, $height);
	if ($data)
	{
		$output = json_encode(array(
			'status' => 'success',
			'data' => $data
				));
		echo $output;
		exit(0);
	}

	//Always fallback to fail
	fail("There was an error getting Vimeo data");
}

/**
 * Fail
 * @param type $message 
 */
function fail($message)
{
	$output = json_encode(array(
		'status' => 'fail',
		'message' => $message
			));
	echo $output;
	exit(0);
}

/**
 * Vimeo share data
 * @param string $url 
 * @param int $max_width
 * @param int $max_height
 */
function get_vimeo_share_data($url, $max_width = 640, $max_height = 360)
{
	
	$components = parse_url($url);

	$video_id = substr($components['path'], 1);

	//Check that the video ID is really an ID
	if (!is_numeric($video_id))
	{
		return false;
	}

	$api_endpoint = "http://vimeo.com/api/oembed.json?url=" . urlencode($url) . "&width={$max_width}&height={$max_height}&autoplay=1";

	$json = curl_get($api_endpoint);

	$obj = json_decode($json);
	
	//Cull the description
	$description = $obj->description;
	if ($description != NULL && strlen($description) > 255)
	{
		$description = substr($description, 0, 255) . "...";
	}

	return array(
		'title' => trim($obj->title),
		'description' => trim($description),
		'thumbnail' => trim($obj->thumbnail_url),
		'is_video' => true,
		'embed_code' => trim($obj->html)
	);
}

// Curl helper function
function curl_get($url)
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	$return = curl_exec($curl);
	curl_close($curl);
	return $return;
}