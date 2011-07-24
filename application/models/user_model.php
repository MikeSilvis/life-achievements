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

    function User($params = NULL)
	{
		if(is_array($params))
		{
			$this->setID                ($params['user_id']);
			$this->setFBID           	($params['fb_id']);
			$this->setUID				($params['uid']);
            $this->setName 				($params['name']);
			$this->setEmail      		($params['email']);
			$this->setBirthdate         ($params['birthdate']);
			$this->setLocation          ($params['location']);
			$this-setFBLocationID		($params['fb_location_id']);
			$this-setRegistered			($params['registered']);
			$this-setLastLogin			($params['last_login']);
			
		}
	}
    /*
	***********************************************************************************
								SECTION: BUILD_USER
	***********************************************************************************
	*/
	public function byID($user_id)
	{
		$query = $this->db->get_where('user', array('user_id' => $user_id), 1);
		return $this->User_model->getNew($query);
	}
	public function byFBID($fb_id)
	{
		$query = $this->db->get_where('user', array('fb_id' => $fb_id), 1);
		return $this->User_model->getNew($query);
	}
	public function byFriends($friends)
	{
		$this->db->where_in('uid', $friends);
		$query = $this->db->get('user');
		return $this->User_model->getNew($query,true);
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
		
				// This allows for the function to either return an array of users or a single user
				if ($array == false)
					$user = $tempUser;
				else
					$user[] = $tempUser;
			}				
			return $user;
		}
		else
			return false;
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
	public function getRegisteredFriends(){
		$fql = "SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND is_app_user = 1";
 
		$response = $this->facebook->api(array(
			'method' => 'fql.query',
			'query' =>$fql,
		));
		foreach ($response as $key => $val) {
		  $response[$key] = $response[$key]['uid'];
		}
		
		$friendsArray = User_model::byFriends($response, true);
		return $friendsArray;
	}
	public function getUsers() {
		$query = $this->db->get('user');
          
       	return $this->User_model->getNew($query,true);

	}
	
	/*
	***********************************************************************************
								SECTION: UPDATE_METHODS
	***********************************************************************************
	*/
	public function login($user)
    {
    	$this->User_model->updateLastLogin($user);
		$this->session->set_userdata($user); // This array contains all the user FB information
    }
	private function updateLastLogin($user) {
		$time = date("Y-m-d H:i:s");
		$user->setLastLogin($time);
		$this->db->set($user);
		$this->db->where('user_id', $user->getID());
		$this->db->update('user');
	}
	/*
	***********************************************************************************
								SECTION: SET_METHODS
	***********************************************************************************
	*/
	function setID($user_id) {					// 20
		$this->user_id = $user_id;
	}
	function setFbID($fb_id) {					// 34234234
		$this->fb_id = $fb_id;
	}
	function setUID($uid) {						// 1476420296
		$this->uid = $uid;
	}
	function setName($name) {					// Mike Silvis
		$this->name = $name;
	}	
	function setEmail($email) {					// MikeSilvis@gmail.com
		$this->email = $email;
	}
	function setBirthdate($birthdate) {			// 1990-05-04
		$this->birthdate = $birthdate;
	}
	function setLocation($location) {			// Bellevue, Wa
		$this->location = $location;
	}
	function setFbLocationID($fb_location_id) {	// 2147483647
		$this->fb_location_id = $fb_location_id;
	}
	function setRegistered($registered) {		// 2011-07-16 01:09:46
		$this->registered = $registered;
	}
	function setLastLogin($last_login) {		// 2011-07-16 13:09:46
		$this->last_login = $last_login;
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
		$this->db->insert('user', $user); // The user has just registered. Add them.
		
		$id = $this->db->insert_id(); // has an error
		$user = User_model::byID($id);
		User_model::login($user);
		redirect('/user/profile/'.$user->getID()); // redirect to their profile.
		
		return $user;
    }
}
?>