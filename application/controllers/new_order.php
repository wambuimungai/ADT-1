<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *Filename:new_order.php
 *projectname:ADT
 *Date created:October 27,2014
 *Created by:Kevin Marete
 */
class New_Order extends MY_Controller {

	var $escm_url = "http://api.kenyapharma.org/";
	var $nascop_url = "http://localhost/NASCOP/";

	function __construct() 
	{
		parent::__construct();
		$this -> load -> library('Curl');
	}

	/**
     * index
     * Function Loads on Default 
     * 
     * @access  public
     * @return  void
     * @author  Kevin Marete
     * @version 1.0
     **/

	public function index() 
	{
		$facility_code = $this -> session -> userdata('facility');
		//Get Supplier
		$facility_obj = Facilities::getSupplier($facility_code);
		$supplier_name = strtolower($facility_obj -> supplier -> name);

		//Default URL is KenyaPharma
		$connection_url = $this ->escm_url;

        if($supplier_name == "kemsa")
        {
        	$connection_url = $this ->nascop_url;
        }
		//Check network status 
		$connection_status = $this ->_is_connected($connection_url);

		if($connection_status)
        {   
			//Check User if logged in
			$login_status = $this -> _is_logged_in();
			if($login_status)
			{
				//Load Cdrrs/Maps Homepage
				$data['content_view'] = "orders/order_v";
				$data['cdrr_buttons'] = $this -> get_buttons("cdrr");
				$data['cdrr_filter'] = $this -> get_filter("cdrr");
				$data['fmap_buttons'] = $this -> get_buttons("maps");
				$data['maps_filter'] = $this -> get_filter("maps");
				$data['cdrr_table'] = $this -> get_orders("cdrr");
				$data['map_table'] = $this -> get_orders("maps");
				$data['aggregate_table'] = $this -> get_orders("aggregate");
				$data['facilities'] = Facilities::getSatellites($facility_code);
			}
			else
			{
                //Take user to order login page
			    $data['content_view'] = "orders/login_v";
			    $data['login_type'] = 1;
			    if($supplier_name == "kemsa") 
			    {
				    $data['login_type'] = 0;
				}
			}
        }
        $data['supplier_name'] = $supplier_name;
		$data['page_title'] = "my Orders";
		$data['banner_text'] = "Facility Orders";
		$this -> base_params($data);
	}

	/**
     * is_connected
     * Function checks on internet connection
     * 
     * @access  private
     * @return  bool
     * @author  Kevin Marete
     * @version 1.0
     **/

	private function _is_connected($url = '')
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

	/**
     * is_logged_in
     * Function checks if user is logged in
     * 
     * @access  private
     * @return  bool
     * @author  Kevin Marete
     * @version 1.0
     **/

	private function _is_logged_in()
	{
        $logged_in = FALSE;
        if ($this -> session -> userdata('api_id'))
        {
            $logged_in = TRUE;
        } 
	}

	/**
     * base_params
     * Function Load Default Template
     * 
     * @access  public
     * @return  void
     * @author  Kevin Marete
     * @version 1.0
     **/

	public function base_params($data) 
	{
		$data['title'] = "Order Reporting";
		$data['link'] = "order_management";
		$this -> load -> view('template', $data);
	}

	public function get_filter($type = "cdrr") {
		$filter = "<span><b>Filter Period:</b></span><select class='" . $type . "_filter'>";
		$filter .= "<option value='0'>All</option>";
		if ($type == "cdrr") {
			$periods = Cdrr::getPeriods();
			foreach ($periods as $period) {
				$filter .= "<option value='" . $period['periods'] . "'>" . date('F-Y', strtotime($period['periods'])) . "</option>";
			}
		} else if ($type == "maps") {
			$periods = Maps::getPeriods();
			foreach ($periods as $period) {
				$filter .= "<option value='" . $period['periods'] . "'>" . date('F-Y', strtotime($period['periods'])) . "</option>";
			}
		}
		$filter .= "</select>";
		return $filter;
	}

