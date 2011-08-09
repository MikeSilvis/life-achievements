<?php 

class Manage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->set_template('fancybox');
	}
	function view($userAch_ID)
	{
		$this->data['achievement'] = Userach_model::byAchievement($userAch_ID); // finds all user specific achievements			
		$this->data['user'] = User_model::byID($this->data['achievement']->getUserID()); // find more information on the specific user
		
		$this->template->write('title', $this->data['user']->getName()."'s ".$this->data['achievement']->getName()." experience");
		$this->template->write_view('content', 'manage/view',$this->data);		
		$this->template->render();	
	}
	function add()
	{
		$this->data['achievementArray'] = Achievement_model::getListofAchievements();
		
    	$achievement = new Userach_model();
    	
    	if ($this->form_validation->run('manage') == TRUE) // form has been submitted and passes all error checking
		{
            $achievement->insert($this->input->post());
            $this->session->set_flashdata('success', 'Insert Successful');
            redirect('/user/profile/'.$this->session->userdata('user_id'));		    
		}
		
		$this->template->write('title', 'Add Achievement');
		$this->template->write_view('content', 'manage/add',$this->data);		
		$this->template->render();	
	}
	
}