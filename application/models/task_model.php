<?php
class Task_model extends CI_model{
    
    public function get_task($task_id){
        $this->db->where('id',$task_id);
        $query = $this->db->get('tasks');
        return $query->row();
    }
    
    public function get_team_member($task_id){
        $team_members = [];
        $this->db->where('task_id',$task_id);
        $query = $this->db->get('task_user');
        foreach($query->result() as $result){
            $team_members[] = $result->user_id;
        }
        return $team_members;
    }
    
    public function get_task_project_id($task_id){
        $this->db->where('id',$task_id);
        $query = $this->db->get('tasks');
        return $query->row()->project_id;
    }

    public function get_my_task($user_id){
        $this->db->select('
            task_user.task_id
        ');
        $this->db->from('users');
        $this->db->join('task_user','task_user.user_id = users.id');
        $this->db->where('id',$user_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function create_task($user_ids,$data){
         $this->db->insert('tasks',$data);
         $task_id = $this->db->insert_id();
         foreach($user_ids as $user_id){
             
            $task_user = array(
                    'task_id'=>$task_id,
                    'user_id'=>$user_id  
            );
            $this->db->insert('task_user',$task_user);
         }
        return true;
    }
    
    public function update_task($user_ids,$task_id,$data){
        //update task table 
         $this->db->where('id',$task_id);
         $this->db->update('tasks',$data);
        //update task_user table 
         $this->db->where('task_id',$task_id);
         $this->db->delete('task_user');
         foreach($user_ids as $user_id){
            $task_user = array(
                    'task_id'=>$task_id,
                    'user_id'=>$user_id  
            );

            $this->db->replace('task_user',$task_user); 

         }
        return true;
    }
    
    public function delete_task($task_id){
        $this->db->where('id',$task_id);
        $this->db->delete('tasks');
        $this->db->where('task_id',$task_id);
        $this->db->delete('task_user');
        return true;
   }
    
   public function finish_task($task_id,$data){
       $this->db->where('id',$task_id); 
       $this->db->update('tasks',$data);
   }
}
?>