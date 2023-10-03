<?php $this->load->view('common/header');?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">
                        <?php $match_id = json_decode(base64_decode($this->uri->segment(4)));?>
                   
                     <div class="page-content-inner">
                         <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>event/matches/save_matches">
                            <input type="hidden" name="matchId" value="<?php echo $match_id;?>">
                            <input type="hidden" name="flag" value="content">
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Matches</h2>
                                </div>
                            </div>
                            <?php //echo "<pre>";print_r($matches);?>
                              <!--Form Layout 1-->
                        <div class="form-layout">
                            <div class="form-outer">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <h3>Match Content Info</h3>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                  <?php //if (isset($matches->m_id)) { ?>
                                                  SEO : &nbsp;
                            <div class="switch-block no-padding-all">
                                <!-- <div class="text">
                                    <span>SEO Status</span>
                                 </div> -->
                                 <label class="form-switch is-primary">
                                 <input data-href="<?php echo base_url(); ?>event/matches/seo_status/<?php echo $matches->m_id;?>" type="checkbox" class="is-switch seo_status" name="is_seo_active" value="1" <?php if (isset($matches->seo_status)) {
                                    if ($matches->seo_status == 1) { ?> checked <?php
                                    }
                                    } ?>>
                                 <i></i>
                                 </label>
                              </div>&nbsp;
                                                <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $matches->slug; ?>" class="button h-button is-light is-dark-outlined">
                                                <span class="icon">
                                                <i class='fa fa-eye'></i>
                                                </span>
                                                </a>
                                                <?php //} ?>
                                                <a href="<?php echo base_url();?>event/matches/upcoming" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Matches</span>
                                                </a>
                                                <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body has-loader">

                                      <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>
                                     <!--Fieldset-->
                                    
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 580px;">
                                        <div class="fieldset-heading">
                                            <h4>Match Content Info</h4>
                                            <p>Fill the Match Content Information</p>
                                        </div>

                                        <div class="columns is-multiline">
                                            <div class="column is-12">
                                                <div class="field">
                                                    <label>Match Name *</label>
                                                    <div class="control">
                                                      <!--   <input disabled type="text" id="" name="" class="input" placeholder="Match Name" value="<?php echo $matches->match_name;?>"> -->
                                                          <input  type="text" id="matchname" name="matchname" class="input" placeholder="Match Name" required value="<?php echo $matches->match_name;?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <?php if($this->session->userdata('role')){?>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Title *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Title" name="metatitle" required><?php echo $matches->meta_title;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Meta Description *</label>
                                                    <div class="control">
                                                        <textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription" ><?php echo $matches->meta_description;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                             <textarea class="textarea" rows="4" placeholder="Meta Title" name="metatitle" style="display: none;"><?php echo $matches->meta_title;?></textarea>
                                              <textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription" style="display: none;"><?php echo $matches->meta_description;?></textarea>
                                        <?php } ?>
                                             <div class="column is-12">
                                                <div class="field">
                                                    <label>Match Description </label>
                                                    <div class="control">
                                                         <textarea id="match_description" name="description"><?php echo $matches->description;?></textarea>
                                                       <!--  <textarea class="textarea" rows="4" placeholder="Match Description" name="match_description" required><?php echo $matches->description;?></textarea> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-12">
                                            <div class="field">
                                                <label>Seo Keywords</label>
                                                <div class="control">
                                                     <input id="choices-text-remove-button" class="input" value="<?php echo $matches->seo_keywords;?>" name="seo_keywords" placeholder="Enter Keywords">
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                    
                                </div>
                            </div>
                        </div>

                      
                    </form>
                    </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">

                      $('#match_description').summernote({
          placeholder: 'Match Description',
          tabsize: 2,
          height: 250,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true, 
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['codeview', 'help']]
          ]
      });

                    <?php if (strtotime($matches->match_date)){ ?>

                         bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y', strtotime($matches->match_date));?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-1", {startDate: new Date('<?php echo date('m/d/Y');?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                    <?php } ?>  

                      <?php if (strtotime($matches->match_time)){ ?>
                        var now = new Date()
  console.log(moment(now).format('HH:mm'))
                         bulmaCalendar.attach("#bulma-datepicker-5", {startTime: moment(now).format('HH:mm'), color: themeColors.primary, lang: "en" });

                    <?php } else {?>

                        bulmaCalendar.attach("#bulma-datepicker-5", {startTime: '<?php echo date('h:m');?>', color: themeColors.primary, lang: "en" });

                    <?php } ?>       
                </script>
                
<?php exit;?>