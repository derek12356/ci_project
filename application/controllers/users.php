<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    private $client;
    public function __construct(){
        parent::__construct();
        $this->client = new Google_Client(['client_id' => '287308773092-al0dbi4h27mfo4gcfsenlpsecklu4qhj.apps.googleusercontent.com']);
    }

//	public function show($user_id)
//	{
//		$data['results'] = $this->user_model->get_users($user_id);
//        $this->load->view('user_view', $data);
//    }
//    public function insert(){
//        $this->user_model->update_user([
//            'username' => 'peter',
//            'password' => '123321'
//            
//        ]);
//    }
//    public function update(){
//             $username = 'derek';
//             $password = 'derek123';
//             $id = 1;
//        $this->user_model->update_user([
//            'username' => $username,
//            'password' => $password
//            
//        ],$id);
//    }
//    public function delete($id){
//        $this->user_model->delete_user($id);
//    }
//    public function verifyTokenId(){
//        $token_id = $this->input->post('token_id');
////        $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($token_id));
//  // Specify the CLIENT_ID of the app that accesses the backend
//        $payload = $client->verifyIdToken($token_id);
//        return $payload;
////        var_dump($this->user_model->checkExist($payload['email']));
////        var_dump($payload);        
//    }
    
    public function googleLog(){
            $token_id = $_POST['id_token'];
            $payload = $this->client->verifyIdToken($token_id);
            $json['data'] = $payload;
            $user_data = array(
                'password' =>$payload['at_hash'],
                'email' =>  $payload['email'],
                'username' =>  $payload['given_name'],
                'first_name' =>  $payload['given_name'],
                'last_name' =>  $payload['family_name'],
                'logged_in' => true      
                );
                $this->user_model->create_user_google($user_data);
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_status','you are logged in!');   
                $json['status'] = 'ok';
                $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($json));
    }

    public function register(){

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        $this->form_validation->set_error_delimiters('<p class="bg-danger">','</p>');
        if($this->form_validation->run() == FALSE){
            $data['main_view'] = 'users/register_view';
            $this->load->view('layouts/main', $data);
        } else {
            if($this->user_model->create_user()){
                
                $this->session->set_flashdata('user_registered','User has been registered!');
                redirect('home');
            }else{
                
            }    
        }
    }
    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
//        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        if($this->form_validation->run() == FALSE){
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('home');
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $username = $this->user_model->getUserName($email);
            $user_id = $this->user_model->login_user($email, $password);
            if($user_id){
                $user_data = array(
                'user_id' => $user_id,
                'email' => $email,
                'username' => $username,
                'logged_in' => true      
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_status','you are logged in!');
                $data['main_view'] = "admin_home";
                $this->load->view('layouts/main',$data);
            }else{
               $this->session->set_flashdata('login_status','sorry, you are not logged in.');
               redirect('home');
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }

}
