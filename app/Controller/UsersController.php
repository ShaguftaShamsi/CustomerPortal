<?php

//App::uses('AppController','Controller');

class UsersController extends AppController{
  
  public $components =array('Manager','EmailManager','Cookie');
  public $helper = array('Session');
  
  public function index(){
       if(!$this->Manager->checkSession()){
         $this->User->set($this->request->data);
     
     if($this->request->is('post')){
     $this->User->set($this->request->data);
     
      if(!$this->User->validates(array('fieldList' => array('email')))) {
      $errors = $this->User->validationErrors;
       //print_r($errors);
          }
          else 
         $this->Session->write('temp.email',$this->data['User']['email']);  
      $post =$this->User->findByEmail($this->request->data['User']['email']); 
       if(!empty($post)){
              
         //print_r($post);
          if($post['User']['is_invited'] == 1){
             $this->User->id = $post['User']['id'];
             $this->User->saveField('is_invited', 0);
             $this->redirect(array('action'=>'newPassword',$post['User']['id'],$post['User']['salt']));
            }
          if($this->data['User']['checked'] ==1){
             $this->Cookie->write('users_cookie',array('email'=>$this->request->data['User']['email'],'password'=>$this->request->data['User']  ['password'],'id' =>$post['User']['id']),false,3600);
                 $readCookie = $this->Manager->readCookie();
                 if($readCookie)
               {
            print_r('reading cookie in remember');
              print_r($readCookie);
           }

            }  
         $data=$this->request->data['User']['password'];
       //print_r($data);
         $data =$this->_hasHasedPass($post,$data);
         if($data){
         if($this->Manager->create($post)){
             $data =$this->Manager->read();
   
           $this->redirect(array('controller'=>'profiles','action' => 'index'));
           }
    }
          else{
            
          $this->Session->setFlash('Incorrect Password');
          }
         }
    else {
         $this->Session->setFlash('Incorrect Email');
        
     }
    }
  else{
       
      // $this->Session->setFlash('Enter email/password');
   }
  }
  else {$this->redirect(array('controller'=>'profiles','action'=>'index'));
 //$this->set('myCookie',$this->Cookie->read('users_cookie'));
       }
   
  }
  function captcha()  {
    $this->autoRender = false;
     //print_r('hell');
    $this->layout='ajax';
    if(!isset($this->Captcha))  { //if Component was not loaded throug $components array()
      $this->Captcha = $this->Components->load('Captcha', array(
        'width' => 500,
        'height' =>900,
        'theme' => 'default', //possible values : default, random ; No value means 'default'
      )); //load it
      }
    $this->Captcha->create();
  }
  

  public function forgetPassword(){
      //$email=$this->Session->read('tempEmail.email');
		//print_r($email);
    if(!($this->Manager->read())){
	   // $email=$this->Session->read('tempEmail.email');
		//print_r($email);
       //print_r('hel');
     if($this->Session->check('temp.email')){
         $email=$this->Session->read('temp.email');
         $result =$this->User->findByEmail($email);  
         if($this->request->is('post')){
         if(!empty($result)){
           //print_r('World');
           $id=$result['User']['id'];
           $hashToken=sha1(date('mdy').rand(30000,39999));
           $this->_sendMessage($email,$hashToken); 
           $this->User->id = $id;
            if($this->User->saveField('reset_pass_token',$hashToken)){
               $this->Session->setFlash('Email is  sent to you ');
              }
            else{
              //print_r('leave');
             $this->Session->setFlash('Something went wrong.Please try again.');
              }

            }
            else{
          //print_r('level claer');
          $this->Session->setFlash('Email is not registred');
         } 
           }
         
    }
   }
 }
 
