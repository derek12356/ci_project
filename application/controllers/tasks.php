<?php

class Tasks extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('no_access','you are not allowed or not logged in');
            redirect('home/index');
        }
    }   
    
    public function index(){
        $data['tasks'] = $this->task_model->get_tasks();
        $data['main_view'] = "tasks/index";
        $this->load->view('layouts/main',$data);
    }
    
    public function my_tasks(){
        $user_id = $this->session->userdata('user_id');
        $task_ids = $this->task_model->get_my_task($user_id);
        if(!empty($task_ids)){
            foreach($task_ids as $task_id){
                $task_data = $this->task_model->get_task($task_id->task_id);
                $data['tasks'][]= array(
                    'data' => $task_data,
                    'checked' => ($task_data->status == 1) ? 'checked' : ''
                );           
            }
        }else{
                $data['no_task'] = "You don't hava any task.";
        }


        $data['main_view'] = "tasks/my_tasks";
        $this->load->view('layouts/main',$data);
    }
    
    public function display($task_id){
        $data['tasks'] = $this->task_model->get_task($task_id);
        $project_id = $this->task_model->get_task_project_id($task_id);
        $data['project_name'] = $this->project_model->get_project($project_id);
        $team_members = $this->task_model->get_team_member($task_id);
        if(!empty($team_members)){
                foreach($team_members as $id){
                    $member =array();
                    $member = $this->user_model->getUsersById($id);

                    $data['users'][]=array(
                        'username' => $member[0]->username,
                        'id'       => $member[0]->id
                        );
                }
            }else{
                $data['users'] =array();
            }
        $data['main_view'] = "tasks/display";
        $this->load->view('layouts/main',$data);
    }
    
    public function create($project_id){
        $this->form_validation->set_rules('task_name', 'Task Name', 'trim|required');
        $this->form_validation->set_rules('task_body', 'Task Description', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $data['users'] = array();
            $data['main_view'] = 'tasks/create_task';
            $this->load->view('layouts/main', $data);
        }else{
            $user_ids = $this->input->post('task_user');
            $data = array(
                'project_id' => $project_id,
                'task_name' => $this->input->post('task_name'),
                'task_body' => $this->input->post('task_body'),
                'due_time'  => $this->input->post('due_time')
            );
            if($this->task_model->create_task($user_ids,$data)){
              $this->session->set_flashdata('task_created', 'your task has been created');  
              redirect('projects/index');
            }
        }
    }
    
    public function edit($task_id){

        $this->form_validation->set_rules('task_name', 'task Name', 'trim|required');
        $this->form_validation->set_rules('task_body', 'task Description', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $data['task'] = $this->task_model->get_task($task_id);
                       
            $team_members = $this->task_model->get_team_member($task_id);

            if(!empty($team_members)){
                foreach($team_members as $id){
                    $member =array();
                    $member = $this->user_model->getUsersById($id);

                    $data['users'][]=array(
                        'username' => $member[0]->username,
                        'id'       => $member[0]->id
                        );
                }
            }else{
                $data['users'] =array();
            }
            
            $user_id = $this->session->userdata('user_id');
            $data['teams'] = $this->team_model->get_teams($user_id);
            
            $data['main_view'] = 'tasks/edit_task';
            $this->load->view('layouts/main', $data);
        }
        else{
            $user_ids = $this->input->post('task_user');
            $data = array(
                'task_name' => $this->input->post('task_name'),
                'task_body' => $this->input->post('task_body'),
                'due_time' => $this->input->post('due_time')
            );
            if($this->task_model->update_task($user_ids,$task_id,$data)){
              $this->session->set_flashdata('task_updated', 'your task has been updated');  
              redirect('projects/index');
            }
        }
    }
    
    public function delete($project_id,$task_id){
        if($this->task_model->delete_task($task_id)){
            $this->session->set_flashdata('task_deleted','Your task has been deleted.');
        }

        redirect('projects/display/'.$project_id. '');
    }
    
    public function mark_finish($task_id,$status){
            $status_id = ($status == "true") ? 1 : 0;
            $data = array(
                'status' => $status_id
            );
        if($task_id){
            $this->task_model->finish_task($task_id,$data);
        }
    }
    
}
