<h1><?php echo $project_name->project_name ; ?></h1>
<table class='table table-bordered'>
   <thead>
    <tr>
        <th>Project Name</th>
        <th>Proejct Description</th>
        <th>Date</th>
        <th>Members</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div><?php echo $tasks->task_name;?></div>
                <a href="<?php echo base_url();?>tasks/edit/<?php echo $tasks->id; ?>">Edit</a>
                <a href="<?php echo base_url();?>tasks/delete/<?php echo $tasks->project_id;?>/<?php echo $tasks->id; ?>">Delete</a>    
            </td>
            <td><?php echo $tasks->task_body;?></td>
            <td><?php echo date('l H:i m-d ',strtotime($tasks->date_created));?></td>
            <td>
                <?php foreach($users as $user): ?>
                <?php echo $user['username'] . ', ';?>
                <?php endforeach;?>
            </td>
        </tr>
    </tbody>
</table>