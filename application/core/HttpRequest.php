<?php

function http_request($method, $link, $data = null, $token = null)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $link,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => $method,
		CURLOPT_POSTFIELDS => $data,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			!empty($token) ? $token : null
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return json_decode($response, true);
}
