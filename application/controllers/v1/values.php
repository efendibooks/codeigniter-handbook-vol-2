<?php

class Values extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('tracker_model', 'tracker');
		$this->load->model('value_model', 'value');
	}

	public function index($id)
	{
		if (!($tracker = $this->tracker->get($id)))
		{
			$this->status_code = 404;
			$this->respond();
		}
		else
		{
			$values = $this->value->get_many_by('tracker_id', $id);
			$this->data = array_map(function($value){
				return $value->value;
			}, $values);
		}
	}

	public function create($id)
	{
		if (!($tracker = $this->tracker->get($id)))
		{
			$this->status_code = 404;
			$this->respond();
		}
		else
		{
			$this->value->insert(array(
				'tracker_id' => $id,
				'value' => $this->params['value']
			));

			$this->status_code = 201;
			$this->data = $this->params['value'];
		}
	}
}