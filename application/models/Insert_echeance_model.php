<?php  
 class Insert_echeance_model extends CI_Model  
 {  
      
   /* function saverecords($data)
    {
          $this->db->insert('contenue',$data);
          return true;
    } */

    function __construct() {
        $this->tableName = 'echeance';
        $this->primaryKey = 'id';
    }
    
    public function insert($data = array()){
        $insert = $this->db->insert($this->tableName,$data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;    
        }
    }

    function findAllEcheance()  
      {     
           return $query = $this->db->get('typeecheance');
      }  

 }  