<?php  
 class Voiture_model extends CI_Model  
 {  
      
  function findVoitureEcheance()  
      {  

        $this->db->select('*');
        $this->db->from('voiture');
        $this->db->join('echeance', 'voiture.id = echeance.idVoiture');
        return $query = $this->db->get();   
           
      }

  function detailVoiture($id)  
      {  

        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('voiture');
        return $query = $this->db->get();   
           
      }
  function echeanceVoiture($id)  
      {  

        $this->db->select('*');
        $this->db->where('idVoiture', $id);
        $this->db->from('echeance');
        return $query = $this->db->get();   
           
      }
  function chauffeurVoiture($id)  
      {  

        $this->db->select('*');
        $this->db->where('idVoiture', $id);
        $this->db->from('chauffeur');
        return $query = $this->db->get();   
           
      } 

  function voitureDispo()  
      {  

        $this->db->select('*');
        $this->db->where('disponible',0);
        $this->db->from('voiture');
        return $query = $this->db->get();   
           
      }  

  function findAllVoiture()  
      {  

        $this->db->select('*');
        $this->db->from('voiture');
        return $query = $this->db->get();   
           
      }
  function setDisponible()
  {
    $data  =  array ( 
        'disponible'  => 1, 
    );

    $this -> db -> replace ( 'table' ,  $data );
      }        
 }  