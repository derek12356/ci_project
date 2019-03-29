<?php

class Teams extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('no_access','you are not allowed or not logged in');
            redirect('home/index');
        }
    }   

    public function index(){
        $user_id = $this->session->userdata('user_id');
        $data['teams'] = $this->team_model->get_teams($user_id);
        $data['main_view'] = "teams/index";
        $this->load->view('layouts/main',$data);
    }
    
    public function create(){
        $this->form_validation->set_rules('team_name', 'Team Name', 'trim|required');
        $this->form_validation->set_rules('team_body', 'Team Description', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $data['main_view'] = 'teams/create_team';
            $this->load->view('layouts/main', $data);
        }else{
            $data = array(
                'team_user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('team_name'),
                'description' => $this->input->post('team_body')
            );
            if($this->team_model->create_team($data)){
              $this->session->set_flashdata('team_created', 'your team has been created');  
              redirect('teams/index');
            }
        }
    }
    
    public function display($id){
        $data['team_data'] = $this->team_model->get_team($id);
        $data['main_view'] = "teams/display";
        $this->load->view('layouts/main',$data);
    }
    

    public function edit($team_id){

        $this->form_validation->set_rules('team_name', 'Team Name', 'trim|required');
        $this->form_validation->set_rules('team_body', 'Team Description', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $data['team'] = $this->team_model->get_team($team_id);
            $data['main_view'] = 'teams/edit_team';
            $this->load->view('layouts/main', $data);
        }else{
            $data = array(
                'id' => $team_id,
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('team_name'),
                'description' => $this->input->post('team_body')
            );
            if($this->team_model->update_team($team_id,$data)){
              $this->session->set_flashdata('team_updated', 'your team has been updated');  
              redirect('teams/index');
            }
        }
    }
    
    public function delete($team_id){
        if($this->team_model->delete_team($team_id)){
            $this->session->set_flashdata('team_deleted','Your team has been deleted.');
        }
        redirect('teams/index');
    }
    
    public function get_team_members($team_id){
        $members = $this->team_model->get_member_by_team_id($team_id);
        $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($members));
    }
    
    public function join_team(){
        
      
            $user_id = $this->session->userdata('user_id');           
            $team_ids = $this->team_model->get_team_user($user_id);
            if(!empty($team_ids)){
                foreach($team_ids as $id){
                    $team =array();
                    $team = $this->team_model->getTeamsById($id);
                    $data['teams'][]=array(
                        'name' => $team[0]->name,
                        'id'   => $team[0]->id
                        );
                }
            }else{
                $data['teams'] =array();
            }
            $data['main_view'] = 'teams/join_team';
            $this->load->view('layouts/main', $data);
        
          if($this->input->post()){
            $team_ids = $this->input->post('team_user');
            $user_id = $this->session->userdata['user_id'];
            if($this->team_model->update_team_user($team_ids,$user_id)){
              $this->session->set_flashdata('team_updated', 'your team has been updated.');  
              redirect('home/index');
            }
          }
    }
    
    public function autocomplete($username){  
        $json = $this->team_model->getTeamByName($username);
        $this->output->set_content_type('application/json', 'utf-8')->set_output(json_encode($json));
    }
    
}
