<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Achievement extends CI_Controller {
    function __construct()
    {
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains the user ID information
        $this->privileges = $this->session->userdata('privileges'); // This array contains the user ID information
    }
    function index()
    {
      	redirect('/achievement/display');
      	
      	$data = array(
			'fb_data' => $this->fb_data,
			'user' => $user,
		);
        
        $this->template->write('title', "Life Achievements");
		$this->template->write_view('content', 'achievement/main/index',$data);	
		$this->template->render();
    }
  	function create()
    {
    	if ($this->privileges < 5) // ensure security and only let moderators and admin view
    		redirect('/achievement/index');
    		
    	$achievement = new Achievement_model();
    	
    	if ($this->form_validation->run('achievement') == TRUE) // form has been submitted and passes all error checking
		{
            $achievement->insert($this->input->post());
            $this->session->set_flashdata('success', 'Insert succesful');
            redirect('/achievement/display');		    
		}
		
     	$data = array(
			'achievement' => $achievement,
			'categoryArray' => Achievement_model::getCategories(),
			'submissionType' => 'Insert',
		);
		
        $this->template->write('title', "Add a Life Achievements");
		$this->template->write_view('content', 'achievement/main/modify',$data);	
		$this->template->render(); 
    }
    function display()
    {
    	$data = array(
			'achievementArray' => Achievement_model::getAllAchievements(),
		);
		$achievementArray = Achievement_model::getAllAchievements();
				
        $this->template->write('title', "List of Life Achievements");
		$this->template->write_view('content', 'achievement/main/display',$data);	
		$this->template->render(); 
    }
  	function update($achievement_id)
    {	
    	if ($this->privileges < 5) // ensure security and only let moderators and admin view
    		redirect('/achievement/index');
    	$achievement = Achievement_model::byID($achievement_id);
      							
		if ($achievement_id != NULL)
			$achievement = Achievement_model::byID($achievement_id);			
		if (!is_object($achievement))
                  redirect('/achievement/display'); // redirect to all achievements.

		
		if ($this->form_validation->run('achievement') == TRUE) // form has been submitted and passes all error checking
		{
            $achievement->update($this->input->post());
            $this->session->set_flashdata('success', 'Update succesful');
            redirect('/achievement/display');		    
		}

     	$data = array(
			'achievement' => $achievement,
			'categoryArray' => Achievement_model::getCategories(),
			'submissionType' => 'Update',
		);

      	$this->template->write('title', "Update ".$achievement->getName());
		$this->template->write_view('content', 'achievement/main/modify',$data);	
		$this->template->render(); 
    }
    function category_check($category_id) // used to verify a valid category has been selected
    {
    	$category = Achievement_model::getCategoryByID($category_id);
    	
    	if ($category == false) // if the category isn't found
    	{
    		$this->form_validation->set_message('category_check', 'The specific category you provided can not be found');
			return FALSE;
    	}
    	else
    		return true;
    }
}
?>  