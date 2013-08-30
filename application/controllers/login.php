<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


/**
 * Controlador para escribir las funciones del login
 *
 * @author jorge
 */
    
    var $funciones;

public function __construct() {
    parent::__construct();
    $this->load->model('login_model');
    $this->funciones=new Funciones();
}

 /**
  * Funcion:index
  * Descripcion: Funcion de inicio por default 
  * se va al template del sistema
  * 
  */
public function index(){
    $this->load->view('template_view');
} 


 /**
  * Funcion:login
  * Descripcion: Para verificar los datos del usuario 
  * en la vista de la vista login_view
  * 
  */
function acceso(){
    $this->form_validation->set_rules('email','E-mail','required|valid_email');
    $this->form_validation->set_rules('password','password','required|md5');
    
    $this->form_validation->set_message('valid_email','E-mail no valido');
    $this->form_validation->set_message('required','Es necesario llenar el campo %s');
    
    if($this->form_validation->run()==FALSE){
        $data=array();
        $this->load->view('template_view',$data);
    }else{
        $email=  $this->input->post('email');
        $password=  $this->input->post('password');
        
        $this->load->model('login_model');
        if($this->login_model->comprobar_acceso($email,$password)){
            
            $this->login_model->cargar_datos_session($email);
            $data=array('mensaje'=>'Bienvenid@','tipo_mensaje'=>'success');
            $this->load->view('template_view',$data);
            
        }else{
            $data=array('mensaje'=>'Comprueba que tu e-mail o password sean validos y hallas confirmado tu registro.','tipo_mensaje'=>'error');
            $this->load->view('template_view',$data);
        }
    }
}

function logout(){
    $this->session->sess_destroy();
    $data=array('mensaje'=>'Hasta pronto!','tipo_mensaje'=>'success');
    $this->load->view('template_view',$data);
}

function registro(){
    $this->form_validation->set_rules('nombre','Nombre','required|trim');
    $this->form_validation->set_rules('apellidos','Apellidos','required|trim');
    $this->form_validation->set_rules('fecha_nac','Fecha de nacimiento','required|trim');
    $this->form_validation->set_rules('genero','Genero','required');
    $this->form_validation->set_rules('email','E-mail','required|valid_email|callback_email_check');
    $this->form_validation->set_rules('password','Password','required|md5');
    
    $this->form_validation->set_message('valid_email','E-mail no valido');
    $this->form_validation->set_message('required','Es necesario llenar el campo %s');
            
    if($this->form_validation->run()==FALSE){
        $data=array('vista'=>'registro_view');
        $this->load->view('template_view',$data);
    }else{
        $data=array(
            'nombre'=>  $this->input->post('nombre'), 
            'apellidos'=>  $this->input->post('apellidos'), 
            'fecha_nacimiento'=> $this->funciones->formatear_fecha($this->input->post('fecha_nac')), 
            'sexo'=>$this->input->post('genero'), 
            'email'=>$this->input->post('email'), 
            'password'=>  $this->input->post('password'),
            'idcat_tipo_usuario'=>1,
            'idcat_status'=>1
        );
        
        $registro=$this->login_model->registrar_usuario($data);
        
        if($registro!=FALSE){
            
            $this->enviar_correo_para_confirmar_registro($data);
            
            $data=array('mensaje'=>'<strong>Felicidades!</strong> ya solo falta confirmar tu registro. 
                Confirma tu registro en el enlace que te hemos enviado a tu correo electr&oacute;nico',
                'tipo_mensaje'=>'success');
            
            $this->load->view('template_view',$data);
        }else{
            $this->load->view('template_view',$registro);
        }
        
    }
}

public function confirmar_registro(){
    $email_encrypt=  strtr($this->uri->segment(3), '-_.', '+/=');
    
    $email= $this->encrypt->decode($email_encrypt);
    
    $query=  $this->db->get_where(
            'tbl_usuarios',
            array(
                'email'=>$email,
                'idcat_status'=>1));
    
    if($query->num_rows()>0){
        $update = array(
               'idcat_status' => 2
            );

        $this->db->where('email', $email);
        $this->db->update('tbl_usuarios', $update); 
        
        $data=array('mensaje'=>'Confirmaci&oacute;n exitosa. Ahora puedes entrar con tu cuenta!','tipo_mensaje'=>'success');
        $this->load->view('template_view',$data);
        
    }else{
        $data=array('mensaje'=>'Confirmaci&oacute;n no valida!','tipo_mensaje'=>'error');
        $this->load->view('template_view',$data);
    }
    
}

public function enviar_correo_para_confirmar_registro($data){
    $this->load->library('email');
    
    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['mailtype']='html';

    $this->email->initialize($config);
    
    $subject='CONFIRMACION DE REGISTRO';
    
    $enlace_confirmacion=strtr($this->encrypt->encode($data['email']),'+/=', '-_.');

    $message='<strong>Felicidades!!!</strong><p>Ahora puedes confirmar tu registro haciendo clic en el siguiente enlace</p>
        <br /><p><a href="'.base_url().'index.php/login/confirmar_registro/'.$enlace_confirmacion.'">Confirmar registro.</a></p>';
    
    $this->email->from('admin@ruizinova.com', 'WEBMASTER RUIZINOVA');
    
    $this->email->to($data['email']); 

    $this->email->subject($subject);
    $this->email->message($message);	

    $this->email->send();
}

public function email_check($email){
    $query=  $this->db->get_where('tbl_usuarios',array('email'=>$email));
    
    if($query->num_rows()>0){
        $this->form_validation->set_message('email_check', 'El %s ya esta siendo usado por otro usuario');
        return FALSE;
    }else{
        return TRUE;
    }

}


} //Fin de la clase



?>
