<h1>Create User Profile</h1>
<div id="container_create">

<?php

 echo $this->Form->create('Profile', array( 'enctype' => 'multipart/form-data')); 
 echo $this->Form->input('first_name',array(
      'label'=> 'First Name',
      ));
  echo $this->Form->input('last_name',array(
      'label'=> 'Last Name',
      ));
echo $this->Form->input('company',array(
      'label'=> 'Company',
      ));
echo $this->Form->input('position',array(
      'label'=> 'Department',
      ));
echo $this->Form->input('location',array(
      'label'=> 'Location',
      ));
echo $this->Form->input('address',array(
      'label'=> 'Address',
      ));
echo $this->Form->input('birthday',array(
      'label'=> 'Date of birth',
       'dateFormat' =>'DMY',
      ));
 echo $this->Form->input('upload', array('type' => 'file')); 
 echo $this->Form->end('Submit');
?>
</div>
