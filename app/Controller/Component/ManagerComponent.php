<?php

App::uses('Component','Controller');

class ManagerComponent extends Component {
   
   public $components =array('Session','Cookie');
     public function checkSession(){
     if($this->Session->check('Users')){
      return true;
     }
     else {
      $result=$this->isCookie();
        //print_r('is_cookie');
       // print_r($result);
        return $result;
         }

    }
   public function create($post){
      print_r($post);
       $this->Session->write('Users',array('email' =>$post['User']['email'],'id'=>$post['User']['id']));
       return true;
 }
   public function destroy(){
  if($this->Cookie->read('users_cookie.email') && $this->Cookie->read('users_cookie.id')  &&  $this->Cookie->read('users_cookie.password')){
			$this->Cookie->delete('users_cookie.email');
			$this->Cookie->delete('users_cookie.id');
                        $this->Cookie->delete('users_cookie.password');
			$this->Cookie->destroy();
		}
		$this->Session->delete('Users');
		$this->Session->destroy();
               
/*
   if($this->Session->destroy('Users')){
   $this->Session->setFlash('Your Session Expired');
   return true;}
   else 
   return false; */
 }
   public function read(){
     $data =$this->Session->read('Users');
        // print_r($data);
       return $data;
 }
 
 public function readCookie(){
   $data= $this->Cookie->read('users_cookie');
     if($data){ 
 print_r($data);
    return $data;
 }
 }

  public function isCookie(){
   $email = $this->Cookie->read('users_cookie.email');
     $id = $this->Cookie->read('users_cookie.id');
       $data= $this->Cookie->read('users_cookie');
  //if($data ){
 //print_r('WOrld');
 //}
 //print_r('hello');
     //  print_r($email);
     //   print_r($id);
 //print_r('Readind whole cookie');
 //print_r($data);
 //print_r('ENding wholw cookie');
   if( $email != '' && $id != ''){
      $send = array('Users'=>array('email'=>$email,'id'=>$id));  
       $resutl = $this->create($send);
         

       return $result;
      }
  }  

}

