 <!--Sidebar-->
        <div class="main-sidebar is-bordered">
            <div class="sidebar-brand">
                <a href="/">
                    <img class="light-image" src="<?php echo base_url();?>/assets/img/logos/logo/logo.svg" alt="">
                    <img class="dark-image" src="<?php echo base_url();?>/assets/img/logos/logo/logo-light.svg" alt="">
                </a>
            </div>
            <div class="sidebar-inner">

                <div class="naver"></div>

                <ul class="icon-menu">
                    <!-- Activity -->

                    <?php 
                    $CI =& get_instance();
                    $CI->load->model('General_Model');
                    $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');

                    if(!empty($menu_title_v))
                    { 

                    for($jd=0;$jd<count($menu_title_v);$jd++)
                    {


                    ?>
                   
                    <li>
                        <a href="javascript:void(0);" id="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-sidebar-menu" data-content="Components" class="dropdown_menu sidemenu" data-menu="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-sidebar">
                            <i class="sidebar-svg" data-feather="<?php echo strtolower($menu_title_v[$jd]->privilege_icon); ?>"></i>
                        </a>
                    </li> <!-- Messaging -->


                <?php } ?>

                <?php } ?>
                    
                </ul>

              
            </div>
        </div>
        <!--Page body-->


                    <?php 
                    $CI =& get_instance();
                    $CI->load->model('General_Model');
                    $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');

                    if(!empty($menu_title_v))
                    { 

                    for($jd=0;$jd<count($menu_title_v);$jd++)
                    {


                    ?>
                   

            <div id="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-sidebar" class="sidebar-panel is-generic">
            <div class="subpanel-header">
                <h3 class="no-mb"><?php echo ucfirst($menu_title_v[$jd]->privilege_title); ?></h3>
                <div class="panel-close">
                    <i data-feather="x"></i>
                </div>
            </div>
            <div class="inner" data-simplebar>
                <ul>
                     <?php
          $CI =& get_instance();
          $CI->load->model('General_Model');
          $menu_module_v = $CI->General_Model->get_side_bar_menu_v1('privilege_module',$menu_title_v[$jd]->privilege_title);
          //echo $this->db->last_query();exit;

          for($j=0;$j<count($menu_module_v);$j++)
          {
          ?>
          <?php
              // echo $menu_title_v[$j]->privilege_title.'-'.$menu_title_v[$j]->privilege_module;
              $CI =& get_instance();
              $CI->load->model('General_Model');
              $menu_module_v1 = $CI->General_Model->get_side_bar_menu_v1($gdata='',$menu_title_v[$jd]->privilege_title,$menu_module_v[$j]->privilege_module);
              //  echo '<pre/>';
              //print_r($menu_module_v1);
              for($k=0;$k<count($menu_module_v1);$k++)
              {
              ?>
                     <li style="width: 240px;">
                        <a href="<?php echo WEB_URL; ?><?php echo $menu_module_v1[$k]->controller_name; ?>/<?php echo $menu_module_v1[$k]->function_name; ?>"><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></a>
                    </li>

         <?php } ?>
          <?php } ?>
                </ul>

            </div>
        </div>

                <?php } ?>

                <?php } ?>
               