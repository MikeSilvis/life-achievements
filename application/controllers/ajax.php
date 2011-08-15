<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
		parent::__construct();   
		$this->template->set_template('blank'); 	
    }
    function achievement($category)
    {
    	if ($category == NULL)
    		redirect('user/profile/35'); // should be index but I don't have currently have one...
    		
    	$this->data['achievements'] = Achievement_model::getListofAchievements($category);
        	
		$this->template->write_view('content', 'ajax/achievements',$this->data);	
		$this->template->render(); 
    }
}