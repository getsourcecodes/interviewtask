<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        $this->load->helper('url');


    }
    public function index_get() {
         $this->load->view('welcome');
    }

    public function createpromocode_post()   
    { 
        $requiredparameters = array('event_name', 'event_venue', 'promo_code','promovalue','radius', 'validity');
        $validation = $this->parameterValidation($requiredparameters,   $_POST); 
        if($validation=='valid') {
            $event_name=$this->input->post('event_name');
            $event_venue=$this->input->post('event_venue');
            $promo_code=$this->input->post('promo_code');
            $minamount=$this->input->post('promovalue');
            $radius=$this->input->post('radius');
            $validity=$this->input->post('validity');
            $this->db->where('p_promo_code',$promo_code);
            $alreadyexist = $this->db->get('promo_codes')->num_rows();
            if($alreadyexist <=0) {
                $data = array(
                            'p_event_name'=>$event_name,
                            'p_event_venue'=>$event_venue,
                            'p_promo_code'=>$promo_code,
                            'p_minamount'=>$minamount,
                            'p_radius'=>$radius,
                            'p_validtill'=>$validity,
                        );
                $response = $this->db->insert('promo_codes',$data);
                if($response) {
                    $return = array('status'=>1,'message'=>'successfully created new promo code');
                } else {
                    $return = array('status'=>0,'message'=>'error in creating promo code');
                }
            } else {
                $return = array('status'=>0,'message'=>'promo code already exists');
            }
        } else {
            $return = array('status'=>0,'message'=>$validation);
        }
        $this->set_response($return);
    }
    public function deactivatepromocode_post()   
    {
        $id = $this->input->post('id');
        if($id) {
            $this->db->where('p_id',$id);
            echo $exist = $this->db->get('promo_codes')->num_rows();
            if($exist >=1) { 
                $this->db->where('p_id',$id);
                $update =  $this->db->update('promo_codes',array('p_isactive'=>'0'));
                if($update) {
                    $return = array('status'=>1,'message'=>'successfully deactivated promo code');
                } else {
                    $return = array('status'=>0,'message'=>'unexpected error');
                }
            } else {
                 $return = array('status'=>0,'message'=>'invalid id');
            }
        } else {
            $return = array('status'=>0,'message'=>'id is required');
        }
        $this->set_response($return);
    }
    public function validatepromocode_post()   
    {
        $requiredparameters = array('source', 'destination', 'promocode');
        $validation = $this->parameterValidation($requiredparameters,   $_POST); 
        if($validation=='valid') {
            $source=$this->input->post('source');
            $destination=$this->input->post('destination');
            $promocode=$this->input->post('promocode');
            $this->db->select('*');
            $this->db->from('promo_codes');
            $this->db->where('p_isactive',1);
            $this->db->where('p_promo_code',$promocode);
            $this->db->where('p_validtill >',date('Y-m-d'));
            $query = $this->db->get();
            if($query !== FALSE && $query->num_rows() > 0){
                $return = array('status'=>1,'message'=>'promo code applied successfully','data'=>$query->result_array());
            } else {
                $return = array('status'=>0,'message'=>'invalid promo code','data'=>'');
            }
        } else {
            $return = array('status'=>0,'message'=>$validation);
        }
        $this->set_response($return);
    }
    public function getpromocode_get($type)   
    {
        if($type=='all' || $type=='active') { 
            $this->db->select('*');
            $this->db->from('promo_codes');
            if($type=='active') {
                $this->db->where('p_isactive',1);
                $this->db->where('p_validtill >',date('Y-m-d'));
            }
            $query = $this->db->get();
            if($query !== FALSE && $query->num_rows() > 0){
                $return = array('status'=>1,'message'=>'success','data'=>$query->result_array());
            } else {
                $return = array('status'=>0,'message'=>'no data','data'=>'');
            }
        } else {
            $return = array('status'=>0,'message'=>'invalid request','data'=>'');
        }
        $this->set_response($return);
    }
    public function parameterValidation($required,$postvalues)
    {
        $missing = array();
        foreach($required as $field) {
            if(!isset($postvalues[$field])) {
                $error = true;
                $missing[] = $field;
            }
            if($field=='validity') {
                $tempDate = explode('-',$postvalues[$field]);
                if(count($tempDate)>2) {
                    if(!checkdate($tempDate[1], $tempDate[2], $tempDate[0])){
                        $missing[] = $field;
                    }
                } else { $missing[] = $field; }
            }
        }
        if(count($missing)>=1) {
            $count = (count($missing)>=2?'are':'is');
            return implode(", ", $missing).' '.$count.' required';
        }
        else {
            return 'valid';
        } 
    }
}
