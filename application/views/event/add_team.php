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
                     <h3>Add Or Edit Team</h3>
                  </div>
                  <div class="right">
                     <div class="buttons">
                        <?php if (isset($teams->id)) { ?>
                                 <a target="_blank" href="<?php echo FRONT_END_URL; ?>/en/<?php echo $teams->url_key; ?>" class="button h-button is-light is-dark-outlined">
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
                     <div class="column is-6">
                        <div class="field">
                           <label>Team Name *</label>
                           <div class="control">
                              <input type="text" id="teamname" name="teamname" class="input" placeholder="Enter Team Name" required value="<?php if (isset($teams->team)) {
                                 echo $teams->team;
                                 } ?>">
                           </div>
                        </div>
                     </div>
                     <div class="column is-6">
                        <div class="field">
                           <label>Game Category *</label>
                           <div class="control">
                              <select class="form-control select2" id="gamecategory" name="gamecategory" required>
                                 <option value="">-Select Game Category-</option>
                                 <?php foreach ($gcategory as $category) { ?>
                                 <option value="<?php echo $category->id; ?>" <?php if (isset($teams->category)) {
                                    if ($teams->category == $category->id) {
                                    	echo ' selected  ';
                                    }
                                    } ?>><?php echo $category->category_name; ?></option>
                                 <?php
                                    } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="column is-12">
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
                     <div class="column is-12">
                        <div class="field">
                           <label>Team Description *</label>
                           <div class="control">
                              <textarea id="page_content" name="page_content"><?php echo $teams->page_content; ?></textarea>
                           </div>
                        </div>
                     </div>
 -->                     <div class="column is-6">
                        <div class="field">
                           <label> Status </label>
                           <div class="control has-icon">
                              <div class="switch-block no-padding-all">
                                 <label class="form-switch is-primary">
                                 <input type="checkbox" class="is-switch" name="is_active" value="1" <?php if (isset($teams->status)) {
                                    if ($teams->status == '1') { ?> checked <?php
                                    }
                                    } ?>>
                                 <i></i>
                                 </label>
                                 <div class="text">
                                    <span>Inactive / Active</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="column is-6">
                        <div class="field">
                           <label> Top Team </label>
                           <div class="control has-icon">
                              <div class="switch-block no-padding-all">
                                 <label class="form-switch is-primary">
                                 <input type="checkbox" class="is-switch" name="topteam" value="1" <?php if (isset($teams->popular_team)) {
                                    if ($teams->popular_team == '1') { ?> checked <?php
                                    }
                                    } ?>>
                                 <i></i>
                                 </label>
                                 <div class="text">
                                    <span>Yes / No</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="column is-6">
                        <div class="field">
                           <label>Team Image (40x40)</label>
                           <div class="control has-icon">
                              <div class="file has-name is-fullwidth">
                                 <label class="file-label">
                                 <input type="hidden" name="exs_file" value="<?php if (isset($teams->teamImg)) {
                                    echo $teams->teamImg;
                                    } ?>">
                                 <input class="file-input" type="file" id="team_image" name="team_image" <?php if ($teams->id == "") { ?> required <?php } ?>>
                                 <span class="file-cta">
                                 <span class="file-icon">
                                 <i class="lnil lnil-lg lnil-cloud-upload"></i>
                                 </span>
                                 <span class="file-label">
                                 Choose a file…
                                 </span>
                                 </span>
                                 <span class="file-name light-text imgSelected" id="previewImage">
                                 <img class="imgTbl" id="imageFile"></span>
                                 </span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        if (isset($teams->teamImg)) {
                        	if (UPLOAD_PATH . 'uploads/teams/' . $teams->teamImg) { ?>
                     <div class="column is-6">
                        <div class="field">
                           <label>Previous Team Image </label>
                           <div class="control has-icon">
                              <div class="file has-name is-fullwidth">
                                 <label class="file-label">
                                 <img class="imgTbl" src="<?= UPLOAD_PATH . 'uploads/teams/' . $teams->teamImg; ?>"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        } ?>
                     <div class="column is-6">
                        <div class="field">
                           <label>Background Image </label>
                           <div class="control has-icon">
                              <div class="file has-name is-fullwidth">
                                 <label class="file-label">
                                 <input type="hidden" name="exs_filebg" value="<?php if (isset($teams->teambgImg)) {
                                    echo $teams->teambgImg;
                                    } ?>">
                                 <input class="file-input" type="file" id="team_bg" name="team_bg" <?php if ($teams->id == "") { ?> required <?php } ?>>
                                 <span class="file-cta">
                                 <span class="file-icon">
                                 <i class="lnil lnil-lg lnil-cloud-upload"></i>
                                 </span>
                                 <span class="file-label">
                                 Choose a file…
                                 </span>
                                 </span>
                                 <span class="file-name light-text imgSelected" id="previewImagebg">
                                 <img class="imgTbl" id="imageFilebg"></span>
                                 </span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        if (isset($teams->teambgImg)) {
                        	 ?>
                     <div class="column is-6">
                        <div class="field">
                           <label>Previous Background Image </label>
                           <div class="control has-icon">
                              <div class="file has-name is-fullwidth">
                                 <label class="file-label">
                                 <img class="imgTbl" src="<?= UPLOAD_PATH . 'uploads/background/'  . $teams->teambgImg; ?>"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
                        
                        } ?>
                     <div class="column is-6">
                        <div class="field">
                           <label>Team Color</label>
                           <div class="control">
                              <input type="color" id="teamcolor" name="teamcolor" class="input" placeholder="Select team Color" required value="<?php if (isset($teams->team_color)) {
                                 echo $teams->team_color;
                                 } ?>">
                           </div>
                        </div>
                     </div>
                     <!-- <div class="column is-6">
                        <div class="field">
                           <label>URL Key</label>
                           <div class="control">
                              <input type="text" id="url_key" name="url_key" class="input" placeholder="Enter Url Key" required value="<?php if (isset($teams->url_key)) {
                                 echo $teams->url_key;
                                 } ?>">
                           </div>
                        </div>
                     </div> -->
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
   // 	$('#team_color').colorpicker();
   // 	$('#team_color').on('colorpickerChange', function(event) {
   // 		$('.js-colorpicker').css('background-color', event.color.toString());
   
   // 	});
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