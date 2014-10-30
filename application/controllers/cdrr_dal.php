<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cdrr_Dal extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function getcdrr() 
	{   
        $this->db->select("c.id,c.period_begin,c.status,sf.name");
        $this->db->from("cdrr c");
        $this->db->join("sync_facility sf","sf.id=c.facility_id","left");
        $query=$this->db->get();
        return $query->result_array();
	}
}

/* End of file cdrr_dal.php */
/* Location: ./application/controllers/cdrr_dal.php */
