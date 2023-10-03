<?php $this->load->view('common/header'); ?>

<!-- Content Wrapper -->
<div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Add Seat Category" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
    <div class="page-content-wrapper">
        <div class="page-content is-relative business-dashboard course-dashboard">
            <div class="page-content-inner">
                <div class="flex-list-wrapper">

                    <!--Form Layout 1-->
                    <div class="form-layout">
                        <div class="form-outer">
                            <form id="category-form" method="post" class="login-wrapper form_req_validation validate_form_v1" action="<?php echo base_url(); ?>game/stadium_category/save">
                                <input type="hidden" name="category_id" value="<?php if (isset($category_details->id)) {
                                                                                    echo $category_details->id;
                                                                                } ?>">
                                <div class="form-header stuck-header">
                                    <div class="form-header-inner">
                                        <?php if (!empty($category_details)) { ?>
                                            <div class="left">
                                                <h3>Edit Stadium Category</h3>
                                            </div>
                                        <?php	} else { ?>
                                            <div class="left">
                                                <h3>Create New Stadium Category</h3>
                                            </div>
                                        <?php } ?>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url(); ?>game/seat_category" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                        <i class="lnir lnir-arrow-left rem-100"></i>
                                                    </span>
                                                    <span>Cancel</span>
                                                </a>
                                                <button id="save-button" class="button h-button is-primary is-raised">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <!--Fieldset-->
                                    <div class="form-fieldset">
                                        <div class="fieldset-heading">
                                            <h4>Seat Category Info</h4>
                                        </div>

                                        <div class="columns is-multiline">
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>Seat Position</label>
                                                    <div class="control ">
                                                        <input type="text" class="input" minlength="2" placeholder="Seat Position" id="seat_position" name="seat_position" required value="<?php if (isset($category_details->seat)) {
                                                                                                                                                                                                echo $category_details->seat;
                                                                                                                                                                                            } ?>">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label>For event</label>
                                                    <div class="control has-icon">
                                                        <div class="select">
                                                            <select name="event" id="event" required>
                                                                <option value="match" <?php if (isset($category_details->event_type)) {
                                                                                            if ($category_details->event_type == 'match') {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>>Match</option>
                                                                <option value="other" <?php if (isset($category_details->event_type)) {
                                                                                            if ($category_details->event_type == 'other') {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>>Other</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-6">
                                                <div class="field">
                                                    <label> Status </label>
                                                    <div class="control has-icon">
        														<div class="switch-block no-padding-all">
        															<label class="form-switch is-primary">
        																<input type="checkbox" class="is-switch" name="is_status" value="1" <?php if (isset($category_details->status)) { if ($category_details->status == 1) { ?> checked <?php }																											} ?>>
        																<i></i>
        															</label>
        															<div class="text">
        																<span>Inactive / Active</span>
        															</div>
        														</div>
        													</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--Fieldset-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('common/footer'); ?>
