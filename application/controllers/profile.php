<?php
class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains all the user FB information
        $this->data['fb_data'] = $this->fb_data;
        $this->load->model('Userach_model');
	}
	function index()
	{
		$achievementArray = $this->Userach_model->getAchivements(41);
		
		die(print_r($achievementArray));
		
		$this->template->write('title', "Display a users profile");
		$this->template->write_view('content', 'profile/center/user_info',$this->data);	
		$this->template->render();
	}
}
?>