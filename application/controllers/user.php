<?php
// Authenticates the user using the facebook login module.

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
	}

	function process()
	{
		$data = array(
			'fb_data' => $this->fb_data,
			'title' => 'Facebook Authentication',
		);
				
		if ($this->fb_data['me']) { // if the user logged in via facebook
			$user = User_model::byFBID($this->fb_data['me']['id']);

			if ($user) { // user has already signed up on my site. Process them
				User_model::login($user); // Log the user in.
				redirect('/user/profile/'.$user->getID()); // redirect to their profile.
			}
			else
				User_model::register_facebook($this->fb_data); // register the user with facebook information	
		}
		$partials = array('content'=>'user/main/process');

		$this->template->load('default/template', $partials, $data);
	}
	function profile()
	{
		$user_id = (int)$this->uri->segment(3);
		
      	if ($this->fb_data['me']) // Only ask for friends if the user is logged in.
              $friendsArray = User_model::getRegisteredFriends();
      	else
              $friendsArray = NULL;
							
		if ($this->uri->segment(3) != NULL)
			$user = User_model::byID($user_id);			
		if (!is_object($user))
			redirect('/user/process'); // redirect to their profile.
				
		$data = array(
                  	'friendsArray' => $friendsArray,
			'fb_data' => $this->fb_data,
			'title' => "{$user->getName()}'s Achievements",
			'user' => $user,
		);
		
		$partials = array('content'=>'user/main/profile','sideBar' =>'user/sidebar/friends');

		$this->template->load('default/template', $partials, $data);
	}
 	function displayUsers() 
 	{       
        $data = array(
          	'userArray' => User_model::getUsers(),
			'fb_data' => $this->fb_data,
			'title' => "Life Achievements Active Users",
		);
		$partials = array('content'=>'user/main/user_list','sideBar'=>'default/sideBar');

		$this->template->load('default/template', $partials, $data);          
    }

}
?>