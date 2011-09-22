<!DOCTYPE HTML>
<html>
	<head>
		<title>Vimeo Ad Pre-Roll</title>

		<script src="js/jquery-1.6.4.min.js"></script>
		<script src="js/jwplayer/jwplayer.js"></script>
		<script src="js/prerollad.js"></script>

	</head>
	<body>

		<h1>Vimeo Ad Pre-Roll</h1>

		<p>Example of video pre-roll using JWPlayer and Vimeo.	</p>
		<div id="mediaplayer"></div>
        <h2>Instructions</h2>
        <p>Create a div tag with unique ID:</p>
        <pre>		&lt;div id=&quot;mediaplayer&quot;&gt;&lt;/div&gt;</pre>
        <p>Call jQuery to initialize the pre-roll ad and vimeo url:</p>
        <pre>		&lt;script&gt;<br>			jQuery(document).ready(function(){<br>				settings = {<br>					container: &quot;mediaplayer&quot;,<br>					vimeo_url: &quot;http://vimeo.com/29274467&quot;,<br>					ad_url: &quot;videos/video.mp4&quot;,<br>					width: 900,<br>					height: 600,<br>					autoplay: &quot;true&quot;<br>				};<br>			<br>				init_preroll_ad(settings);<br>				<br>			});<br>			<br>		&lt;/script&gt;</pre>

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
					autoplay: "true"
				};
			
				init_preroll_ad(settings);
				
			});
			
		</script>
	</body>
</html>