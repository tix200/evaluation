<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voiture extends CI_Controller {

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
	$this->load->model('Voiture_model');
	}

	function index($id)  
      { 
			$response=$this->Voiture_model->detailVoiture($id);
			$response2=$this->Voiture_model->echeanceVoiture($id);
			$response4=$this->Voiture_model->voitureDispo();

			$this->load->view('frontOffice/detailVoiture',array(
			'detailVoiture' =>$response,
			'echeanceVoiture' =>$response2,
			'voitureDispo' =>$response4,
		)); 
      } 
}
