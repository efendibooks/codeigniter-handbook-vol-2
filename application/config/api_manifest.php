<?php

namespace API\Manifest;

$manifest = array();

/**
 * GET /trackers/(.*)
 */
$manifest['trackers/(.*)'] = new Endpoint();
$manifest['trackers/(.*)']->GET = new HTTP_Verb();
$manifest['trackers/(.*)']->GET->description = "Retrieve a specific tracker";
$manifest['trackers/(.*)']->GET->parameters = array( new Parameter('string', 'The tracker identifier') );
$manifest['trackers/(.*)']->GET->example = (object)array( 'id' => "website_visitors", 'name' => "Website Visitors" );

$manifest['trackers'] = new Endpoint();

/**
 * GET /trackers
 */
$manifest['trackers']->GET = new HTTP_Verb();
$manifest['trackers']->GET->description = "Retrieve all trackers";
$manifest['trackers']->GET->example = array(
	(object)array( 'id' => "website_visitors", 'name' => "Website Visitors" ),
	(object)array( 'id' => "ebook_downloads", 'name' => "eBook Downloads" ),
);

/**
 * POST /trackers
 */
$manifest['trackers']->POST = new HTTP_Verb();
$manifest['trackers']->POST->description = "Create a new tracker";
$manifest['trackers']->POST->parameters = array(
	'id' => new Parameter('string', 'An alphanumeric + underscored identifier'),
	'name' => new Parameter('string', 'A display name')
);
$manifest['trackers']->POST->example = array(
	'id' => "some_tracker_id",
	'name' => "A Special Tracker"
);

/*$manifest['trackers'] array(
	'GET' => array(
		'description' => "Retrieve all trackers",
		'example' => 
	),
	'POST' => array(
		'description' => "Create a new tracker",
		'parameters' => array(
			'id' => array(
				'type' => "string",
				'description' => "An alphanumeric + underscored identifier"
			),
			'name' => array(
				'type' => "string",
				'description' => "A display name"
			),
		),
		'example' => array(
			'id' => "some_tracker_id",
			'name' => "A Special Tracker"
		)
	),
);*/

return $manifest;