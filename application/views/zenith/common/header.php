<?php
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Unique;
$CI =& get_instance();
$CI->load->model('General_Model');
$notify_orders = $CI->General_Model->getOrderData_v1('notify')->result();
// echo '<pre/>';
// print_r($notify_orders);
// exit;
$store_color = array('13' => 'is-warning', '208' => 'is-h-green', '211' => 'is-blue');

$adminId = $this->session->userdata('storefront')->admin_id;

$branches = $app['branches'];

$role = $this->session->userdata('role');

if ($role == 13 && !empty($branches)) {
    $branches = array_filter($branches, function ($value) {
        return $value->admin_name == 'Tixtransfer';
    });
}

if(!empty($branches))
{
   usort($branches, function ($a, $b) use ($adminId) {
      if ($a->admin_id == $adminId) {
         return -1; // $a should come before $b
      } elseif ($b->admin_id == $adminId) {
         return 1; // $b should come before $a
      } else {
         return 0; // no preference between $a and $b
      }
   });
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="LetStart Admin is a full featured, multipurpose, premium bootstrap admin template built with Bootstrap 4 Framework, HTML5, CSS and JQuery.">
    <meta name="keywords"
        content="admin, panels, dashboard, admin panel, multipurpose, bootstrap, bootstrap4, all type of dashboards">
    <meta name="author" content="MatrrDigital">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        <?php echo $app['app_title']; ?> :: Welcome
    </title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/choices.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/zenith_assets/img/favicon.ico" type="image/x-icon" />

    <!-- ================== BEGIN PAGE LEVEL CSS START ================== -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/icons.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/libs/wave-effect/css/waves.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/libs/owl-carousel/css/owl.carousel.min.css?v=1.3.9.1" />
    <!-- ================== BEGIN PAGE LEVEL END ================== -->
    <!-- ================== Plugins CSS  ================== -->
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/datatables/css/responsive.bootstrap4.min.css?v=1.3.4.1" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/datatables/css/buttons.bootstrap4.min.css?v=1.3.2.1" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/datatables/css/select.bootstrap4.min.css?v=1.4.6.1" rel="stylesheet" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/datatables/css/bootstrap-table.min.css?v=2.3.4.1" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/fonts.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/mCustomScrollBox.css?v=1">

    <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/zenith_assets/libs/flatpicker/css/flatpickr.min.css"> -->
    <!-- ================== Plugins CSS ================== -->
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/dropzone/css/dropzone.min.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/zenith_assets/libs/dropify/css/dropify.min.css" rel="stylesheet" />

    <link href="<?php echo base_url();?>assets/zenith_assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/zenith_assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/zenith_assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/zenith_assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/zenith_assets/libs/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/bootstrap.css?V=1.10" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/zenith_assets/css/styles.css?v=2.6.1.55" />
    <style>
        embed {
        overflow: hidden !important;
      }
        </style>
    <!-- ================== BEGIN APP CSS  ================== -->
   
    <!-- ================== END APP CSS ================== -->
   
    <!-- ================== BEGIN POLYFILLS  ================== -->
    <!--[if lt IE 9]>
      <script src="assets/libs/html5shiv/js/html5shiv.js"></script>
      <script src="assets/libs/respondjs/js/respond.min.js"></script>
   <![endif]-->
    <!-- ================== END POLYFILLS  ================== -->
</head>

<body class="<?php echo $this->session->userdata('set_menu'); ?> ">
    <!-- Begin Page -->
    <div class="page-wrapper">
        <!-- Begin Header -->
        <!-- Begin Header -->
        <header id="page-topbar" class="topbar-header">
<div class="navbar-header">
   <div class="left-bar">
      <div class="navbar-brand-box">
          <a href="<?php echo base_url(); ?>home/index" class="logo logo-dark">
            <span class="logo-sm"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/logo-white-sm.png" alt="Lettstart Admin"></span>
            <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/logo-white.png" alt="Lettstart Admin"></span>
         </a>
         <a href="<?php echo base_url(); ?>home/index" class="logo logo-light">
            <span class="logo-sm"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/logo-sm.png" alt="Lettstart Admin"></span>
            <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/zenith_assets/img/logo.png" alt="Lettstart Admin"></span>
         </a>
      </div>
      <button type="button" id="vertical-menu-btn" class="btn hamburg-icon">
         <i class="mdi mdi-menu"></i>
      </button>
   </div>
   <div class="right-bar">
      <div class="d-inline-flex ml-0 ml-sm-2 d-lg-none dropdown">
         <button data-toggle="dropdown" aria-haspopup="true" type="button" id="page-header-search-dropdown"
            aria-expanded="false" class="btn header-item notify-icon">
            <i class="bx bx-search"></i>
         </button>
         <div aria-labelledby="page-header-search-dropdown"
            class="dropdown-menu-lg dropdown-menu-right p-0 dropdown-menu">
            <form class="p-3">
               <div class="search-box">
                  <div class="position-relative">
                     <input type="text" placeholder="Search..." class="form-control form-control-sm">
                     <i class="bx bx-search icon"></i>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="d-none d-lg-inline-flex ml-2">
         <button type="button" data-toggle="fullscreen" class="btn header-item notify-icon" id="">
            <i class="bx bx-envelope"></i>
         </button>
      </div>
      <div class="d-inline-flex ml-0 ml-sm-2 dropdown">
         <button data-toggle="dropdown" aria-haspopup="true" type="button" id="page-header-notification-dropdown"
            aria-expanded="false" class="btn header-item notify-icon position-relative">
            <i class="bx bx-bell bx-tada"></i>
            <span class="badge badge-danger badge-pill notify-icon-badge"><?php echo count($notify_orders) ?></span>
         </button>
         <div aria-labelledby="page-header-notification-dropdown"
            class="dropdown-menu-lg dropdown-menu-right p-0 dropdown-menu">
            <div class="notify-title p-3">
               <h5 class="font-size-14 font-weight-600 mb-0">
                  <span>Notification</span>
                  <a class="text-primary" href="javascript: void(0);">
                     <small>Clear All</small>
                  </a>
               </h5>
            </div>
            <div class="notify-scroll">
               <div class="scroll-content" id="notify-scrollbar">
                  <div class="scroll-content">
                    <?php foreach($notify_orders as $notify_order){ ?>
                      <a href="<?php echo base_url().'game/orders/details/'.md5($notify_order->booking_no);?>" class="dropdown-item notification-item">
                        <div class="media">
                           <div class="avatar avatar-xs bg-primary">
                              <i class="bx bx-user-plus"></i>
                           </div>
                           <p class="media-body">
                            New Order From <?php echo $notify_order->first_name.' '.$notify_order->last_name;?>
                            <br>
                            #<?php echo $notify_order->booking_no;?>
                            <small class="text-muted">Booked On : <?php echo $notify_order->updated_at;?></small>
                        </p>
                        </div>
                     </a>
                     <?php } ?>                     
                  </div>
               </div>
               <div class="notify-all">
                 <a href="<?php echo base_url().'game/orders/list_order';?>" class="text-primary text-center p-3">
                      <small>View All</small>
                  </a>
               </div>
            </div>
         </div>
      </div>

      <div class="d-inline-flex ml-0 ml-sm-2 dropdown">
         <button aria-haspopup="true" data-toggle="dropdown" type="button"
                            id="page-header-store-dropdown" aria-expanded="false" class="btn header-item flag_imag">
         
          <span class="ml-2 d-none d-sm-inline-block"><?php echo ucfirst($branches[0]->admin_name);?></span>
          <i class="bx bx-caret-down ml-1 d-none d-xl-inline-block"></i>
          </button>

         <div aria-labelledby="page-header-country-dropdown" id="store"
            class="dropdown-menu-right dropdown-menu rounded-0 flag_imag_drop">
            <?php 
            foreach($branches as $branche){
                ?>
            <a href="javascript:void(0);" class="dropdown-item" onclick="set_storefront('<?php echo $branche->admin_id;?>');">               
               <span class="align-middle" ><?php echo $branche->admin_name." ".$branche->admin_last_name;?></span>
            </a>
            <?php } ?>
         </div>
      </div>
      
      <div class="d-inline-flex ml-0 ml-sm-2 dropdown">
         <button aria-haspopup="true" data-toggle="dropdown" type="button"
                            id="page-header-country-dropdown" aria-expanded="false" class="btn header-item flag_imag">
          <img src="<?php echo base_url();?>assets/zenith_assets/img/icons/flags/<?php echo $this->session->userdata('language_code');?>.svg" class="mh-18" alt="<?php echo strtoupper($this->session->userdata('language_code'));?>">
          <span class="ml-2 d-none d-sm-inline-block"><?php echo strtoupper($this->session->userdata('language_code'));?></span>
          <i class="bx bx-caret-down ml-1 d-none d-xl-inline-block"></i>
          </button>

         <div aria-labelledby="page-header-country-dropdown" id="countries"
            class="dropdown-menu-right dropdown-menu rounded-0 flag_imag_drop">
            <?php 
            foreach($app['languages'] as $language){
                ?>
            <a href="javascript:void(0);" class="dropdown-item" onclick="set_language('<?php echo $language->language_code;?>');">
               <img class="mr-2 mh-18" src="<?php echo base_url();?>assets/zenith_assets/img/flags/<?php echo $language->language_flag;?>" alt="<?php echo $language->language_code;?>">
               <span class="align-middle" data-lang="<?php echo $language->language_code;?>"><?php echo $language->language_code;?></span>
            </a>
            <?php } ?>
         </div>
      </div>
      <div class="d-inline-flex ml-0 ml-sm-2 dropdown">
         <button data-toggle="dropdown" aria-haspopup="true" type="button" id="page-header-profile-dropdown"
            aria-expanded="false" class="btn header-item head_icon">
            <i class="bx bx-user"></i>
            <span class="d-none d-xl-inline-block ml-1"><?php if($this->session->userdata('admin_type') != 'SUB ADMIN'){?>
              <span>Admin</span>
              <?php } ?>
                <?php if($this->session->userdata('admin_type') == 'SUB ADMIN'){?>
              <span>Seller</span>
              <?php } ?> </span>
            </span>
            <i class="bx bx-caret-down ml-1 d-none d-xl-inline-block"></i>
         </button>
         <div aria-labelledby="page-header-profile-dropdown" class="dropdown-menu-right dropdown-menu">
            <a href="<?php echo base_url();?>home/profile/edit_profile" class="dropdown-item">
               <i class="bx bx-user mr-1"></i> Profile
            </a>
            <a href="javascript: void(0);" class="dropdown-item">
               <i class="bx bx-wrench mr-1"></i> Settings
            </a>
            <a href="javascript: void(0);" class="dropdown-item">
               <i class="bx bx-wallet mr-1"></i> My Wallet
            </a>
            <a href="javascript: void(0);" class="dropdown-item">
               <i class="bx bx-lock mr-1"></i> Lock screen
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url();?>login/logout" class="text-danger dropdown-item">
               <i class="bx bx-log-in mr-1 text-danger"></i> Logout
            </a>
         </div>
      </div>
      <!-- <div class="d-inline-flex">
         <button type="button" id="layout" class="btn header-item notify-icon">
            <i class="bx bx-cog bx-spin"></i>
         </button>
      </div> -->
   </div>
</div>
</header>
        <!-- Header End -->
        <!-- Header End -->
        <!-- Begin Left Navigation -->
        <!-- Begin Left Navigation -->
        <aside class="side-navbar">
            <div class="scroll-content" id="metismenu">
                <ul id="side-menu" class="metismenu list-unstyled">
                    <li class="side-nav-title side-nav-item menu-title"></li>
                    <li>
                      <a href="<?php echo base_url();?>home/index" class="side-nav-link" aria-expanded="false">
                         <i class="bx bx-home-alt"></i>
                         <span> Home</span>
                      </a>
                    </li>

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
                                <a href="javascript:void(0);" class="side-nav-link" aria-expanded="false">
                                    <i class="bx bx-<?php echo $menu_title_v[$jd]->privilege_icon;?>"></i>
                                    <span> <?php echo ucwords(strtolower($menu_title_v[$jd]->privilege_title));?></span>
                                    <span class="menu-arrow"></span>
                                </a>
                               

                                <ul aria-expanded="false" class="nav-second-level">
                                            <?php                                             
                                            $CI =& get_instance();
                                            $CI->load->model('General_Model');
                                            $menu_module_v1 = @$CI->General_Model->get_side_bar_menu_v1($gdata='',$menu_title_v[$jd]->privilege_title,$menu_module_v[$j]->privilege_module);
                                           // echo $CI->db->last_query();exit;
                                           $incrmnt=0;
                                           $module_arr=[];
                                            for($k=0;$k<count($menu_module_v1);$k++)
                                            {
                                                if (array_key_exists($menu_module_v1[$k]->privilege_module, $module_arr)) {
                                                    // If the key exists, add the value to the existing array
                                                    $module_arr[$menu_module_v1[$k]->privilege_module][$incrmnt]['name'] = $menu_module_v1[$k]->privilege_sub_module;
                                                    $module_arr[$menu_module_v1[$k]->privilege_module][$incrmnt]['url'] = base_url().$menu_module_v1[$k]->controller_name.'/'.$menu_module_v1[$k]->function_name.'/'.$menu_module_v1[$k]->param_name;
                                                    $incrmnt++;
                                                } else {
                                                    // If the key doesn't exist, create a new array with the value
                                                    $module_arr[$menu_module_v1[$k]->privilege_module][$incrmnt] =array('name'=>$menu_module_v1[$k]->privilege_sub_module,'url'=>base_url().$menu_module_v1[$k]->controller_name.'/'.$menu_module_v1[$k]->function_name.'/'.$menu_module_v1[$k]->param_name);
                                                    $incrmnt++;
                                                }
                                            }   
                                           
                                            foreach($module_arr as $md_key=>$md_value)
                                            {

                                                ?>
                                                <li class="side-nav-item">
                                                    <a href="javascript:void(0);" class="side-nav-link-a" aria-expanded="false"> <?php echo ucwords(strtolower($md_key)); ?>
                                                        <span class="menu-arrow"></span></a>
                                                    <ul aria-expanded="false" class="nav-third-level">
                                                        <?php 
                                                        foreach($md_value as $sub_key=>$sub_value)
                                                        {?>
                                                            <li>
                                                                <a class="side-nav-link" href="<?php echo $md_value[$sub_key]['url']; ?>"> <?php echo ucwords(strtolower($md_value[$sub_key]['name'])); ?>
                                                                <?php if($md_value[$sub_key]['name'] == "Ticket Approval"){
                                                                  $approve_request_count = $this->General_Model->ticket_approve_request_v1('pending')->num_rows();
                                                                  if($approve_request_count > 0){
                                                                  ?> 
                                                                <span class="badge badge-danger badge-pill notify-icon-badge"><?php echo $approve_request_count;?></span>
                                                                <?php } }  ?> </a>
                                                            </li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                              ?>
                                </ul>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </aside>
        
        <!-- Left Navigation End -->
        <!-- Left Navigation End -->

        
