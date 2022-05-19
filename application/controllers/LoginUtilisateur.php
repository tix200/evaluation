<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class LoginUtilisateur extends CI_Controller {  
      //functions  
     
      function index()  
      {  
           //http://localhost/tutorial/codeigniter/main/login  
           $data['title'] = 'CodeIgniter Simple Login Form With Sessions';  
           $this->load->view("login/loginFo", $data); 
      } 
      function login()  
      {  
           //http://localhost/tutorial/codeigniter/main/login  
           $data['title'] = 'CodeIgniter Simple Login Form With Sessions';  
           $this->load->view("login/loginFo", $data);  
      }  
      function login_validation()  
      {  
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('username', 'Username', 'required');  
           $this->form_validation->set_rules('password', 'Password', 'required');  
           if($this->form_validation->run())  
           {  
                //true  
                $username = $this->input->post('username');  
                $password = $this->input->post('password');  
                //model function  
                $this->load->model('main_model_utilisateur');  
                if($this->main_model_utilisateur->can_login($username, $password)!=0)  
                {  
                     $session_data = array(  
                          'usernamefo'     =>    $this->main_model_utilisateur->can_login($username, $password)
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(base_url() . 'ajoutTrajet');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(base_url() . 'loginUtilisateur/login');  
                }  
           }  
           else  
           {  
                //false  
                $this->login();  
           }  
      }  
      function enter(){  
           if($this->session->userdata('username') != '')  
           {  
                echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';  
                echo '<label><a href="'.base_url

().'loginAdmin/logout">Logout</a></label>';  
           }  
           else  
           {  
                redirect(base_url() . 'loginUtilisateur/login');  
           }  
      }  
      function logout()  
      {  
           $this->session->unset_userdata('username');  
           redirect(base_url() . 'loginUtilisateur/login');  
      }  
 }  