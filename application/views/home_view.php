<p class='bg-primary'>
<?php if($this->session->flashdata('login_status')):
    echo $this->session->flashdata('login_status');
    endif;
    if($this->session->flashdata('user_registered')):
    echo $this->session->flashdata('user_registered');
    endif;
    if($this->session->flashdata('register_error')):
    echo $this->session->flashdata('register_error');
    endif;
    
?>
</p>

<p class='bg-danger'>
<?php if($this->session->flashdata('no_access')): 
    echo $this->session->flashdata('no_access');
    endif;
    
?>
</p>


<h1>home view</h1>
