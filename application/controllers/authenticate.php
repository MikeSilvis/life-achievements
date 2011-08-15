<?php

class Authenticate extends CI_Controller {

	function login() // used to log the user in
	{		
		$this->fb_data = $this->session->userdata('fb_data');
		
		//die(print_r($this->fb_data));
		 
		if ($this->fb_data['me']) { // if the user logged in via facebook
			$user = User_model::byFBID($this->fb_data['me']['id']);

			if ($user) { // user has already signed up on my site. Process them
				$user->login($user); // Log the user in.
				redirect('/user/profile/'.$user->getID()); // redirect to their profile.
			}
			else
				User_model::register_facebook($this->fb_data); // register the user with facebook information	
		}
		else
			redirect($this->fb_data['loginUrl'].'&scope=email,user_birthday,user_location');
	}
	
	function logout()
	{
		$this->session->unset_userdata($this);
	    $this->session->sess_destroy();
	    redirect('/user/profile/41');
	}
}