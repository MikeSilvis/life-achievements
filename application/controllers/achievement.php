<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Achievement extends CI_Controller {
    function __construct()
    {
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains the user ID information
        $this->privileges = $this->session->userdata('privileges'); // This array contains the user ID information
        
        if ($this->privileges < 5) // ensure security and only let moderators and admin view
    		redirect('/achievement/index');
    }
    function index()
    {
      	redirect('/achievement/display');
    }
  	function create()
    {    		
    	$achievement = new Achievement_model();
    	
    	if ($this->form_validation->run('achievement') == TRUE) // form has been submitted and passes all error checking
		{				
            $achievement->insert($this->input->post());
            $this->session->set_flashdata('success', 'Insert succesful');
            
           	$achievement->setID($this->db->insert_id());
			$achievement->uploadAvatar();
				
            redirect('/achievement/display');		    
		}
		
     	$data = array(
			'achievement' => $achievement,
			'categoryArray' => Achievement_model::getCategories(),
			'submissionType' => 'Insert',
		);
		
        $this->template->write('title', "Add a Life Achievements");
		
		// create form widget
		$commentsArray = array(
								'widgetTitle' => 'Add a Life Achievement', 
								'view' => 'achievement/modify','content'=>$data,'classHolder'=>''
							  );
		$this->template->write_view('content', 'default/widget',$commentsArray);	

		$this->template->render(); 
    }
    function display()
    {
		$this->data['achievementArray'] = Achievement_model::getAllAchievements();
				
        $this->template->write('title', "List of Life Achievements");
        
        // achievement widget
		$achievementArray = array(
									'widgetTitle' => 'List of Life Achievements', 'view' => 'achievement/display',
									'content'=>$this->data,'classHolder'=>''
								);
		$this->template->write_view('content', 'default/widget',$achievementArray);		
		$this->template->render(); 
    }
  	function update($achievement_id)
    {	
    	$achievement = Achievement_model::byID($achievement_id);
    			
		if ($this->form_validation->run('achievement') == TRUE) // form has been submitted and passes all error checking
		{
			$achievement->uploadAvatar();	
			
            $achievement->update($this->input->post());
            $this->session->set_flashdata('success', 'Update Successful');
            redirect('/achievement/display');		    
		}

     	$data = array(
			'achievement' => $achievement,
			'categoryArray' => Achievement_model::getCategories(),
			'submissionType' => 'Update',
		);

      	$this->template->write('title', "Update ".$achievement->getName());
      	
      			// create form widget
		$updateArray = array(
								'widgetTitle' => 'Add a Life Achievement', 
								'view' => 'achievement/modify','content'=>$data,'classHolder'=>''
							  );
		$this->template->write_view('content', 'default/widget',$updateArray);	
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