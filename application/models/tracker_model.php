<?php

class Tracker_model extends MY_Model
{
	public function get($id)
	{
		$row = parent::get($id);
		
		if (empty($row))
		{
			throw new API\Exceptions\Resource_Not_Found('tracker');
		}

		return $row;
	}
}