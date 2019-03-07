<?php 

class User_model extends CI_Model{
    
//    public function get_users($user_id){
//        $this->db->where('id',$user_id);
//        $query = $this->db->get('users');
//    return $query->result();
//    }
//    
//    public function create_user($data){
//        $this->db->insert('users',$data);
//    }
//    
//    public function update_user($data, $id){
//        $this->db->where(['id'=>$id]);
//        $this->db->update('users',$data);
//    }
//    
//    public function delete_user($id){
//        $this->db->where(['id'=>$id]);
//        $this->db->delete('users');
//    }
    public function login_user($email, $password){
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        $db_password = $result->row(3)->password;
        if(password_verify($password,$db_password)){
            return $result->row(0)->id;
        }else{
            return false;
        }
    }
    
    public function create_user(){
        $option = ['cost' => 12];
        $encrypted_pass = password_hash($this->input->post('password'),PASSWORD_DEFAULT,$option);
        $data = array(
                'username'=>$this->input->post('username'),
                'email'=>$this->input->post('email'),
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'password'=>$encrypted_pass
            );
        return $this->db->insert('users',$data);
        
    }
    
    public function create_user_google($user_data){
        $this->db->where('email',$user_data['email']);
        $result = $this->db->get('users');
        array_pop($user_data);
        if($result->num_rows()){ //exist then update user
            $this->db->where(['email'=>$user_data['email']]);
            $this->db->update('users',$user_data);
        }else{                   //create new uuser
            $this->db->insert('users',$user_data);
        }
    }
    
    public function getUserName($email){
        $this->db->where('email',$email);
        $result = $this->db->get('users');

        return $result->row(0)->username;
    }
    
    
    
}
?>