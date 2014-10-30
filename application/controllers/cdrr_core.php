<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdrr_Core extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
		//Load Api
		$this->load->library('../controllers/cdrr_api');
	}

	public function login() 
	{
        //Use API to authenticate user
        $api = new Cdrr_Api;
        $response = $api -> authuser();

        //Process User
        if(empty($response['error']))
        {
            //Go to Login Interface
            redirect("cdrr_interfaces/listing");
        }
        else{
        	//Go to listing
        	redirect("cdrr_interfaces/login");
        }
	}

	public function listing()
	{
		//Use API to get cdrrs
		$api = new Cdrr_Api;
        echo $response = $api -> getcdrr();
	}

	private function is_connected($url = '')
	{
	    $connection = get_headers($url, 1);
	    $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', $connection[0] , $status);
        $is_conn = TRUE;

	    if ($status[1] == '404')
	    {
	        $is_conn = FALSE;
	    }
	    return $is_conn;
	}

}

/* End of file cdrr_core.php */
/* Location: ./application/controllers/cdrr_core.php */
