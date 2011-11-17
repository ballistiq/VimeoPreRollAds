<!DOCTYPE HTML>
<html>
	<head>
		<title>Vimeo Pre-Roll Ads</title>

		<script src="js/jquery-1.6.4.min.js"></script>
		<script src="js/jwplayer/jwplayer.js"></script>
		<script src="js/vimeoprerollad.js"></script>

	</head>
	<body>

		<h1>Vimeo Pre-Roll Ads</h1>

		<p>Example of video pre-roll using JWPlayer and Vimeo.	</p>
		<p>Changelog: </p>
		<p>17 November 2011 - Made video pre-roll clickable to your own URL</p>
<div id="mediaplayer"></div>
        <h2>Instructions</h2>
        <p>This relies on two main files:</p>
        <ul>
          <li>vimeoprerollad.js - Javascript file. Put wherever js files go.</li>
          <li>vimeo_info.php - PHP file for getting embed tag automatically from Vimeo. Put wherever your PHP files go.</li>
        </ul>
<p>Include the vimeoprerollad.js script:</p>
<pre>		&lt;script src=&quot;js/vimeoprerollad.js&quot;&gt;&lt;/script&gt;</pre>
        <p>Create a div tag with unique ID:</p>
    <pre>		&lt;div id=&quot;mediaplayer&quot;&gt;&lt;/div&gt;</pre>
        <p>Call jQuery to initialize the pre-roll ad and vimeo url:</p>
        <pre>		&lt;script&gt;<br>			jQuery(document).ready(function(){<br>				settings = {<br>					container: &quot;mediaplayer&quot;,<br>					vimeo_url: &quot;http://vimeo.com/29274467&quot;,<br>					ad_url: &quot;videos/video.mp4&quot;,<br>					width: 900,<br>					height: 600,<br>					autoplay: &quot;true&quot;,
					vimeo_info_path: &quot;vimeo_info.php&quot;,
					link_url: &quot;http://www.ballistiq.com&quot;<br>				};<br>			<br>				init_preroll_ad(settings);<br>				<br>			});<br>			<br>		&lt;/script&gt;
					</pre>

		<p>
		You can use PHP to dynamically output the settings in your Wordpress theme.	</p>
		<p>Enjoy,</p>
		<p>Leo        </p>
		<script>
			jQuery(document).ready(function(){
				settings = {
					container: "mediaplayer",
					vimeo_url: "http://vimeo.com/29274467",
					ad_url: "videos/video.mp4",
					width: 900,
					height: 600,
					autoplay: "true",
					vimeo_info_path: "vimeo_info.php",
					link_url: "http://www.ballistiq.com"
				};
			
				init_preroll_ad(settings);
				
			});
			
		</script>
	</body>
</html>