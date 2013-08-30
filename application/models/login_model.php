<?php
class Login_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function comprobar_acceso($email,$password){
        $query=$this->db->get_where(
                'tbl_usuarios',
                array(
                    'email'=>$email,
                    'password'=>$password,
                    'idcat_status'=>2));
         if($query->num_rows()>0){
             return TRUE;
         }else{
             return FALSE;
         }
    }
    
    function registrar_usuario($data){
        $this->db->insert('tbl_usuarios',$data);
        
        if($this->db->affected_rows()>0)
            return TRUE;
        else
            return array(
                'mensaje'=>'Fallo al registrar usuario, comunicate con el administrador',
                'tipo_mensaje'=>'error');       
    }
    
    function cargar_datos_session($email){
        $query=$this->db->get_where('tbl_usuarios',array('email'=>$email));
        $datos=$query->row_array();
        $this->session->set_userdata($datos);
        
        $this->session->set_userdata('logueado',TRUE);
    }
}

?>
