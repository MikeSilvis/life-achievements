<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Achievements extends CI_Controller {
    
    function index()
    {
        $data['title']  = 'Search Achievements';
      	$data['query']  = $this->db->get('achievements');
        
        $partials = array('content'=>'achievementsList');

        $this->template->load('main', $partials, $data);
    }
  	function add()
    {
      	$data['title'] = 'Add your Achievements';
              
      	$partials = array('content'=>'achievementsAdd');

        $this->template->load('main', $partials, $data);
    }
}
?>  