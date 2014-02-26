<h1>Update Profile</h1>
<div id="container_create">
<?php
  //echo $this->Html->script('countries',array("inline"=>false));

 echo $this->Form->create('Profile', array( 'enctype' => 'multipart/form-data')); 
  echo $this->Form->input('email',array(
      'label'=> 'Email','readOnly' =>'true' ,'value' =>$this->Session->read('Users.email')
      ));
 echo $this->Form->input('first_name',array(
      'label'=> 'First Name',
      ));
  echo $this->Form->input('last_name',array(
      'label'=> 'Last Name',
      ));

echo $this->Form->input('company',array(
      'label'=> 'Company',
      ));
echo $this->Form->input('country',array(
      'label'=> 'Country','type'=>'select','id'=>'country','name'=>'country'
      ));
echo $this->Form->input('state',array(
      'label'=> 'state','type'=>'select','id'=>'state','name'=>'state'
      ));
echo $this->Form->input('zip',array(
      'label'=> 'Zip',
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



 echo $this->Form->input('upload', array('type' => 'file')); 
 echo $this->Form->end('Submit');
?>
</div>



</div>
  <script language="javascript">
            populateCountries("country", "state");
           
        </script>
