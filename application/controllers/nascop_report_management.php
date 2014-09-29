<?php
class nascop_report_management extends MY_Controller{
	var $nascop_url = "";
	function __construct() {
		parent::__construct();
		$this -> load -> database();
        parent::__construct();

        ini_set("max_execution_time", "100000");
        ini_set("memory_limit", '2048M');
        ini_set("allow_url_fopen", '1');

        $dir = realpath($_SERVER['DOCUMENT_ROOT']);
        $link = $dir . "\\ADT\\assets\\nascop.txt";
        $this -> nascop_url = file_get_contents($link);
        
	}

	public function index(){}
 

public function send_nascop_reports(){
    $url=$this ->nascop_url."";
    $facility_code = $this->session ->userdata("facility");

    $data=array();
    $data['patients_list_by_regimen']=patient::get_patients_starting_by_regimen();
    $data['non_adherence_reason']=patient_visit::getNon_adherence_reason();
    $data['lost_to_followup']=patient::get_lost_to_followup();
    $data['Started_on_firstline']=patient::get_patients_started_on_firstline();
    $data['Started_on_ART']=patient::get_patients_started_on_ART();

    $data['facility_code']=$facility_code;
    $json_data = json_encode($data,JSON_PRETTY_PRINT);
     $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('json_data' => $json_data));
        $json_data = curl_exec($ch);
        if (empty($json_data)) {
            $message = "cURL Error: " . curl_error($ch);
        }else{
           $messages = json_decode($json_data, TRUE);
            $message = $messages[0]; 
        }
         curl_close($ch);
        return $message;

}
}