<?php
class Team_model extends CI_model{
    
    public function get_teams($user_id){
        $this->db->where('team_user_id',$user_id);
        $query = $this->db->get('teams');
        return $query->result();
    }
    
    public function get_team($id){
        $this->db->where('id',$id);
        $query = $this->db->get('teams');
        return $query->row();
    }
    
    public function get_project($id){
        $this->db->where(['id'=>$id]);
        $query = $this->db->get('projects');
        return $query->row();
    }
    
    public function create_team($data){
        $insert_query = $this->db->insert('teams',$data);
        return $insert_query;
    }
    
    public function update_team($id, $data){
        $this->db->where(['id'=>$id]);
        $this->db->update('teams',$data);
        return true;
    }
    
    public function delete_team($id){
        $this->db->where(['id'=>$id]);
        $this->db->delete('teams');
        $this->db->where('team_id',$id);
        $this->db->delete('team_user');
        return true;
    }
    
    public function get_team_user($user_id){
        $teams = array();
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('team_user');
        foreach($query->result() as $result){
            $teams[] = $result->team_id;
        }
        return $teams;
    }
    
    public function get_member_by_team_id($id){
        $this->db->where('team_id',$id);
        $query = $this->db->get('team_user');
        $users = array();
        foreach($query->result() as $team){
            $this->db->where('id',$team->user_id);
            $q = $this->db->get('users');
            $users[] = $q->row()->username;
        }
        return $users;
    }
    
    public function getTeamsById($id){
        $this->db->where('id',$id);
        $query = $this->db->get('teams');
        return $query->result();
    }
    
    public function getTeamByName($name){
        $this->db->like('name',$name);
        $query = $this->db->get('teams');
        return $query->result();
    }
    
    public function update_team_user($team_ids,$user_id){

        //update team_user table 
         $this->db->where('user_id',$user_id);
         $this->db->delete('team_user');
         foreach($team_ids as $team_id){
            $team_user = array(
                    'team_id'=>$team_id,
                    'user_id'=>$user_id  
            );

          $this->db->replace('team_user',$team_user); 

         }
        return true;
    }
    
}





?>