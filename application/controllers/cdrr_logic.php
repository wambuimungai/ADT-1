<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdrr_Logic extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
		//Load Logic Controller
		$this->load->library('../controllers/cdrr_dal');
	}

	public function processUser($username='',$password='') 
	{
        $user =array(
        	        'username' =>'Gauthier',
        	        'password' =>'Marete');
        return json_encode($user);
	}

	public function getcdrr() 
	{
        $dal = new Cdrr_Dal;
        $cdrr_array = $dal->getcdrr();

        $temp = array();
        foreach($cdrr_array as $counter => $cdrr)
        {  
        	foreach ($cdrr as $key => $value) {
                $temp [$counter][] = $value;
            }
        }
        $data['aaData'] = $temp;
        echo json_encode($data);
	}
}

/* End of file cdrr_logic.php */
/* Location: ./application/controllers/cdrr_logic.php */
