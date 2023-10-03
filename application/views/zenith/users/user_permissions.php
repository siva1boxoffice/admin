        <?php $this->load->view(THEME.'common/header');?>

        <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
 <form id="profile-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>home/users/save_permission">
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center">
                     <h3 class="mb-1">Set User Permission</h3>
                     <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                        <a href="<?php echo base_url();?>home/index"  class="btn btn-primary mb-2">Back</a>
                        <button  class="btn btn-success mb-2 ml-2">Save Changes</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="basic-datatable" class="table  table-hover table-nowrap mb-0 tick_deliver table-bordered user_permission">
                             <thead class="thead-light">
                                    <tr>
                                        <th>Sub Menu
                                            <!-- <div class="control">
                                                <label class="checkbox is-primary is-outlined is-circle">
                                                    <input type="checkbox">
                                                    <span></span>
                                                </label>
                                            </div> -->
                                        </th>
                                        <?php foreach($roles as $role){ ?>
                                        <th><?php echo  str_replace(" ", "<br>",  ucwords(strtolower($role->admin_role_name)));?></th>
                                        <?php } ?>
                                        
                                    </tr>
                                </thead>
                              <tbody>
                                   <?php


                                            $CI =& get_instance();
                                            $CI->load->model('General_Model');
                                            $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');

                                            if(!empty($menu_title_v))
                                            { 

                                            for($jd=0;$jd<count($menu_title_v);$jd++)
                                            {

                                            $CI =& get_instance();
                                            $CI->load->model('General_Model');
                                            $menu_module_v = $CI->General_Model->get_side_bar_menu_v1('privilege_module',$menu_title_v[$jd]->privilege_title);
                                            //echo $this->db->last_query();exit;

                                            for($j=0;$j<count($menu_module_v);$j++)
                                            {
                                            ?>
                                            <?php

                                            $CI =& get_instance();
                                            $CI->load->model('General_Model');
                                            $menu_module_v1 = $CI->General_Model->get_side_bar_menu_v1($gdata='',$menu_title_v[$jd]->privilege_title,$menu_module_v[$j]->privilege_module);


                                            ?>
                                    
      
                                    
                                    <tr>
                                        <td><span class="has-dark-text dark-inverted is-font-alt is-weight-600 rem-90"><?php echo ucfirst($menu_title_v[$jd]->privilege_title); ?></span></td>
                                       <?php foreach($roles as $role){ ?>
                                        <td>
                                           <!--  <div class="control">
                                            <label class="checkbox">
                                              <input type="checkbox" name="privilege[<?php echo $role->admin_role_id;?>][]" value="<?php echo $menu_title_v[$jd]->privilege_functions_id;?>">
                                              <span></span>
                                            </label>
                                          </div> -->
                                      </td>
                                      <?php } ?>
                                    </tr>
                                    <?php   for($k=0;$k<count($menu_module_v1);$k++)
                                            {?>
                                    <tr>
                                        <td><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></td>
                                         <?php foreach($roles as $rkey => $role){ ?>
                                        <td>
                                                <?php 
                                                //echo "<pre>";print_r($role->admin_role_id);
                                               // echo "<pre>";print_r($active_functions[$role->admin_role_id]);
                                                $checked = '';
                                                if(count($active_functions[$role->admin_role_id]) > 0){ 
                                                if (in_array($menu_module_v1[$k]->privilege_functions_id, $active_functions[$role->admin_role_id])) {
                                                $checked = 'checked="checked"';
                                                }
                                                }
                                                 ?>
                                                 <div class="form-check">
                                      
                                                  <input class="form-check-input" type="checkbox" id="flexCheckDefault<?php echo $menu_module_v1[$k]->privilege_functions_id;?>" name="privilege[<?php echo $role->admin_role_id;?>][]" value="<?php echo $menu_module_v1[$k]->privilege_functions_id;?>" <?php echo $checked;?> >
                                         <label class="form-check-label" for="flexCheckDefault<?php echo $menu_module_v1[$k]->privilege_functions_id;?>" >
                                         </label></div>

                                          </td>
                                       <?php } ?>
                                    </tr>
                                    
                                    <?php } ?>
                                  
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                    
                              </tbody>
                           </table>
                        </div>


                  
                       </div>
                     </div>                 
                  </div>
               </div>
            </div>
        </form>
         </div>
      </div>
      <!-- main content End -->
                <?php $this->load->view(THEME.'common/footer');?>
                <?php exit;?>