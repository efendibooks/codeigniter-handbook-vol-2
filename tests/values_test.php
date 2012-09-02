<?php

namespace API\Tests;

class Values extends TestCase
{
	/**
	 * GET /trackers/website_visits/values
	 */
	public function test_get_values()
	{
		$request = $this->request('GET', 'trackers/testtest123/values');
		$this->assertEquals(404, $request['info']['http_code']);

		$request = $this->request('GET', 'trackers/website_visits/values');

		$this->assertEquals(200, $request['info']['http_code']);
		$this->assertInternalType('array', $request['body']->result);
		$this->assertTrue(in_array('127.0.0.1', $request['body']->result));
	}

	/**
	 * POST /trackers/website_visits/values
	 */
	public function test_post_values()
	{
		$new_value = array( 'value' => '0.0.0.0' );

		$request = $this->request('POST', 'trackers/testtest123/values', $new_value);
		$this->assertEquals(404, $request['info']['http_code']);

		$request = $this->request('POST', 'trackers/website_visits/values', $new_value);

		$this->assertEquals(201, $request['info']['http_code']);
		$this->assertEquals('0.0.0.0', $request['body']->result);
	}
}