<?php

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public $user_id;
    public $fb_id;
    public $uid;
    public $name;
    public $email;
    public $birthdate;
    public $location;
    public $fb_location_id;
    public $registered;
    public $last_login;
    public $total_points;
    

	/*
	***********************************************************************************
	SECTION: BUILD_USER
	***********************************************************************************
	*/
	public function byID($user_id)
	{
		$user_id = (int)$user_id;
		if ($user_id != NULL){
			$query = $this->db->get_where('users', array('user_id' => $user_id), 1);
			return $this->User_model->getNew($query);
		}
		else
		{
			Errorlog_model::submitError('user','User_model::byID called with no user id',2);
			redirect('/user/displayUsers');
			return false;
		}	
	}
	public function byFBID($fb_id)
	{
		$fb_id = (int)$fb_id;
		if ($fb_id != NULL) {
			$query = $this->db->get_where('users', array('fb_id' => $fb_id), 1);
			return $this->User_model->getNew($query);
		}
		else
		{
			Errorlog_model::submitError('user','User_model::byFBID called with no fbID id',2);
			redirect('/user/displayUsers');
			return false;
		}
	}
	private function getNew($query, $array = false)
	{
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$tempUser = new User_model();
				$tempUser->setID($row->user_id);
				$tempUser->setFBID($row->fb_id);
				$tempUser->setUID($row->uid);
				$tempUser->setName($row->name);
				$tempUser->setEmail($row->email);
				$tempUser->setBirthdate($row->birthdate);
				$tempUser->setLocation($row->location);
				$tempUser->setFBLocationID($row->fb_location_id);
				$tempUser->setRegistered($row->registered);
				$tempUser->setLastLogin($row->last_login);
				$tempUser->setPrivileges($row->privileges);
				$tempUser->setTotalPoints($row->total_points);
				
				// Determines array of users or single user
				if ($array == false)
					$user = $tempUser;
				else
					$user[] = $tempUser;
			}
				return $user;
		}
		else
		{
			Errorlog_model::submitError('user','build failed to return a valid user.',3);
			redirect('/user/displayUsers');
			return false;
		}
	}
	/*
	***********************************************************************************
	SECTION: GET_METHODS
	***********************************************************************************
	*/
	public function getID(){
		return $this->user_id;
	}
	public function getFBID() {
		return $this->fb_id;
	}
	public function getUID() {
		return $this->uid;
	}
	public function getName() {
		return $this->name;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getBirthdate() {
		return $this->birthdate;
	}
	public function getAge() {
		// Convert SQL date to individual Y/M/D variables
		list($Y,$m,$d) = explode("-",$this->birthdate);
		$age = date("Y") - $Y;
		
		// If the birthday has not yet come this year
		if(date("md") < $m.$d )
		$age--;
		
		return $age;
	}
	public function getLocation() {
		return $this->location;
	}
	public function getFbLocationID() {
		return $this->fb_location_id;
	}
	public function getRegistered() {
		return $this->registered;
	}
	public function getLastLogin() {
		return $this->last_login;
	}
	public function getPrivileges(){
		return $this->privileges;
	}
	public function getTotalPoints(){
		return $this->total_points;
	}
	public function getFriendsInDatabase()
	{
		$this->db->select('*');
		$this->db->from('friends')->where('friends.user_id',$this->getID());
		$this->db->join('users', 'friends.friend_id = users.user_id');
		$query =  $this->db->get();
		return $this->getNew($query,true);
	}
	public function getTotalFriends()
	{
		$this->db->select('friends_id');
		$this->db->from('friends')->where('friends.user_id',$this->getID());
		return $this->db->count_all_results();
	}
	public function getRegisteredFriends(){ // used to either update or retrieve current friends
			$friend = NULL; // Must predefine it incase the loop isn't called
		

			$fql = "SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1";
			 
			$response = $this->facebook->api(array(
				'method' => 'fql.query',
				'query' =>$fql,
			));
			foreach ($response as $key => $val)
			  $response[$key] = $response[$key]['uid'];
			  
			// finds Facebook friends that need to be added
			$this->db->where_in('uid', $response);
			$query = $this->db->get('users');
			foreach($query->result() as $row)
			$facebookFriends[] = $row->user_id;
			
			// finds current friends
			$friends_query = $this->db->get_where('friends', array('user_id' => $this->getID()));
			
			if ($friends_query->num_rows() > 0) // if they already have some friends
			{
			foreach($friends_query->result() as $row)  // finds the friend's id
			$currentFriends[] = $row->friend_id;
			
			$results = array_diff($facebookFriends,$currentFriends); // difference between current and future friends
			foreach($results as $user)
			{
			$friend[] = array('user_id' => $this->getID(), 'friend_id' => $user); // User is friends with
			$friend[] = array('user_id' => $user, 'friend_id' => $this->getID()); // friend with user
			}
			if (is_array($friend))
				$this->db->insert_batch('friends', $friend); // insert friends
			 }
			else // they don't and we need to add everyone.
			{
				foreach($facebookFriends as $friendID) {
					$friend[] = array('user_id' => $this->getID(), 'friend_id' => $friendID); // User is friends with
					$friend[] = array('user_id' => $friendID, 'friend_id' => $this->getID()); // friend with user
				}
				if (is_array($friend))
					$this->db->insert_batch('friends', $friend); // insert friends
			}
		
		   	return User_model::getNew($query,true);
		}
		public function getUsers() {
		$query = $this->db->get('users');       
		       return $this->User_model->getNew($query,true);
	}
	/*
	***********************************************************************************
	SECTION: UPDATE_METHODS
	***********************************************************************************
	*/
	public function login() {
	   	$time = date("Y-m-d H:i:s");
		$this->setLastLogin($time);
	    $this->getRegisteredFriends(); // pulls new friends when logging in
	    $this->update();
		$this->session->set_userdata($this); // This array contains all the user FB information
	}
	public function update()
	{
		$this->db->set($this);
		$this->db->where('user_id', $this->getID());
		$this->db->update('users');	    
	}
	public function updatePoints()
	{
		$this->db->select_sum('point');
		$this->db->from('users')->join('achievements_users', 'achievements_users.user_id = users.user_id');
		$this->db->join('achievements','achievements_users.achievement_id = achievements.achievement_id');
		$this->db->where('users.user_id', $this->getID());
		$query = $this->db->get();
		$result = $query->result();

		$this->setTotalPoints($result[0]->point);
		$this->update();
	}
	/*
	***********************************************************************************
	SECTION: SET_METHODS
	***********************************************************************************
	*/
	function setID($user_id) {// 20
		$this->user_id = $user_id;
	}
	function setFbID($fb_id) {// 34234234
		$this->fb_id = $fb_id;
	}
	function setUID($uid) {// 1476420296
		$this->uid = $uid;
	}
	function setName($name) {// Mike Silvis
		$this->name = $name;
	}
	function setEmail($email) {// MikeSilvis@gmail.com
		$this->email = $email;
	}
	function setBirthdate($birthdate) {// 1990-05-04
		$this->birthdate = $birthdate;
	}
	function setLocation($location) {// Bellevue, Wa
		$this->location = $location;
	}
	function setFbLocationID($fb_location_id) {// 2147483647
		$this->fb_location_id = $fb_location_id;
	}
	function setRegistered($registered) {// 2011-07-16 01:09:46
		$this->registered = $registered;
	}
	function setLastLogin($last_login) {// 2011-07-16 13:09:46
		$this->last_login = $last_login;
	}
	public function setPrivileges($privileges) // 1 = disabled, 3 = normal, 5 = moderator, 9 = admin
	{
		$this->privileges = $privileges;
	}
	public function setTotalPoints($totalPoints) {
		$this->total_points = $totalPoints;
	}
    public function register_facebook($fb_data) // registers a new user from facebook
    {
		$registered_time = date('Y-m-d h:i:s'); // prepare current time
		$birthday_array = explode("/", $fb_data['me']['birthday']);
		$birthday = $birthday_array[2] ."-". $birthday_array[0] ."-". $birthday_array[1]; // formats date properly for insertion
		
		$user = array(
		'name' => $fb_data['me']['name'] ,
		'fb_id' => $fb_data['me']['id'],
		'uid' => $fb_data['uid'],
		'email' => $fb_data['me']['email'] ,
		'birthdate' => $birthday ,
		'location' => $fb_data['me']['location']['name'] ,
		'fb_location_id' => $fb_data['me']['location']['id'],
		'registered' => $registered_time,
		);
		$this->db->insert('users', $user); // The user has just registered. Add them.
		
		$id = $this->db->insert_id(); // has an error
		$user = User_model::byID($id);
		User_model::login($user);
		redirect('/user/profile/'.$user->getID()); // redirect to their profile.
		
		return $user;
    }
}
?>