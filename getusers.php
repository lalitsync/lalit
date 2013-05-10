<?php

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    $r .= implode(', ', $values);
    return $r;
}

$url = "https://api.twitter.com/1.1/followers/list.json";

$oauth_access_token = "89913744-wSiUE5Tc6QB0JZI14rPi26Fw37Sgz3yXtJFj3gvE";
$oauth_access_token_secret = "riPO2PJLjW3UjVt90RknrQQtpuIngNqAH58888TTc";
$consumer_key = "0pqK2tT2Ip0rRwtUGdYZ9g";
$consumer_secret = "0AI6Do6wTh8VDFmKxekZxK4v044EoklfaQhwZSonnhk";

$oauth = array( 'oauth_consumer_key' => $consumer_key,
                'oauth_nonce' => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0');




 /* $_GET Parameters to Send */
    $params = array('user_id' => '1131381631');

    /* Update URL to container Query String of Paramaters */
   //  $url .= '?' . http_build_query($params);

$base_info = buildBaseString($url, 'GET', $oauth);
$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;

// Make Requests
$header = array(buildAuthorizationHeader($oauth), 'Expect:');
$options = array( CURLOPT_HTTPHEADER => $header,
                  // CURLOPT_POSTFIELDS => $params,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);

$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);

print($json);

//$twitter_data = json_decode($json);

//print($twitter_data);


//var_dump($twitter_data);

