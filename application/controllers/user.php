<?php

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains all the user FB information
        $this->data['fb_data'] = $this->fb_data;
	}
	function profile($user_id)
	{	        		
		$this->data['user'] = User_model::byID($user_id);			
		
		// Builds all of the information to be used else where
		$this->data['achievementArray'] = Userach_model::byUserID($user_id); // finds all user specific achievements	
		$this->data['friendsArray'] = $this->data['user']->getFriendsInDatabase(); // get friends
					
		$this->template->write('title', "{$this->data['user']->getName()}'s Achievements");
		
		// userInfo widget
		$commentsArray = array(
								'widgetTitle' => $this->data['user']->getName(), 
								'view' => 'user/userInfo','content'=>$this->data,'classHolder'=>'userInfoHeader'
							  );
		$this->template->write_view('holder', 'default/widget',$commentsArray);	
		// achievement widget
		$achievementArray = array(
									'widgetTitle' => 'Recent Achievements', 'view' => 'user/achievements',
									'content'=>$this->data,'classHolder'=>'achievements'
								);
		$this->template->write_view('holder', 'default/widget',$achievementArray);			
		// comments widget
		$commentsArray = array('widgetTitle' => 'Comments', 'view' => 'user/comments','content'=>'','classHolder'=>'comments');
		$this->template->write_view('holder', 'default/widget',$commentsArray);	
		// friends widget
		$friendsArray = array('widgetTitle' => 'Friends', 'view' => 'user/friends','content'=>$this->data,'classHolder'=>'friends');
		$this->template->write_view('holder', 'default/widget',$friendsArray);	
		
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