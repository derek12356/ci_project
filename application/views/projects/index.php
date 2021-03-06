<h1>Projects</h1>
<p class='bg-success'>
    <?php if($this->session->flashdata('project_created')): 
    echo $this->session->flashdata('project_created');
    endif;
    ?>
    <?php if($this->session->flashdata('project_updated')): 
    echo $this->session->flashdata('project_updated');
    endif;
    ?>
    <?php if($this->session->flashdata('project_deleted')): 
    echo $this->session->flashdata('project_deleted');
    endif;
    ?>
    <?php if($this->session->flashdata('task_created')): 
    echo $this->session->flashdata('task_created');
    endif;
    ?>
    <?php if($this->session->flashdata('task_updated')): 
    echo $this->session->flashdata('task_updated');
    endif;
    ?>
</p>
    <a class='btn btn-primary pull-right' href="<?php echo base_url();?>projects/create">create project</a>
<table class="table table-hover">

    <thead>
        <tr>
            <th>Project Name</th>
            <th>Project Body</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
       
        <?php foreach($projects as $project): ;?>
        <tr>
        <?php echo "<td><a href='".base_url(). "projects/display/" . $project->id . "'>" . $project->project_name . "</a></td>"; ?>
        <?php echo "<td>" . $project->project_body . "</td>"; ?>
            <td><a class='btn btn-danger' href="<?php echo base_url();?>projects/delete/<?php echo $project->id;?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>