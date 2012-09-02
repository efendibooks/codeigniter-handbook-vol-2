<?php

namespace API\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
	/**
	 * The API URL, the access token and shared secret
	 */
	protected $base_url = 'http://localhost/efendibooks/codeigniter-handbook-vol-2-code/index.php/';
	protected $access_token = '4395dd07a3cfe84d9655bb2542907f3acd0024fe';
	protected $shared_secret = '3c697e1314808f56bd44bc5ccb4765607b433715';

	/**
	 * Make a cURL request, with params, to the API
	 */
	protected function request($method, $path, $params = array())
	{
		$curl = curl_init($this->base_url . $path);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$headers = array();
		$headers[] = 'User-Agent: CodeIgniter Handbook Vol. 2 API Unit Tests';
		$headers[] = 'Accept: application/json; version=v1';
		$headers[] = 'X-Access-Token: ' . $this->access_token;

		$timestamp = time();

		$hash = $path . http_build_query($params);
		$hash .= $timestamp . $this->shared_secret;
		
		$signature = sha1($hash);

		$headers[] = 'X-Request-Timestamp: ' . $timestamp;
		$headers[] = 'X-Request-Signature: ' . $signature;

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
		
		return array(
			'info' => $info,
			'body' => json_decode($result)
		);
	}
}