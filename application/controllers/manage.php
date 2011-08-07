<?php 

class Manage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	function view($userAch_ID)
	{
		$this->data['achievement'] = Userach_model::byAchievement($userAch_ID); // finds all user specific achievements			
		$this->data['user'] = User_model::byID($this->data['achievement']->getUserID()); // find more information on the specific user
		
		$this->template->set_template('fancybox');
		$this->template->write('title', $this->data['achievement']->getName().' achievement for '.$this->data['user']->getName());
		$this->template->write_view('content', 'manage/view',$this->data);		
		$this->template->render();	
	}
	
}