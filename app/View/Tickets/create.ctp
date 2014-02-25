<h1>Create Tickets </h1>
<div id="container">

<?php
 $status= array(1 =>'Open', 2=>'Close',3 =>'Pending');
 $priority= array(1 =>'High', 2=>'Medium',3 =>'Low');
 $issue= array(1=>'Troubleshooting',2=>'Network Failure');
 echo $this->Form->create('Ticket'); 
 echo $this->Form->input('issued-by',array(
      'label'=> 'Issuer ',
        'readonly'=> 'readonly',
        'value' =>$this->Session->read('Users.id')
      ));
 
 echo $this->Form->input('issue',array(
      'label'=> 'Issue','type'=>'select','options'=>$issue
      ));
  echo $this->Form->input('priority',array(
      'label'=> 'Priority','type'=>'select','options'=>$priority
      ));
  echo $this->Form->input('status',array('label'=> 'Status','type'=>'select','options'=>$status
      ));
  echo $this->Form->end('Submit');
?>
</div>
