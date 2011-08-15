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
		
		$name = explode(" ", $this->data['user']->getName());
		
		$this->template->write('title', $name[0]."'s ".$this->data['achievement']->getUserName()." Experience");
		$this->template->write_view('content', 'manage/view',$this->data);		
		$this->template->render();	
	}
	function add()
	{				
    	$achievement = new Userach_model();
    	
    	$categories = Achievement_model::getCategories();
    	$categories[0] = "";
    	ksort($categories);
    	$this->data['categories'] = $categories;
    	
    	if ($this->form_validation->run('manage') == TRUE) // form has been submitted and passes all error checking
		{
            $achievement->insert($this->input->post());
            $achievement->setUserAchID($this->db->insert_id());
			$achievement->uploadUserAvatar();	            
            $this->session->set_flashdata('success', 'Insert Successful');
            redirect('/user/profile/'.$this->session->userdata('user_id'));		    
		}
		
		$this->template->write('title', 'Add Achievement');
		$this->template->write_view('content', 'manage/add',$this->data);		
		$this->template->render();	
	}
	function update($userAch_ID)
	{
		$this->data['achievement'] = Userach_model::byAchievement($userAch_ID); // finds all user specific achievements			
		$this->data['user'] = User_model::byID($this->data['achievement']->getUserID()); // find more information on the specific user
		
		$achievement = $this->data['achievement'];
		
   		if ($this->form_validation->run('manage') == TRUE) // form has been submitted and passes all error checking
		{
            $achievement->update($this->input->post());
			$achievement->uploadUserAvatar();	            
            $this->session->set_flashdata('success', 'Achievemnet Updated Succesfully');
            redirect('/user/profile/'.$this->session->userdata('user_id'));		    
		}	
		
		$this->template->write('title', "Update {$achievement->getUserName()} Achievement");
		$this->template->write_view('content', 'manage/update',$this->data);		
		$this->template->render();			
	}
	
}