<?php

namespace API\Tests;

class Trackers extends TestCase
{
	/**
	 * GET /trackers
	 */
	public function test_get_trackers()
	{
		$tracker = (object)array( 'id' => 'website_visits', 'name' => 'Website Visits' );
		$request = $this->request('GET', 'trackers');

		$this->assertEquals(200, $request['info']['http_code']);
		$this->assertInternalType('array', $request['body']->result);
		$this->assertTrue(in_array($tracker, $request['body']->result));
	}

	/**
	 * GET /trackers/website_visits
	 */
	public function test_get_tracker()
	{
		$request = $this->request('GET', 'trackers/website_visits');

		$this->assertEquals(200, $request['info']['http_code']);
		$this->assertEquals('website_visits', $request['body']->result->id);
		$this->assertEquals('Website Visits', $request['body']->result->name);

		$request = $this->request('GET', 'trackers/testtesttest123');
		$this->assertEquals(404, $request['info']['http_code']);
	}

	/**
	 * POST /trackers
	 */
	public function test_post_trackers()
	{
		$request = $this->request('POST', 'trackers', array(
			'id' => 'new_tracker',
			'name' => 'New Tracker'
		));

		$this->assertEquals(201, $request['info']['http_code']);
		$this->assertEquals('new_tracker', $request['body']->result->id);
		$this->assertEquals('New Tracker', $request['body']->result->name);
	}

	/**
	 * PUT /trackers/new_tracker
	 */
	public function test_put_trackers()
	{
		$request = $this->request('PUT', 'trackers/new_tracker', array(
			'name' => 'Another New Tracker'
		));

		$this->assertEquals(200, $request['info']['http_code']);
		$this->assertEquals('new_tracker', $request['body']->result->id);
		$this->assertEquals('Another New Tracker', $request['body']->result->name);
	}

	/**
	 * DELETE /trackers/new_tracker
	 */
	public function test_delete_trackers()
	{
		$request = $this->request('DELETE', 'trackers/new_tracker');

		$this->assertEquals(204, $request['info']['http_code']);
		$this->assertTrue(is_null($request['body']));
	}
}