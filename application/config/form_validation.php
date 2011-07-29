<?
$config = array(
                 'achievement' => array(
						               array(
						                     'field'   => 'name',
						                     'label'   => 'name',
						                     'rules'   => 'required|min_length[4]|max_length[50]'
						                  ),
						               array(
						                     'field'   => 'category',
						                     'label'   => 'category',
						                     'rules'   => 'required|min_length[1]|max_length[4]|callback_category_check'
						                  ),
						               array(
						                     'field'   => 'badgePic',
						                     'label'   => 'badgePic',
						                     'rules'   => 'required'
						                  ),                  
						               array(
						                     'field'   => 'description',
						                     'label'   => 'description',
						                     'rules'   => 'required'
						                  )
					            ),
                 'email' => array(
                                    array(
                                            'field' => 'emailaddress',
                                            'label' => 'EmailAddress',
                                            'rules' => 'required|valid_email'
                                         ),
                                    array(
                                            'field' => 'name',
                                            'label' => 'Name',
                                            'rules' => 'required|alpha'
                                         ),
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'required'
                                         ),
                                    array(
                                            'field' => 'message',
                                            'label' => 'MessageBody',
                                            'rules' => 'required'
                                         )
                                    )                          
               );
?>