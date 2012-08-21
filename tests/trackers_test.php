<?php

class Trackers_test extends PHPUnit_Framework_TestCase
{
	protected $base_url = 'http://localhost/efendibooks/codeigniter-handbook-vol-2-code/index.php/';
	protected $access_token = '';
	protected $shared_secret = '';

	/**
	 * GET /trackers
	 */
	public function test_get_trackers()
	{
		$request = $this->request('GET', 'trackers');

		$this->assertEquals(200, $request['info']['http_code']);
		$this->assertType('array', $request['body']->result);
		$this->assertContains((object)array( 'id' => 'website_visits', 'name' => 'Website Visits' ), $request['body']->result);
	}

	protected function request($method, $path, $params = array())
	{
		$curl = curl_init($this->base_url . $path);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$headers = array();
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