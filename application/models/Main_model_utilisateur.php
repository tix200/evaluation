<?php  
 class Main_model_utilisateur extends CI_Model  
 {  
      function can_login($username, $password)  
      {  
           $this->db->where('login', $username);  
           $this->db->where('mdp', $password);  
           $query = $this->db->get('chauffeur');

           $info=array();  
           //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
           if($query->num_rows() > 0)  
           {  
            foreach ($query->result() as $row)
            {
                    $info=$row->id;
                    return $info;
            }

           }  
           else  
           {  
                return 0;       
           }  
      }  
 }  