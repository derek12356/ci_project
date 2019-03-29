<p class='bg-success'>
    <?php if($this->session->flashdata('task_deleted')): 
    echo $this->session->flashdata('task_deleted');
    endif;
    ?>
</p>
<div class="col-xs-9">
    <h1><?php echo $project_data->project_name;?></h1>
    <p>date created: <?php echo $project_data->date_created;?></p>
    <h3>description</h3>
    <p><?php echo $project_data->project_body;?></p>
    <h3>Active Tasks</h3>
    <?php if($incompleted_tasks): ?>
    <ul>
    <?php   foreach($incompleted_tasks as $task):?>
    <li>
    <a href="<?php echo base_url();?>tasks/display/<?php echo $task->task_id?>"><?php echo $task->task_name;?></a>
    </li>
    <?php endforeach;?>
    </ul>
    <?php else:?>
    <p>You don't have active tasks.</p>
    <?php endif;?>
    <h3>Completed Tasks</h3>
    <?php if($completed_tasks): ?>
    <ul>
    <?php   foreach($completed_tasks as $task):?>
    <li>
    <a href="<?php echo base_url();?>tasks/display/<?php echo $task->task_id?>"><?php echo $task->task_name;?></a>
    </li>
    <?php endforeach;?>
    </ul>
    <?php else:?>
    <p>You don't have completed tasks.</p>
    <?php endif;?>
</div>

<div class="col-xs-3 pull-right">
    <ul class='list-group'>
    <h4>Project Actions</h4>
    <li class='list-group-item'><a href="<?php echo base_url();?>tasks/create/<?php echo $project_data->id; ?>">Create Task</a></li>
    <li class='list-group-item'><a href="<?php echo base_url();?>projects/edit/<?php echo $project_data->id; ?>">Edit Project</a></li>
    <li class='list-group-item'><a href="<?php echo base_url();?>projects/delete/<?php echo $project_data->id; ?>">Delete Project</a></li>
</ul>
</div>


