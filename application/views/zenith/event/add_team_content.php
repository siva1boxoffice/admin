<?php $this
   ->load
   ->view('common/header'); ?>
<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
<div class="page-content-wrapper">
<div class="page-content is-relative business-dashboard course-dashboard">
<div class="page-content-inner">
   <form id="add-team-form" enctype='multipart/form-data' method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/teams/save_team">
      <input type="hidden" name="teamId" value="<?php if (isset($teams->id)) {
         echo $teams->id;
         } ?>">
         <input type="hidden" name="flag" value="content">
      <div class="dashboard-title is-main">
         <div class="left">
            <h2 class="dark-inverted">Team</h2>
         </div>
      </div>
      <!--Form Layout 1-->
      <div class="form-layout">
         <div class="form-outer">
            <div class="form-header stuck-header">
               <div class="form-header-inner">
                  <div class="left">
                     <h3>Edit Team Content</h3>
                  </div>
                  <div class="right">
                     <div class="buttons">
                        <?php if (isset($teams->id)) { ?>
                           SEO : &nbsp;
                            <div class="switch-block no-padding-all">
                                <!-- <div class="text">
                                    <span>SEO Status</span>
                                 </div> -->
                                 <label class="form-switch is-primary">
                                 <input data-href="<?php echo base_url(); ?>settings/teams/seo_status/<?php echo $teams->id;?>" type="checkbox" class="is-switch seo_status" name="is_seo_active" value="1" <?php if (isset($teams->seo_status)) {
                                    if ($teams->seo_status == 1) { ?> checked <?php
                                    }
                                    } ?>>
                                 <i></i>
                                 </label>
                              </div>&nbsp;
                                 <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $teams->url_key; ?>" class="button h-button is-light is-dark-outlined">
                                    <span class="icon">
                                       <i class='fa fa-eye'></i>
                                    </span>
                                 </a>
                        <?php } ?>
                        <a href="<?php echo base_url(); ?>settings/teams" class="button h-button is-light is-dark-outlined">
                        <span class="icon">
                        <i class="lnir lnir-arrow-left rem-100"></i>
                        </span>
                        <span>Go to Teams</span>
                        </a>
                        <button type="submit" id="save-button" class="button h-button is-primary is-raised">Save</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-body">
               <!--Fieldset-->
               <div class="form-fieldset" style="max-width: 580px;">
                  <div class="columns is-multiline">
                     <div class="column is-12">
                        <div class="field">
                           <label>Team Name *</label>
                           <div class="control">
                              <input disabled type="text" id="teamname" name="teamname" class="input" placeholder="Enter Team Name" required value="<?php if (isset($teams->team)) {
                                 echo $teams->team;
                                 } ?>">
                           </div>
                        </div>
                     </div>
                     <?php if($this->session->userdata('role') != 7){?>
                     <div class="column is-12">
                        <div class="field">
                           <label>Title *</label>
                           <div class="control">
                              <input type="text" id="pagetitle" name="pagetitle" class="input" placeholder="Enter Page Title" required value="<?php if (isset($teams->title)) {
                                 echo $teams->title;
                                 } ?>">
                           </div>
                        </div>
                     </div>
                     <div class="column is-12">
                        <div class="field">
                           <label>Meta Description *</label>
                           <div class="control">
                              <textarea class="textarea" rows="4" placeholder="Meta Description" name="metadescription" required><?php if (isset($teams->metdes)) {
                                 echo $teams->metdes;
                                 } ?></textarea>
                           </div>
                        </div>
                     </div>
                  <?php } else{ ?>
                     <input type="hidden" id="pagetitle" name="pagetitle" class="input" placeholder="Enter Page Title" value="<?php if (isset($teams->title)) {
                                 echo $teams->title;
                                 } ?>">
                     <textarea style="display:none;" class="textarea" rows="4" placeholder="Meta Description" name="metadescription" ><?php if (isset($teams->metdes)) {
                                 echo $teams->metdes;
                                 } ?></textarea>
                  <?php } ?>
                     <div class="column is-12">
                        <div class="field">
                           <label>Team Description *</label>
                           <div class="control">
                              <textarea id="page_content" name="page_content"><?php echo $teams->page_content; ?></textarea>
                           </div>
                        </div>
                     </div>
                    <div class="column is-6">
                                 <div class="field">
                                    <label>Seo Keywords</label>
                                    <div class="control">
                                        <input id="choices-text-remove-button" class="input" value="<?php echo $teams->seo_keywords;?>" name="seo_keywords" placeholder="Enter Keywords">
                                    </div>
                                 </div>
                              </div>
                     <div class="column is-6">
                                 <div class="field">
                                    <label>Search Keywords</label>
                                    <div class="control">
                                        <input id="search_keywords" class="input" value="<?php echo $teams->search_keywords;?>" name="search_keywords" placeholder="Enter Search Keywords">
                                    </div>
                                 </div>
                     </div>
                     <div class="column is-12">
                        <div class="field">
                           <label>URL Key</label>
                           <div class="control">
                              <input type="text" id="url_key" name="url_key" class="input" placeholder="Enter Url Key" required value="<?php if (isset($teams->url_key)) {
                                 echo $teams->url_key;
                                 } ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<?php $this
   ->load
   ->view('common/footer'); ?>
<script type="text/javascript">
   $('#page_content').summernote({
      placeholder: 'Team Content',
      tabsize: 2,
      height: 250, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
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
   $('#team_content_left').summernote({
      placeholder: 'Team Content Left',
      tabsize: 2,
      height: 250, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
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
   $('#team_content_right').summernote({
      placeholder: 'Team Content Right',
      tabsize: 2,
      height: 250, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
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
   // $(function() {
   //    $('#team_color').colorpicker();
   //    $('#team_color').on('colorpickerChange', function(event) {
   //       $('.js-colorpicker').css('background-color', event.color.toString());
   
   //    });
   // });
   $("#team_image").change(function() {
      filePreview(this);
   })
   
   function filePreview(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
            $('#previewImage + img').remove();
            $('#imageFile').remove();
            $('#previewImage').append('<img class="imgTbl" id="imageFile" src="' + e.target.result + '" />');
         }
         reader.readAsDataURL(input.files[0]);
      }
   }
   $("#team_bg").change(function() {
      filePreviewBg(this);
   })
   
   function filePreviewBg(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
            $('#previewImagebg + img').remove();
            $('#imageFilebg').remove();
            $('#previewImagebg').append('<img class="imgTbl" id="imageFilebg" src="' + e.target.result + '" />');
         }
         reader.readAsDataURL(input.files[0]);
      }
   }
</script>