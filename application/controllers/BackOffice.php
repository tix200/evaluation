<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends CI_Controller {

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
	public function index()
	{
		if($this->session->userdata('username') != "")
		{
			$this->load->view('backOffice/insertContenue');
		}
		else{
			redirect(base_url() . 'LoginAdmin/login');
		}
		//echo "mety";
	}

	public function __construct()
	{
	/*call CodeIgniter's default Constructor*/
	parent::__construct();
	
	/*load database libray manually*/
	$this->load->database();
	
	/*load Model*/
	$this->load->model('insert_model');
	}

    function add()
    {
    	if($this->session->userdata('username') != "")
    	{
	    	$this->load->view('backOffice/insertContenue');
	        if($this->input->post('ok'))
	        {
	            
	            //Check whether Member upload profile_img
	            if(!empty($_FILES['profile_img']['name']))
	            {
	                $config['upload_path'] = 'uploads/images/';
	                $config['allowed_types'] = 'jpg|jpeg|png|gif';
	                $config['file_name'] = $_FILES['profile_img']['name'];
	                
	                //Load upload library and initialize here configuration
	                $this->load->library('upload',$config);
	                $this->upload->initialize($config);
	                
	                if($this->upload->do_upload('profile_img'))
	                {
	                    $uploadData = $this->upload->data();
	                    $profile_img = $uploadData['file_name'];
	                }
	                else
	                {
	                    $profile_img = '';
	                }
	            }
	            else
	            {
	                $profile_img = '';
	            }
	            
	            //Prepare array of Member data
	            $MemberData = array(
	                'numero' => $this->input->post('numero'),
	                'marque' => $this->input->post('marque'),
	                'type' => $this->input->post('type'),
	                'modele' => $this->input->post('modele'),
	                'image' => $profile_img
	            );
	            
	            //Pass Member data to model
	            $insertMemberData = $this->insert_model->insert($MemberData);
	            
	            //Storing insertion status message.
	            if($insertMemberData){
	                $this->session->set_flashdata('success_msg', 'Member data have been added successfully.');
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
