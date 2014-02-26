<?php
 class TicketsController extends AppController{
  
 	
//public $components = array('Email');
public $components =array('EmailManager');
 public function create(){
    $this->loadModel('User');
      $this->loadModel('Profile');
  if($this->request->is('post')){
   $data=$this->request->data;
    $data['Ticket']['assign_to'] = 4;
    $get= $this->User->findById(4);
     $email= $get['User']['email'];
print_r(  $email);
    $data['Ticket']['created_at']= date('Y-m-d H:i:s');
    $data['Ticket']['updated_at']= date('Y-m-d H:i:s');
     $data['Ticket']['issued_by']=$this->Session->read('Users.id');
    if($data['Ticket']['priority']==1 || $data['Ticket']['status']==1){
        $priority='High';
         $status='Open';}
   else if($data['Ticket']['priority']==2 || $data['Ticket']['status']==2){
          $priority='Medium';
 	   $status='Close';}  
    else{
          $priority='Low';
           $status='Pending';}   

    $this->Ticket->create();
    if($this->Ticket->save($data)){
      if( $this->_sendmessage($email,$priority,$status)){
    $this->Session->setFlash('Email sent.');
        $this->redirect(array('action'=>'view',$this->Session->read('Users.id')));  
       }
      else{ $this->Session->setFlash('Email  not sending.'); 
          }
    $this->Session->setFlash(_('Your data is saved.'));
    
   }
   else{
    $this->Session->setFlash(_('Error in saving.'));
   }
  }
 }
 public function view($myArgument){
   $id = $this->requestAction(array('action'=>'create'));
     $data=$this->Ticket->find('all',array('conditions' =>array('Ticket.issued_by' =>$myArgument)));
     $this->set('posts',$data);
 }

 function _sendmessage($email,$priority,$status){
 print_r($priority);
   $m='<html><head><title>Ticket issue</title></head>';
		$ms='<body>You has assign a ticket.<br/>';
		$ms.='Priority:'.$priority.'<br/>';
		$ms.='Status:'.$status.'<br/>';
		$ms.='Please resolve it as soon as possible.</br>';
		$ms.='</body></html>';
                $subject ='Ticket Issue';
  if($this->EmialManager->sendemail($email,$ms,$subject)){
      return true;}
   else 
     return false;
    
 
}
 
}