	public function get_buttons($type = "cdrr") {
		$facility_code = $this -> session -> userdata("facility");
		$buttons = "";
		$set_type = "order/create_order/" . $type;
		$satellite_type = 'btn_new_' . $type . '_satellite';

		$facility_type = Facilities::getType($facility_code);
		if ($facility_type == 0) {
			$buttons .= "<a href='" . base_url() . $set_type . "/2' class='btn check_net'>New Satellite $type</a>";
		} else if ($facility_type == 1) {
			$buttons .= "<a href='" . base_url() . $set_type . "/3' class='btn'>New Stand-Alone $type</a>";
		} else if ($facility_type > 1) {
			$buttons .= "<a href='" . base_url() . $set_type . "/0' class='btn'>New Aggregate $type</a>";
			$buttons .= "<a href='" . base_url() . $set_type . "/1' class='btn'>New Central $type</a>";
			$buttons .= "<a data-toggle='modal' href='#select_satellite' class='btn check_net btn_satellite' id='$satellite_type'>New Satellite $type</a>";
		}
		return $buttons;
	}


	public function get_orders($type = "cdrr", $period_begin = "") {
		$columns = array('#', '#ID', 'Period Beginning', 'Status', 'Facility Name', 'Options');
		$facility_code = $this -> session -> userdata('facility');
		$supplier = $this -> get_supplier($facility_code);
		$facility_table = "sync_facility";
		$facility_name = "f.name";
		$conditions = "";

		$user_facilities = User_Facilities::getHydratedFacilityList($this -> session -> userdata("api_id"));

		$facilities = json_decode($user_facilities['facility'], TRUE);
		$facilities = implode(",", $facilities);

		if ($period_begin != "" && $type == "cdrr") {
			$conditions = "AND c.period_begin='$period_begin'";
		}
		if ($period_begin != "" && $type == "maps") {
			$conditions = "AND m.period_begin='$period_begin'";
		}
		if ($period_begin == 0 && $type == "cdrr") {
			$conditions = "";
		}
		if ($period_begin == 0 && $type == "maps") {
			$conditions = "";
		}

		if ($type == "cdrr") {
			$sql = "SELECT c.id,IF(c.code='D-CDRR',CONCAT('D-CDRR#',c.id),CONCAT('F-CDRR#',c.id)) as cdrr_id,c.period_begin,LCASE(c.status) as status_name,$facility_name as facility_name
				    FROM cdrr c
				    LEFT JOIN $facility_table f ON f.id=c.facility_id
				    WHERE facility_id IN($facilities)
				    AND c.status NOT LIKE '%deleted%'
				    $conditions
				    ORDER BY c.period_begin desc";
		} else if ($type == "maps") {
			$sql = "SELECT m.id,IF(m.code='D-MAPS',CONCAT('D-MAPS#',m.id),CONCAT('F-MAPS#',m.id)) as maps_id,m.period_begin,LCASE(m.status) as status_name,$facility_name as facility_name
					FROM maps m
					LEFT JOIN $facility_table f ON f.id=m.facility_id
					WHERE facility_id IN($facilities)
					AND m.status NOT LIKE '%deleted%'
					$conditions
					ORDER BY m.period_begin desc";
		} else if ($type == "aggregate") {
			$facility_type = Facilities::getType($facility_code);
			$sql = "";
			$columns = array('#', 'Facility Name', 'Period Beginning', 'Options');

			if ($facility_type > 1  && $supplier == "KEMSA") {
				$sql = "SELECT c.period_begin as id,sf.name as facility_name,c.period_begin,c.id as cdrr_id,m.id as maps_id,c.facility_id as facility_id,f.facilitycode as facility_code
						FROM cdrr c 
						LEFT JOIN maps m ON (c.facility_id=m.facility_id) AND (c.period_begin=m.period_begin) AND (c.period_end=m.period_end)
						LEFT JOIN sync_facility sf ON sf.id=c.facility_id 
						LEFT JOIN facilities f ON f.facilitycode=sf.code
						WHERE c.code = 'D-CDRR' 
						AND m.code='D-MAPS'
						AND LCASE(c.status) NOT IN('prepared','review','deleted')
						AND LCASE(m.status) NOT IN('prepared','review','deleted')
						AND c.facility_id IN($facilities)
						GROUP BY c.period_begin
	                    ORDER BY c.period_begin desc";
			}
		}
		if ($sql != "") {
			$query = $this -> db -> query($sql);
			$results = $query -> result_array();
		} else {
			$results = array();
		}

		if ($period_begin != "") {
			echo $this -> generate_table($columns, $results, $type);
		} else {
			if ($period_begin != 0) {
				echo $this -> generate_table($columns, $results, $type);
			} else {
				return $this -> generate_table($columns, $results, $type);
			}
		}
	}

}

/* End of file new_order.php */
/* Location: ./application/controllers/new_order.php */
