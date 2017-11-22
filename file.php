 <?php
    if (isset($_POST['shorten'])) {
    	$longurl = $_POST['longurl'];
    	$login 	= "username"; //pagodapastiles
    	$appkey = "api-key"; //R_572e9e80040c47e68ea318418b949f30
    	$shorturl = make_bitly_url ($longurl, $login, $appkey, 'json');
    	echo "<p><strong>Your long URL is</strong> <span class='url'>$longurl </span></p>";
    	echo "<p><strong>Your short URL is</strong> <span class='url'>$shorturl </span></p>";
    	echo "<p><strong>Try your shorten URL:</strong> <a href='$shorturl' target='_blank'>$shorturl</a></p>";
    }
    ?>
    </div>
    </body>
    </html>
     
    <?php
     
    /* make a URL small with bit.ly */
    function make_bitly_url($url, $login, $appkey, $format = 'xml',$version = '2.0.1')
    {
    	//create the URL
    	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url). '&login='.$login.'&apiKey='.$appkey.'&format='.$format;
     
    	//get the url
    	//could also use cURL here
    	$response = file_get_contents($bitly);
     
    	//parse depending on desired format
    	if(strtolower($format) == 'json') {
    		$json = @json_decode($response,true);
    		return $json['results'][$url]['shortUrl'];
    	} else { //xml
    		$xml = simplexml_load_string($response);
    		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
    	}
    }
    ?>
