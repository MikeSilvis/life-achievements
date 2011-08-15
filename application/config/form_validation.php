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
						                     'field'   => 'description',
						                     'label'   => 'description',
						                     'rules'   => 'required'
						                  )
					            ),
                 'manage' => array(
						               array(
						                     'field'   => 'location',
						                     'label'   => 'location',
						                     'rules'   => 'required|min_length[4]|max_length[50]'
						                  ),
						               array(
						                     'field'   => 'name',
						                     'label'   => 'name',
						                     'rules'   => 'required|min_length[4]|max_length[250]'
						                  ),						                  
						               array(
						                     'field'   => 'date_completed',
						                     'label'   => 'date_completed',
						                     'rules'   => 'required|min_length[9]|max_length[10]'
						                  ),
						               array(
						                     'field'   => 'description',
						                     'label'   => 'description',
						                     'rules'   => 'required|min_length[10]|max_length[3000]'
						                  ),
                                    )                          
               );
?>