  public function resetPassword($hash){
     if(!($this->Manager->read())){
     $reset_token=$this->User->findByResetPassToken($hash);
      if(!empty($reset_token)){
       $id = $reset_token['User']['id'];
       $salt= $reset_token['User']['salt'];
       $this->User->id= $id;
       $this->User->saveField('reset_pass_token','');
       $this->Session->write('resetId',$reset_token['User']['id']);
       $this->Session->write('resetEmail',$reset_token['User']['email']);
       $this->redirect(array('action' => 'newPassword',$id,$salt));
      }else{
        $this->redirect(array('action' => 'index'));
       }   
     }else{
       $this->redirect(array('action' => 'index'));
      }     
}
 

public function newPassword($id,$salt){
     if($temp != null){
          $this->set('heading','Create an account');
     
          }
          else {
              $this->set('heading','Reset Password'); 
             }
    if (!($this->Manager->checkSession()) && ($this->Session->check('resetId'))){     
    //$id = $this->requestAction(array('action'=>'login'));
        print_r('hello+++');
   print_r($id);
      print_r('hell++++');
    $data =$this->Manager->read();
    if(($this->request->is('post'))){
       if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
           $this->User->set($this->request->data);
            if ($this->User->validates(array('password','email'))) {
            $salt_pass = $salt.''.$this->request->data['User']['password'];
             // print_r($salt_pass );
            $hash =sha1($salt_pass);
           
$data = array(
           'User' => array(
                        'id'          =>    $id,
                        'hash'   =>    $hash,
                         'updated_at' =>  date('Y-m-d H:i:s')
           )
        );

$this->User->save( $data, array('hash','updated_at') );
         $post =array('User'=>array('id'=>$id,'email'=>$this->request->data['User']['email'])); 
             //print_r($post);
                  if($this->Manager->create($post)){
                   //print_r($post);
                  $this->redirect(array('controller'=>'profiles','action' => 'index'));
                     }
            //}
          }
          else{
               $errors = $this->User->validationErrors;
                }
         
     }
   else{
      $this->Session->setFlash('Re-type password');
   }
 
}
}
}
     function _sendMessage($email,$hash){
     $baseUrl =$_SERVER['SERVER_NAME'] .$this->webroot;
		$subject = "Password Reset Request";
       	        $ms='<html><head><title>Password Reset Request</title></head>';
		$ms='<body>Your email has been used in a password reset request.<br/>';
		$ms.='If you did not initiate this request, then ignore this message.<br/>';
		$ms.='  Copy the link below into your browser to reset your password.<br/>';
		$ms.='<a href ="'.$baseUrl.'/users/resetPassword/'.$hash.'">'.$baseUrl.'users/resetPassword/'.$hash.'</a>.<br/>';
                //$ms.='<a href="'$baseUrl.'users/resetPassword/'.$hash'">'Click here'</a>.<br/>';
		$ms.='</body></html>';
                $ms=wordwrap($ms,70);
		$this->EmailManager->sendEmail($email,$ms,$subject);
 }

    
  public function invite(){
 if($this->request->is('post')){
    $data = $this->request->data;
       
   if(!empty($data))
            print_r($data);
    $result=$this->User->findByEmail($data['Invite']['email']);
      if($result)
       {  throw new NotFoundException(__('Email alredy exits  ')); 
            
          }
     else {
          $hashed=sha1('59005827252f06d1e50ed19.56152728Xyz123@456');
          $password='Xyz123@456';
         $data['User']['email'] = $data['Invite']['email'];
         $data['User']['is_invited'] = $this->Session->read('Users.id');
         $data['User']['salt'] = '59005827252f06d1e50ed19.56152728';
         $data['User']['hash'] =$hashed;
         $data['User']['created_at']=date('Y-m-d H:i:s');
         $data['User']['updated_at']=date('Y-m-d H:i:s');
	  $last = $this->User->getInsertID();
	print_r($last);
         print_r('$last');
	$first=$this->User->getLastInsertID();
         print_r($first);
         $this->User->create();
         if($this->User->save($data)){
        $this->_sendinvitation($data['User']['email'],$password);
              print_r('hello world');
               $id=$this->User->getLastInsertId();
             print_r($id);
              print_r($data);
              //$this->redirect(array('controller'=>'profiles','action'=>'index'));
               $email = $data['Invite']['email'];
               $status = 'Pending';
              $this->set(compact('email','status'));
          }
 
        
      }
 } 
}
   function _sendinvitation($email,$password){
    $baseUrl =$_SERVER['SERVER_NAME'] .$this->webroot;
       //print_r($baseUrl);
          print_r($email);
		$subject = "Invitation";
       	        $ms='<html><head><title>Invitation</title></head>';
		$ms='<body>You have been invited in a customer portal by'.$this->Session->read('User.email'). '.<br/>';
		$ms.='If you did not initiate this request, then ignore this message.<br/>';
		$ms.='  Copy the link below into your browser .<br/>';
                $ms.='Email:' .$email.'.<br/>';
                $ms.='Password:' .$password.'.<br/>';
                $ms.= '<a href="'.$baseUrl.'/users/login/">'.$baseUrl.'/users/login/</a>.</br>';
		$ms.='</body></html>';
                $ms=wordwrap($ms,70);
             $this->EmailManager->sendEmail($email,$ms,$subject);
 }
   
