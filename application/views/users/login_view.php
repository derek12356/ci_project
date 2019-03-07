
<?php if($this->session->userdata('logged_in')): ?>

   <?php echo form_open('users/logout');?>
     
   <?php if($this->session->userdata('username')): ?>
<p><?php  echo "you are logged in as " . $this->session->userdata('username'); ?></p>
    <?php  endif; ?>
    <?php 
            $data=array('class'=>'btn btn-primary',
                     'name'=>'submit',
                     'value'=> 'Logout');
            echo form_submit($data);
    ?>
    <?php echo form_close();?>
<?php else: ;?> 
<h1>login form</h1>

<?php $attributes = array('id'=>'login_form', 'class'=>'form_horizontal');?>
<?php if($this->session->flashdata('errors')): 
    echo $this->session->flashdata('errors');
    endif;

?>

<?php echo form_open('users/login', $attributes);?>
<div class='form-group'>
    <?php echo form_label('Email');
    $data = array(
        'class' => 'form-control',
        'name' => 'email',
        'placeholder' => 'Enter Email'
    );
    echo form_input($data);
    ?> 
</div>
<div class='form-group'>
    <?php echo form_label('Password');
    $data = array(
        'class' => 'form-control',
        'name' => 'password',
        'placeholder' => 'Enter Password'
    );
    echo form_password($data);
    ?> 
</div>

<div class='form-group'>
    <?php 
    $data = array(
        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => 'submit'
    );
    echo form_submit($data);
    ?> 
</div>
<div class="g-signin2" data-onsuccess="onSignIn"></div>

<?php echo form_close();?>
<?php endif;?>