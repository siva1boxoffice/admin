<?php 
$CI=& get_instance();
$CI->load->model('General_Model');
$notify_orders = $CI->General_Model->getOrderData_v1('notify')->result();
//echo "<pre>";print_r($app);?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags  -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="noindex,nofollow">
   <title> <?php echo $app['app_title'];?> :: Welcome</title>
  <!--   <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.ico" /> -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favicon.ico"/>
    <!--Core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css?v=1.2.4" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css?v=1.3.5" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css?v=3.4.4.6" />
     <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/seller.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css?v=4.3.4.5" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css?v=1.4" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css?v=1.1"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css?v=1.4">
      <?php if($this->session->userdata('role') == 1){ ?>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/seller.css?v=1.4" />
        <?php } ?>
      <style type="text/css">
        <?php if($this->session->userdata('role') == 1){ ?>
        /*.webapp-navbar .webapp-navbar-inner .center .centered-links{max-width: 65%;}*/
        
        <?php } ?>
      </style>
    <!--Mapbox styles-->
</head>

<body>
    <div id="huro-app" class="app-wrapper">
        <div class="app-overlay"></div>

        <!--Full pageloader-->
        <!-- Pageloader -->
       <!--  <div class="pageloader is-full"></div>
        <div class="infraloader is-full is-active"></div> -->
        <!--Mobile navbar-->
        <nav class="navbar mobapp-navbar  mobile-navbar no-shadow is-hidden-desktop is-hidden-tablet mobile_device_widd" aria-label="main navigation">
            <div class="container_new ">
                <!-- Brand -->
                <div class="navbar-brand mobapp-navbar-inner">
                    <!-- Mobile menu toggler icon -->
                    <div class="left">
                        <div class="brand-start">
                            <div class="navbar-burger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <a class="navbar-item is-brand" href="<?php echo base_url();?>">
                            <img class="light-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="">
                            <img class="dark-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
      
         <?php if($this->session->userdata('role') != 1){ ?>
         <div class="mobile-main-sidebar  mobile-subsidebar">
            <div class="inner">

                <ul class="submenu" data-simplebar>
                     <?php 
                    $CI =& get_instance();
                    $CI->load->model('General_Model');
                    $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');
                   // echo "<pre>";print_r($menu_title_v);exit;
                    if(!empty($menu_title_v))
                    { 

                    for($jd=0;$jd<count($menu_title_v);$jd++)
                    {
                        $active = '';
                        if(strtolower($menu_title_v[$jd]->controller_name) == strtolower($this->uri->segment(1))){ 
                            $active = "is-active"; 
                    }
                    ?>

                    <li class="has-children">
                        <div class="collapse-wrap">
                            <i data-feather="<?php echo strtolower($menu_title_v[$jd]->privilege_icon); ?>"></i>&nbsp;
                            <a href="javascript:void(0);" class="parent-link"><?php echo strtolower($menu_title_v[$jd]->privilege_title);?>
                            <i data-feather="chevron-right"></i></a>
                        </div>
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

                                            $CI =& get_instance();
                                            $CI->load->model('General_Model');
                                            $menu_module_v1 = $CI->General_Model->get_side_bar_menu_v1($gdata='',$menu_title_v[$jd]->privilege_title,$menu_module_v[$j]->privilege_module);


                                            ?>
                                    
                                     <?php
                                            for($k=0;$k<count($menu_module_v1);$k++)
                                            {?>
                          
                            <li>
                                                <?php if($menu_module_v1[$k]->param_name == ''){ ?>
                                                <a class="is-submenu" href="<?php echo base_url();?><?php echo $menu_module_v1[$k]->controller_name;?>/<?php echo $menu_module_v1[$k]->function_name;?>">
                                                    <span><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="is-submenu" href="<?php echo base_url();?><?php echo $menu_module_v1[$k]->controller_name;?>/<?php echo $menu_module_v1[$k]->function_name;?>/<?php echo $menu_module_v1[$k]->param_name;?>">
                                                    <span><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></span>
                                                </a>
                                            <?php } ?>
                                            </li>

                        <?php } }?>
                            
                        </ul>
                    </li>
                   
                    
                    <li class="divider"></li>
                  <?php } }?>
                    
                </ul>
            </div>
        </div>
       
        <!--Webapp navbar regular-->
        <div class="webapp-navbar head_title">
            <div class="webapp-navbar-inner">
                <div class="left">
                    <a href="<?php echo base_url();?>" class="brand">
                        <img class="light-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="" />
                        <img class="dark-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="" />
                    </a>
                    <div class="separator"></div>
                    <?php if($this->session->userdata('role') == 6){ ?>
                    <div class="dropdown project-dropdown dropdown-trigger is-spaced">
                        <div class="h-avatar is-small">
                            <span class="avatar is-fake is-h-green">
                              <span title="<?php

                               echo $this->session->userdata('storefront')->company_name;?>"><?php

                               echo substr($this->session->userdata('storefront')->company_name, 0, 1);?></span>
                            </span>
                        </div>
                         <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <?php foreach($app['branches'] as $branch){
                                if($branch->admin_role_id == 4){
                                 ?>
                                <div class="dropdown-block" onclick="set_storefront('<?php echo $branch->admin_id;?>');">
                                    <div class="h-avatar is-small">
                                        <span class="avatar is-fake is-warning">
                                          <span><?php echo substr($branch->company_name,0,1);?></span>
                                        </span>
                                    </div>
                                    <div class="meta">
                                        <span class="dark-inverted"><?php echo $branch->company_name;?></span>
                                        <span><?php echo $branch->admin_name;?> <?php echo $branch->admin_last_name;?></span>
                                    </div>
                                </div>
                            <?php }} ?>
                            </div>
                        </div>
                    </div> 
                <?php } ?>
                <?php if($this->session->userdata('role') == 6){ ?>
                    <h1 id="" class="title is-5">
                        <?php echo $this->session->userdata('storefront')->company_name; ?></h1>
                <?php } ?>
                <?php if($this->session->userdata('role') == 1){ ?>
                    <h1 id="" class="title is-5">
                        Seller Dashboard</h1>
                <?php } ?>
                </div>
                <div class="center">
                    <div id="webapp-navbar-menu" class="centered-links">

                        <?php 
                    $CI =& get_instance();
                    $CI->load->model('General_Model');
                    $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');

                    if(!empty($menu_title_v))
                    { 

                    for($jd=0;$jd<count($menu_title_v);$jd++)
                    {
                        $active = '';
                        if(strtolower($menu_title_v[$jd]->controller_name) == strtolower($this->uri->segment(1))){ 
                            $active = "is-active"; 
                    }
                    ?>

                        <a id="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-navbar-menu" class="centered-link centered-link-toggle <?php echo $active; ?>" data-id="<?php echo $active; ?>" data-menu-id="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-webapp-menu">
                            <i data-feather="<?php echo strtolower($menu_title_v[$jd]->privilege_icon); ?>"></i>
                           <!-- <i class="fa <?php echo strtolower($menu_title_v[$jd]->privilege_icon); ?>"></i> -->
                            <span id="<?php echo strtolower($menu_title_v[$jd]->controller_name);?>" test="<?php echo strtolower($this->uri->segment(1));?>" ><?php echo strtolower($menu_title_v[$jd]->privilege_title);?></span>
                        </a>
                        <?php } ?>

                <?php } ?>
                    </div>

                </div>
                <div class="right">
                    <div class="toolbar ml-auto">
                        <a class="toolbar-link right-panel-trigger" data-panel="languages-panel">
                            <img src="<?php echo base_url();?>assets/img/icons/flags/<?php echo $this->session->userdata('language_code');?>.svg" alt="">
                        </a>
                        <?php if($this->session->userdata('role') != 9 && $this->session->userdata('role') != 7){?>
                        <div class="toolbar-notifications is-hidden-mobile">
                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger">
                                <div class="is-trigger" aria-haspopup="true">
                                    <i data-feather="bell"></i>
                                    <span class="new-indicator pulsate"></span>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <div class="heading">
                                            <div class="heading-left">
                                                <h6 class="heading-title">Notifications</h6>
                                            </div>
                                            <div class="heading-right">
                    <a class="notification-link" href="<?php echo base_url().'game/orders/list_order';?>">See all</a>
                                            </div>
                                        </div>
                                        <ul class="notification-list">
                                            <?php foreach($notify_orders as $notify_order){ ?>
                                            <li>
                                                <a href="<?php echo base_url().'game/orders/details/'.md5($notify_order->booking_no);?>" class="notification-item">
                                                    <div class="user-content">
                                                        <p class="user-info"><span class="name">New Order From <?php echo $notify_order->first_name.' '.$notify_order->last_name;?></span></p>
                                                        <p><span class="order">#<?php echo $notify_order->booking_no;?></span></p>
                                                        <p class="time">Booked On : <?php echo $notify_order->updated_at;?> </p>

                                                    </div>
                                                    </a>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                    <div class="dropdown profile-dropdown dropdown-trigger is-spaced is-right">
                        <i data-feather="user"></i>
                        <!-- <img src="<?php echo $this->session->userdata('profile_pic'); ?>" alt=""> -->
                        <span class="status-indicator"></span>

                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <div class="dropdown-head">
                                    <div class="h-avatar is-large">
                                       <!--  <img class="avatar" src="<?php echo $this->session->userdata('profile_pic'); ?>" alt=""> -->
                                         <i data-feather="user"></i>
                                    </div>
                                    <div class="meta">
                                        <span><?php echo $this->session->userdata('admin_name'); ?></span>
                                        <?php if($this->session->userdata('admin_type') != 'SUB ADMIN'){?>
                                        <span>Admin</span>
                                        <?php } ?>
                                         <?php if($this->session->userdata('admin_type') == 'SUB ADMIN'){?>
                                        <span>Seller</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>home/profile/edit_profile" class="dropdown-item is-media">
                                    <div class="icon">
                                        <i class="lnil lnil-user-alt"></i>
                                    </div>
                                    <div class="meta">
                                        <span>Profile</span>
                                        <span>View your profile</span>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <div class="dropdown-item is-button">
                                    <a href="<?php echo base_url();?>login/logout" class="button h-button is-primary is-raised is-fullwidth logout-button">
                                        <span class="icon is-small">
                                          <i data-feather="log-out"></i>
                                      </span>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="webapp-subnavbar">

            <?php 
                    $CI =& get_instance();
                    $CI->load->model('General_Model');
                    $menu_title_v = $CI->General_Model->get_side_bar_menu_v1('privilege_title');

                    if(!empty($menu_title_v))
                    { 

                    for($jd=0;$jd<count($menu_title_v);$jd++)
                    {

                        $active = '';
                        if(strtolower($menu_title_v[$jd]->controller_name) == strtolower($this->uri->segment(1))){ 
                        $active = "is-active"; 
                        }
                    ?>
            <div id="<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>-webapp-menu" class="webapp-subnavbar-inner tabs-wrapper">
                <div class="tabs-inner">
                    <div class="tabs is-centered is-2">
                        <ul>
                            <li data-tab="elements-basic-pages-tab-<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>" class="<?php echo $active; ?>"><a><?php echo ucfirst($menu_title_v[$jd]->privilege_title); ?></a></li>
                        </ul>
                    </div>
                </div>


                <div class="container_new">
                    <div id="elements-basic-pages-tab-<?php echo strtolower($menu_title_v[$jd]->privilege_title); ?>" class="tab-content is-active">
                        <div class="tab-content-inner">
                            <div class="center has-slimscroll">
                                <div class="columns">

                                      <?php
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
                                    
                                     <?php
                                            for($k=0;$k<count($menu_module_v1);$k++)
                                            {?>
                                     <?php if($k%5 == 0){ ?>   
                                    <div class="column is-3">
                                         <?php if($k == 0){ ?>  
                                        <h4 class="column-heading"><?php echo ucfirst($menu_module_v1[$k]->privilege_module); ?></h4>
                                    <?php } else{ ?>
                                         <h4 class="column-heading">&nbsp;</h4>
                                    <?php }?>
                                        <ul>
                                     <?php } ?>
                                            <li>
                                                <?php if($menu_module_v1[$k]->param_name == ''){ ?>
                                                <a href="<?php echo base_url();?><?php echo $menu_module_v1[$k]->controller_name;?>/<?php echo $menu_module_v1[$k]->function_name;?>">
                                                    <span><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></span>
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url();?><?php echo $menu_module_v1[$k]->controller_name;?>/<?php echo $menu_module_v1[$k]->function_name;?>/<?php echo $menu_module_v1[$k]->param_name;?>">
                                                    <span><?php echo ucfirst($menu_module_v1[$k]->privilege_sub_module); ?></span>
                                                </a>
                                            <?php } ?>
                                            </li>
                                      <?php if($k%5 == 4 || (count($menu_module_v1) == ($k+1))){ ?> 
                                        </ul>
                                    </div>
                                         <?php } ?>
                                 
                                    
                                   
                                     <?php } ?>
                                    
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php } } ?>

        </div>
    <?php } else{ ?>
         <div class="mobile-main-sidebar  mobile-subsidebar">
            <div class="inner">

                <ul class="submenu" data-simplebar>

                    <li class="has-children">
                        <div class="collapse-wrap">
                             <i data-feather="bookmark"></i>&nbsp;
                           <a href="<?php echo base_url();?>/tickets/index/create_ticket" >Sell Tickets
                            <i data-feather="chevron-right"></i></a>
                        </div>
                      
                    </li>
                    <li class="divider"></li>
                     <li class="has-children">
                        <div class="collapse-wrap">
                             <i data-feather="edit"></i>&nbsp;
                           <a href="<?php echo base_url();?>/tickets/index/listing">My Listing
                            <i data-feather="chevron-right"></i></a>
                        </div>
                      
                    </li>
                    <li class="divider"></li>
                     <li class="has-children">
                        <div class="collapse-wrap">
                             <i data-feather="shopping-cart"></i>&nbsp;
                           <a href="<?php echo base_url();?>/game/orders/list_order">Orders
                            <i data-feather="chevron-right"></i></a>
                        </div>
                      
                    </li>
                    <li class="divider"></li>
                     <li class="has-children">
                        <div class="collapse-wrap">
                             <i data-feather="user"></i>&nbsp;
                           <a href="<?php echo base_url();?>home/myaccounts">Profile
                            <i data-feather="chevron-right"></i></a>
                        </div>
                      
                    </li>
                    <li class="divider"></li>
                    
                </ul>
            </div>
        </div>
       
        <!--Webapp navbar regular-->
        <div class="webapp-navbar head_title">
            <div class="webapp-navbar-inner">
                <div class="left">
                    <a href="<?php echo base_url();?>" class="brand">
                        <img class="light-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="" />
                        <img class="dark-image" src="<?php echo base_url();?>assets/img/logos/logo/logo.png" alt="" />
                    </a>
                    <div class="separator"></div>
                    <?php if($this->session->userdata('role') == 6){ ?>
                    <div class="dropdown project-dropdown dropdown-trigger is-spaced">
                        <div class="h-avatar is-small">
                            <span class="avatar is-fake is-h-green">
                              <span><?php

                               echo substr($this->session->userdata('storefront')->company_name, 0, 1);?></span>
                            </span>
                        </div>
                         <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <?php foreach($app['branches'] as $branch){ ?>
                                <div class="dropdown-block" onclick="set_storefront('<?php echo $branch->admin_id;?>');">
                                    <div class="h-avatar is-small">
                                        <span class="avatar is-fake is-warning">
                                          <span><?php echo substr($branch->company_name,0,1);?></span>
                                        </span>
                                    </div>
                                    <div class="meta">
                                        <span class="dark-inverted"><?php echo $branch->company_name;?></span>
                                        <span><?php echo $branch->admin_name;?> <?php echo $branch->admin_last_name;?></span>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div> 
                <?php } ?>
                <?php if($this->session->userdata('role') == 6){ ?>
                    <h1 id="" class="title is-5">
                        <?php echo $this->session->userdata('storefront')->company_name; ?></h1>
                <?php } ?>
                <?php if($this->session->userdata('role') == 1){ ?>
                    <h1 id="" class="title is-5">
                        Seller Dashboard</h1>
                <?php } ?>
                </div>
                <div class="center">
                    <div id="webapp-navbar-menu" class="centered-links">

                        
                         <a class="centered-link centered-link-toggle" href="<?php echo base_url();?>tickets/index/create_ticket">
                            <i data-feather="bookmark"></i>
                            <span >Sell Tickets</span>
                        </a>
                        <a class="centered-link centered-link-toggle" href="<?php echo base_url();?>tickets/index/listing">
                            <i data-feather="edit"></i>
                            <span >My Listing</span>
                        </a>
                         <a class="centered-link centered-link-toggle" href="<?php echo base_url();?>game/orders/list_order">
                            <i data-feather="shopping-cart"></i>
                            <span >Orders</span>
                        </a>
                       

                    </div>

                </div>
                <div class="right">
                    <div class="toolbar ml-auto">
                         <a class="toolbar-link right-panel-trigger" data-panel="languages-panel">
                            <img src="<?php echo base_url();?>assets/img/icons/flags/<?php echo $this->session->userdata('language_code');?>.svg" alt="">
                        </a> 
                        <?php if($this->session->userdata('role') != 9 && $this->session->userdata('role') != 7){?>
                        <div class="toolbar-notifications is-hidden-mobile">
                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger">
                                <div class="is-trigger" aria-haspopup="true">
                                    <i data-feather="bell"></i>
                                    <span class="new-indicator pulsate"></span>
                                </div>
                                <div class="dropdown-menu" role="menu">
                                    <div class="dropdown-content">
                                        <div class="heading">
                                            <div class="heading-left">
                                                <h6 class="heading-title">Notifications</h6>
                                            </div>
                                            <div class="heading-right">
                    <a class="notification-link" href="<?php echo base_url().'game/orders/list_order';?>">See all</a>
                                            </div>
                                        </div>
                                        <ul class="notification-list">
                                            <?php foreach($notify_orders as $notify_order){ ?>
                                            <li>
                                                <a href="<?php echo base_url().'game/orders/details/'.md5($notify_order->booking_no);?>" class="notification-item">
                                                    <div class="user-content">
                                                        <p class="user-info"><span class="name">New Order From <?php echo $notify_order->first_name.' '.$notify_order->last_name;?></span></p>
                                                        <p><span class="order">#<?php echo $notify_order->booking_no;?></span></p>
                                                        <p class="time">Booked On : <?php echo $notify_order->updated_at;?> </p>

                                                    </div>
                                                    </a>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                    <div class="dropdown profile-dropdown dropdown-trigger is-spaced is-right">
                       <!--  <img src="<?php echo $this->session->userdata('profile_pic'); ?>" alt="">-->
                         <i data-feather="user" style="cursor: pointer;"></i> 
                        <span class="status-indicator"></span>

                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <div class="dropdown-head">
                                    <div class="h-avatar is-large">
                                      <!--   <img class="avatar" src="<?php echo $this->session->userdata('profile_pic'); ?>" alt=""> -->
                                        <i data-feather="user"></i>
                                    </div>
                                    <div class="meta">
                                        <span><?php echo $this->session->userdata('admin_name'); ?></span>
                                        <?php if($this->session->userdata('admin_type') != 'SUB ADMIN'){?>
                                        <span>Admin</span>
                                        <?php } ?>
                                         <?php if($this->session->userdata('admin_type') == 'SUB ADMIN'){?>
                                        <span>Seller</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <a href="<?php echo base_url();?>home/myaccounts" class="dropdown-item is-media">
                                    <div class="icon">
                                        <i class="lnil lnil-user-alt"></i>
                                    </div>
                                    <div class="meta">
                                        <span>Profile</span>
                                        <span>View your profile</span>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <div class="dropdown-item is-button">
                                    <a href="<?php echo base_url();?>login/logout" class="button h-button is-primary is-raised is-fullwidth logout-button">
                                        <span class="icon is-small">
                                          <i data-feather="log-out"></i>
                                      </span>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    <?php } ?>

         <div id="languages-panel" class="right-panel-wrapper is-languages">
            <div class="panel-overlay"></div>

            <div class="right-panel">
                <div class="right-panel-head">
                    <h3>Select Language</h3>
                    <a class="close-panel">
                        <i data-feather="chevron-right"></i>
                    </a>
                </div>
                <div class="right-panel-body has-slimscroll">
                    <div class="languages-boxes">
                       
                        <?php 
                       // echo "<pre>";print_r($languages);
                        foreach($app['languages'] as $language){ ?>

                        <div class="language-box" title="<?php echo $language->language_name;?>">
                            <div class="language-option">
                                <input type="radio" name="language_selection" value="<?php echo $language->language_code;?>" onclick="set_language(this.value);" <?php if($this->session->userdata('language_code') ==  $language->language_code){ ?> checked <?php } ?>>
                                <div class="language-option-inner">
                                    <img src="<?php echo base_url();?>assets/img/icons/flags/<?php echo $language->language_flag;?>" alt="">
                                    
                                    <div class="indicator">
                                        <i data-feather="check"></i>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>

                </div>
            </div>
        </div>
<!-- <script> feather.replace(); </script> -->
