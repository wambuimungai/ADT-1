<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdrr_Api extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
		//Load Logic Controller
		$this->load->library('../controllers/cdrr_logic');
	}

	public function authuser() 
	{
        $username = $this->input->post('username',TRUE);
        $password = $this->input->post('password',TRUE);

        //Process User
        $logic = new Cdrr_Logic;
        $user = $logic->processUser($username,$password);
        return $user;
	}

	public function getcdrr() 
	{
        //Get Cdrrs
        $logic = new Cdrr_Logic;
        $cdrrs = $logic->getcdrr();
        return $cdrrs;
	}

}

/* End of file cdrr_api.php */
/* Location: ./application/controllers/cdrr_api.php */
