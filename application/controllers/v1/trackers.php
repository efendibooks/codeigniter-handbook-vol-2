<?php

class Trackers extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('tracker_model', 'tracker');
	}

	public function index()
	{
		$this->data = $this->tracker->get_all();
	}

	public function show($id)
	{
		$this->data = $this->tracker->get($id);	
	}

	public function create()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');

		$tracker = array(
			'id' 	=> $id,
			'name'	=> $name
		);

		$this->tracker->insert($tracker);

		$this->status_code = 201;
		$this->data = $tracker;
	}

	public function update($id)
	{
		if (!($tracker = $this->tracker->get($id)))
		{
			$this->status_code = 404;
			$this->respond();
		}
		else
		{
			$name = $this->input->post('name');

			$this->tracker->update($id, array( 'name' => $name ));

			$tracker->name = $name;
			$this->data = $tracker;
		}
	}
}