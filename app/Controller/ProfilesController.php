<?php
 class ProfilesController extends AppController{
  public $components =array('Manager');
 public  $helper = array('CountryList','Form','Html');
  public function index(){
     if($this->Manager->checkSession()){
        $this->set('background', '/img/controller_x_background.jpg');
          $readCookie = $this->Manager->readCookie();
 	 //  if($readCookie)
            //   {
            //print_r('reading cookie');
             // print_r($readCookie);
          // }
      $data =$this->Manager->read();
// print_r($data);
      if($data){
       $this->set('posts',$data); 
        }
      }
 else {
     $this->redirect(array('controller'=>'users','action'=>'index'));
   }
  }
  public function update(){
   //$this->loadModel('User');
     if($this->Manager->checkSession()){
   if($this->request->is('post')){

       if(!empty($this->data['Profile']['upload']['name']))
                {
                        $file = $this->data['Profile']['upload']; //put the data into a var for easy use
                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'upload/' . $file['name']);
                                //prepare the filename for database entry
                                //$this->data['Profile']['image'] = $file['name'];
								                $data['Profile']['image'] ='upload/'. $file['name'];
								                //print_r( $data['Profile']['image']);
                        }
                }
   
    $data =$this->request->data;
$data['Profile']['image']='upload/'. $this->data['Profile']['upload']['name'];
//$data['Profile']['id'] =$this->Session->read('Users.id');
      $profiles =$this->Profile->findByUserId($this->Session->read('Users.id'));
      print_r($profiles);
    if($profiles['Profile']['user_id'] == $this->Session->read('Users.id') ||  $profiles == ''){
     print_r('hello');
      print_r($profiles['Profile']['user_id'] );
     $data['Profile']['user_id'] = $this->Session->read('Users.id');
     $data['Profile']['created_at']=date('Y-m-d H:i:s');
     $data['Profile']['updated_at']=date('Y-m-d H:i:s');
          if($profiles['Profile']['id'] != ''){
               print_r('profile id');
               print_r($profiles['Profile']['id']);
             $this->Profile->id = $profiles['Profile']['id'];
             $data['Profile']['created_at']=$profiles['Profile']['created_at'] ;
             }
          // /$this->Profile->id = $this->Session->read('Users.id');
       // $this->User->set($this->request->data);
       //  if ($this->User->validates()){
              print_r('Data display');
              print_r($data);
         if($this->Profile->save($data)){
          print_r('save in id');
          print_r($this->Profile->id);
          $data1=$this->Profile->id;
        }
        // print_r($data1);
      $this->redirect(array('action'=>'view',$data1));
        // }
       }

           else 
          $this->Session->setFlash(_('Error.'));
     
            if(!$this->request->data) {
            $profile = $this->Profile->findByUserId($this->Session->read('Users.id'));
            $this->request->data = $profile;
             }
  }
}
   else {
     $this->redirect(array('controller'=>'users','action'=>'index'));
   }
 }

 public function view($myArgument = null){
     
     $id = $this->requestAction(array('action'=>'update'));
     $data=$this->Profile->findById($myArgument);
     //print_r($data);
     $this->set('posts',$data);
   
}
}
?>
