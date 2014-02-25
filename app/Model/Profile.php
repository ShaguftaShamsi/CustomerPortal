<?php
class Profile extends  AppModel{


  public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );


public $validate =array(
 'first_name' =>array(
       'nonempty' =>array(
                'rule'=>'notEmpty',
                'message'=>'This field cannot be left blank.',
        ),
        'pattern'=>array(
		 'rule'=>'/^[A-Za-z]+/i',
		 'message'=>'Only letters allowed',
         ),
   ),
  'last_name' =>array(
      'nonempty' =>array(
                'rule'=>'notEmpty',
                'message'=>'This field cannot be left blank.',
        ),
        'pattern'=>array(
		 'rule'=>'/^[A-Za-z]+/i',
		 'message'=>'Only letters allowed',
         ),
   ),
  'company' => array(
      'rule'=>'notEmpty'),

   'position' =>array(
        'nonempty' =>array(
                'rule'=>'notEmpty',
                'message'=>'This field cannot be left blank.',
        ),
        'pattern'=>array(
		 'rule'=>'/^[A-Za-z]+/i',
		 'message'=>'Only letters allowed',
         ),
   ),
  
   'address'=>array(
      'rule'=>'notEmpty'),
   'location'=>array(
       'rule'=>'notEmpty'),
   'country'=>array(
      'rule'=>'notEmpty'),
   'city'=>array(
       'rule'=>'notEmpty'),
    'zip' => array(
    'rule' => array('between', 5,10),
     'message' => 'Zip code must have at least 5 numbers.'),
  );



}





