        <?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative">

                  

                    <div class="page-content-inner">
                          <!-- Datatable -->

                        <div class="table-wrapper" data-simplebar>
                            <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Request Payout</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="#" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Cancel</span>
                                                </a>
                                                <button id="save-button" class="button h-button is-primary is-raised">Request Payout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <table id="" class="table is-datatable is-hoverable table-is-bordered menu_list">
                                <thead>
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
                                        <th><?php echo $role->admin_role_name;?></th>
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
                                        <td><div class="control">
                                            <label class="checkbox">
                                              <input type="checkbox" name="privilege[<?php echo $role->admin_role_id;?>][]" value="<?php echo $menu_title_v[$jd]->privilege_functions_id;?>">
                                              <span></span>
                                            </label>
                                          </div></td>
                                      <?php } ?>
                                    </tr>
                                    <?php   for($k=0;$k<count($menu_module_v1);$k++)
                                            {?>
                                    <tr>
                                        <td><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></td>
                                         <?php foreach($roles as $role){ ?>
                                        <td><div class="control">
                                            <label class="checkbox">
                                             <input type="checkbox" name="privilege[<?php echo $role->admin_role_id;?>][]" value="<?php echo $menu_title_v[$jd]->privilege_functions_id;?>">
                                              <span></span>
                                            </label>
                                          </div></td>
                                       <?php } ?>
                                    </tr>
                                    
                                    <?php } ?>
                                     <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php } ?>
                                <?php } ?>
                                <?php } ?>
                                    
                                </tbody>
                            </table>

                        </div>

                        <div id="paging-first-datatable" class="pagination datatable-pagination">
                            <div class="datatable-info">
                                <span></span>
                            </div>
                        </div>
                    </div>

                <?php $this->load->view('common/footer');?>