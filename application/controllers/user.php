<?php
// Authenticates the user using the facebook login module.

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains all the user FB information
	}

	function process()
	{
		$data = array(
			'fb_data' => $this->fb_data,
		);
				
		if ($this->fb_data['me']) { // if the user logged in via facebook
			$user = User_model::byFBID($this->fb_data['me']['id']);

			if ($user) { // user has already signed up on my site. Process them
				$user->login($user); // Log the user in.
				redirect('/user/profile/'.$user->getID()); // redirect to their profile.
			}
			else
				User_model::register_facebook($this->fb_data); // register the user with facebook information	
		}
		$this->template->write('title', "Facebook Authentication");
		$this->template->write_view('content', 'user/main/process',$data);	
		$this->template->render();
	}
	function profile()
	{
		$user_id = (int)$this->uri->segment(3);
		        							
		if ($this->uri->segment(3) != NULL)
			$user = User_model::byID($user_id);			
		if (!is_object($user))
			redirect('/user/process'); // redirect to their profile.

      	if (($this->fb_data['me']) && ($user_id == $this->user_id)) // Only ask for friends if the user is logged in.
              $friendsArray = $user->getRegisteredFriends(true);
      	else
              $friendsArray = $user->getRegisteredFriends();
				
		$data = array(
            'friendsArray' => $friendsArray,
			'fb_data' => $this->fb_data,
			'user' => $user,
		);
				
		$this->template->write('title', "{$user->getName()}'s Achievements");
		$this->template->write_view('content', 'user/main/profile',$data);	
		$this->template->write_view('sideBar', 'user/sidebar/friends',$data);		
		$this->template->render();
	}
 	function displayUsers() 
 	{       
        $data = array(
          	'userArray' => User_model::getUsers(),
			'fb_data' => $this->fb_data,
		);
		$this->template->write('title', 'Active Users');
		$this->template->write_view('content', 'user/main/user_list',$data);		
		$this->template->render();
    }

}
?>