public function register(){
   if($this->request->is('post')){

                if(!empty($this->request->data))  {
      if(!isset($this->Captcha))  { //if Component was not loaded throug $components array()
        $this->Captcha = $this->Components->load('Captcha'); //load it
      }
      $this->User->setCaptcha($this->Captcha->getVerCode()); //getting from component and passing to model to make proper validation check
      $this->User->set($this->request->data);
      if($this->User->validates(array('captcha')))  { //as usual data save call
        //$this->Signup->save($this->request->data);//save or something
         // validation passed, do something
            
       $users =$this->User->findByEmail($this->request->data['User']['email']);
                    print_r($users);
        if( empty($users)  || $users['User']['email'] != $this->data['User']['email']  ){
           if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
           $this->User->set($this->request->data);
                  if($this->User->validates(array('password'))){
             $this->request->data['User']['created-at'] =date('Y-m-d H:i:s');
             $this->request->data['User']['updated-at'] =date('Y-m-d H:i:s');
                      $this->request->data['User']['salt'] = '59005827252f06d1e50ed19.56152728';
             $salt_pass = $this->request->data['User']['salt'].''.$this->request->data['User']['password'];
                       $hash =sha1($salt_pass);
               $this->request->data['User']['hash']=$hash;
                          $this->User->create();
                            if($this->User->save($this->request->data)){
                 $this->Profile->id=$this->User->getLastInsertId();
                  $data['Profile']['first_name'] =$this->request->data['User']['first_name'];
                 $data['Profile']['id']=$this->User->getLastInsertId();
                 $data['Profile']['user_id']=$this->User->getLastInsertId();
                  $this->User->Profile->create();
                 $this->User->Profile->save($data);
                  $post =array('User'=>array('id'=>$this->User->getLastInsertId(),'email'=>$this->request->data['User']['email']));
                if($this->Manager->create($post)){
                                          //print_r($post);
                                      $this->redirect(array('controller'=>'profiles','action' => 'index'));
                                    }
          }else{$this->Session->setFlash('Data is not save' );}
           }
          else{$this->Session->setFlash(' Password not validate' );
          }
           }
         else{  $this->Session->setFlash('Re-type password' );
          }
        }else {
        $this->Session->setFlash('Email is already taken ' );
      }
      }
       //$this->Session->setFlash('Data Validation Success');      
      }

 
       else  { //or
        $this->Session->setFlash('Data Validation Failure');
        //pr($this->Signup->validationErrors);
        //something do something else
      }
    }

}
 function _hasHasedPass($post,$data){
    
///print_r($post);
//print_r($data);
  if($post){
   $salt=$post['User']['salt'];
   $hash=$post['User']['hash']; 
    $hash_pass = $salt.''.$data;
    $hash_pass1 =sha1($hash_pass);
 //print_r($hash_pass);
//print_r($hash_pass1);
//print_r($hash);

    if($hash == $hash_pass1)
     {
      return true; 
     }
    else return false;
  }
  
}
  public function logout(){
 
   $this->Manager->destroy();
   $this->redirect(array('action' => 'index'));
 }
}
