<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 class crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function contacto_save(){
    	$data['name']=$this->input->post('contacto_nombre');
    	$data['email']=$this->input->post('contacto_email');
    	$data['state']=$this->input->post('contacto_state');
    	$data['city']=$this->input->post('contacto_city');
    	$var_usuario=$this->db->get_where('contacts',array('email'=>$data['email']))->row();
    	if(!isset($var_usuario)){
    		$this->db->insert('contacts',$data);
    		echo "<script> window.onload =function(){ $('#texto_modal').html('Datos Enviados');$('#modalMensajes').modal('show');}</script>";	
    	}else{
    		//si entra aqui significa que existe ya el email 
    		echo "<script> window.onload =function() { $('#texto_modal').html('El email ya fue registrado');$('#modalMensajes').modal('show');}</script>";	
    	}
    	
    }
    function validar_email($email){
    	$var_usuario=$this->db->get_where('contacts',array('email'=>$email))->row();
    	if(isset($var_usuario)){
    		echo json_encode(array('estado'=>'Existe'));
    	}else{
    		echo json_encode(array('estado'=>'No'));
    	}
    }
 }
