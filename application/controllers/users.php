<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    private $client;
    public function __construct(){
        parent::__construct();
        $this->client = new Google_Client(['client_id' => '287308773092-al0dbi4h27mfo4gcfsenlpsecklu4qhj.apps.googleusercontent.com']);
    }
    
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
                $user_data['user_id'] = $this->user_model->getUserId($user_data);
                $user_data['team_manager'] = $this->user_model->getTeamManager($user_data['email']);
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_status','you are logged in!');   
                $json['status'] = 'ok';
                $json['data'] = $user_data;
                $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($json));
    }
    public function autocomplete($username){  
        $json = $this->user_model->getUserByName($username);
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
            if(!empty($this->user_model->check_user($this->input->post('email')))){
                 $this->session->set_flashdata('register_error','Sorry, the email already exist, please login.');
                redirect('home');
            }else{
                $this->user_model->create_user();
                $this->session->set_flashdata('user_registered','User has been registered!');
                redirect('home');
            }    
        }
    }
    public function edit(){

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]');
        $this->form_validation->set_error_delimiters('<p class="bg-danger">','</p>');
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user_model->getUsersById($user_id)[0];
        if($this->form_validation->run() == FALSE){
            $data['main_view'] = 'users/edit_user';
            $this->load->view('layouts/main', $data);
        } else {
            if($this->user_model->update_user($user_id)){
                
                $this->session->set_flashdata('user_updated','User info has been updated!');
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
            $team_manager = $this->user_model->getTeamManager($email);
            $user_id = $this->user_model->login_user($email, $password);
            if($user_id){
                $user_data = array(
                'user_id' => $user_id,
                'email' => $email,
                'username' => $username,
                'logged_in' => true,
                'team_manager' => $team_manager
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
