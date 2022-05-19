<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjoutEcheance extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
	/*call CodeIgniter's default Constructor*/
	parent::__construct();
	
	/*load database libray manually*/
	$this->load->database();
	
	/*load Model*/
	$this->load->model('insert_echeance_model');
	$this->load->model('voiture_model');
	}

	public function index()
	{
		if($this->session->userdata('usernamefo') != 0)
		{
			$response=$this->insert_echeance_model->findAllEcheance();
			$response2=$this->voiture_model->findAllVoiture();
			
			$this->load->view('echeance/ajoutEcheance',array(
			'test' =>$response,
			'allVoiture' =>$response2
		));
		}
		else{
			redirect(base_url() . 'LoginAdmin/login');
		}
		//echo "mety";
	}

    function add()
    {
    	if($this->session->userdata('usernamefo') != 0)
    	{
	        if($this->input->post('ok'))

	        	$dateDebut=$this->input->post('dateDebut');
	        	$dateFin=$this->input->post('dateFin');

				$date = new DateTime('now');
				$secondDate =$date->format('Y-m-d');

				$dateDifference = abs(strtotime($secondDate) - strtotime($dateFin));

				$years  = floor($dateDifference / (365 * 60 * 60 * 24));
				$months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
				$days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));

				$jrestant =  $years." anne,  ".$months." mois et ".$days." jours";
				$jrestant2=($years*365)+($months*24)+$days;
//-> Il s'est écoulé +02 sec
	 
	        {
	         //Prepare array of Member data
	            $MemberData = array(
	                'type' => $this->input->post('type'),
	                'dateDebut' => $dateDebut,
	                'dateFin' => $dateFin,
	                'nbJours' => $jrestant2,
	                'idVoiture' =>$this->input->post('idVoiture'),
	            );
	            
	            //Pass Member data to model
	            $insertMemberData = $this->insert_echeance_model->insert($MemberData);
	            
	            //Storing insertion status message.
	            if($insertMemberData){
	                $this->session->set_flashdata('success_msg', 'Member data have been added successfully.');
	                redirect(base_url() . 'ajoutEcheance');
	            }
	            else
	            {
	                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
	            }
	        }
    	}
    	else
		{
			redirect(base_url() . 'LoginAdmin/login');
		}
        
     }
}
