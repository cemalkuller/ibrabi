<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;">ÜRÜN BİLGİLERİ</h1>
<div class="ml-3 mr-3">
    <!-- Wrapper -->
<div id="wrapper">
    <div>
        <div class="row">
            <div id="content" class="col-12">
                <!-- <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb"></ol>
                </nav> -->
                <!-- <?php if ($product->is_draft == 1): ?>
                    <h1 class="page-title page-title-product"><?php echo trans("sell_now"); ?></h1>
                <?php else: ?>
                    <h1 class="page-title page-title-product"><?php echo trans("edit_product"); ?></h1>
                <?php endif; ?> -->
                <div class="form-add-product">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-12">
                                    <!-- include message block -->
                                    <?php $this->load->view('product/_messages'); ?>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-12">

                                    <!-- form start -->
                                    <?php echo form_open('dashboard_controller/edit_product_details_post', ['id' => 'form_validate', 'class' => 'validate_price', 'class' => 'validate_terms', 'onkeypress' => "return event.keyCode != 13;"]); ?>
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                                    <?php if (!empty($custom_field_array) || ($this->form_settings->product_conditions == 1 && $product->product_type == 'physical') || ($this->form_settings->quantity == 1) && $product->product_type == 'physical'): ?>
                                        <div class="form-box">
                                            <div class="form-box-body">
                                                <?php if ($product->product_type == 'physical'): ?>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <?php if ($this->form_settings->product_conditions == 1) : ?>
                                                                <div class="col-12 col-sm-6 m-b-sm-15">
                                                                    <label class="control-label"><?php echo trans('condition'); ?></label>
                                                                    <?php $product_conditions = get_grouped_product_conditions();
                                                                    if (!empty($product_conditions)): ?>
                                                                        <div class="selectdiv">
                                                                            <select name="product_condition" class="form-control" <?php echo ($this->form_settings->product_conditions_required == 1) ? 'required' : ''; ?>>
                                                                                <option value=""><?php echo trans('select_option'); ?></option>
                                                                                <?php foreach ($product_conditions as $option):
                                                                                    $product_condition = get_product_condition_by_lang($option->common_id, $this->selected_lang->id); ?>
                                                                                    <option value="<?php echo $product_condition->option_key; ?>" <?php echo ($product->product_condition == $product_condition->option_key) ? 'selected' : ''; ?>><?php echo $product_condition->option_label; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if ($this->form_settings->quantity == 1) : ?>
                                                                <div class="col-12 col-sm-6">
                                                                    <label class="control-label"><?php echo trans('stock'); ?></label>
                                                                    <input type="number" name="stock" class="form-control form-input" min="0" max="999999999" value="<?php echo $product->stock; ?>" placeholder="<?php echo trans("stock"); ?>" <?php echo ($this->form_settings->quantity_required == 1) ? 'required' : ''; ?>>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group m-0">
                                                    <div class="row" id="custom_fields_container">
                                                        <?php if (isset($custom_field_array)) {
                                                            $this->load->view("product/_custom_fields", ["custom_fields" => $custom_field_array]);
                                                        } ?>
                                                    </div>
                                                </div>
                                                
                                                <!--Brand-->
                                                <div class="form-group m-0">
                                                    <div class="row" id="custom_fields_container">
                                                        <div class="col-6 col-custom-field">
                                                            <label class="control-label">Marka</label>
                                                            <div class="selectdiv">
                                                                <select name="brand_id" class="form-control">
                                                                    <option value=""><?php echo trans('select_option'); ?></option>
                                                                    <?php foreach ($brands as $brand): ?>
                                                                        <option value="<?php echo $brand->id; ?>" <?php echo ($brand->id == $product->brand_id) ? 'selected' : ''; ?>><?php echo $brand->title; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Brand-->

                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans("details"); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php if ($this->form_settings->quantity == 1) : ?>
                                                            <div class="col-12 col-sm-6">
                                                                <label class="control-label"><?php echo trans('stock'); ?></label>
                                                                <input type="number" name="stock" class="form-control form-input" min="0" max="999999999" value="<?php echo $product->stock; ?>" placeholder="<?php echo trans("stock"); ?>" <?php echo ($this->form_settings->quantity_required == 1) ? 'required' : ''; ?>>
                                                                <small><?php echo trans("digital_product_stock_exp"); ?>&nbsp;(i.e. 99999)</small>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <hr>
                                    <?php $this->load->view("dashboard/_edit_product_price"); ?>
                                    <hr>

                                    <?php if (($product->product_type == 'physical' && $this->form_settings->physical_demo_url == 1) || ($product->product_type == 'digital' && $this->form_settings->digital_demo_url == 1)): ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('demo_url'); ?></h4>
                                                <small><?php echo trans("demo_url_exp"); ?></small>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <input type="text" name="demo_url" class="form-control form-input" value="<?php echo html_escape($product->demo_url); ?>" placeholder="<?php echo trans("demo_url"); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row-custom">
                                        <div class="row">
                                            <?php if (($product->product_type == 'physical' && $this->form_settings->physical_video_preview == 1) || ($product->product_type == 'digital' && $this->form_settings->digital_video_preview == 1)): ?>
                                                <div class="col-12 col-sm-6 m-b-30">
                                                    <label class="control-label font-600"><?php echo trans("video_preview"); ?></label>
                                                    <small>(<?php echo trans("video_preview_exp"); ?>)</small>
                                                    <?php $this->load->view("product/_video_upload_box"); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (($product->product_type == 'physical' && $this->form_settings->physical_audio_preview == 1) || ($product->product_type == 'digital' && $this->form_settings->digital_audio_preview == 1)): ?>
                                                <div class="col-12 col-sm-6 m-b-30">
                                                    <label class="control-label font-600"><?php echo trans("audio_preview"); ?></label>
                                                    <small>(<?php echo trans("audio_preview_exp"); ?>)</small>
                                                    <?php
                                                    $audio = $this->file_model->get_product_audio($product->id);
                                                    $this->load->view("product/_audio_upload_box", ['audio' => $audio]); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if ($product->listing_type == 'ordinary_listing'): ?>
                                        <?php if ($this->form_settings->external_link == 1): ?>
                                            <div class="form-box">
                                                <div class="form-box-head">
                                                    <h4 class="title"><?php echo trans('external_link'); ?></h4>
                                                    <small><?php echo trans("external_link_exp"); ?></small>
                                                </div>
                                                <div class="form-box-body">
                                                    <div class="form-group">
                                                        <input type="text" name="external_link" class="form-control form-input" value="<?php echo html_escape($product->external_link); ?>" placeholder="<?php echo trans("external_link"); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($this->form_settings->variations == 1 && $product->product_type != 'digital' && $product->listing_type != 'ordinary_listing'): ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('variations'); ?></h4>
                                                <small><?php echo trans('variations_exp'); ?></small>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div id="response_product_variations" class="col-12 m-b-30">
                                                            <?php $this->load->view("product/variation/_response_variations", ["product_variations" => $product_variations]); ?>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#addVariationModal">
                                                                <?php echo trans("add_variation"); ?>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-secondary btn-variation" data-toggle="modal" data-target="#variationModalSelect">
                                                                <?php echo trans("select_existing_variation"); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($this->form_settings->shipping == 1 && $product->product_type == 'physical'): ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('shipping'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php $shipping_options = get_grouped_shipping_options();
                                                        if (!empty($shipping_options)): ?>
                                                            <div class="col-12 col-sm-6 m-b-sm-15">
                                                                <label class="control-label"><?php echo trans('shipping_cost'); ?></label>
                                                                <div class="selectdiv">
                                                                    <select name="shipping_cost_type" class="form-control" onchange="if($(this).find(':selected').attr('data-shipping-cost')==1){$('.shipping-cost-container').show();}else{$('.shipping-cost-container').hide();}" <?php echo ($this->form_settings->shipping_required == 1) ? 'required' : ''; ?>>
                                                                        <option value=""><?php echo trans("select_option"); ?></option>
                                                                        <?php foreach ($shipping_options as $option):
                                                                            $shipping_option = get_shipping_option_by_lang($option->common_id, $this->selected_lang->id);
                                                                            if ($shipping_option->is_visible == 1): ?>
                                                                                <option value="<?php echo $shipping_option->option_key; ?>" data-shipping-cost="<?php echo $shipping_option->shipping_cost; ?>" <?php echo ($product->shipping_cost_type == $shipping_option->option_key) ? 'selected' : ''; ?>><?php echo $shipping_option->option_label; ?></option>
                                                                            <?php endif;
                                                                        endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="col-12 col-sm-6">
                                                            <label class="control-label"><?php echo trans('shipping_time'); ?></label>
                                                            <div class="selectdiv">
                                                                <select name="shipping_time" class="form-control" <?php echo ($this->form_settings->shipping_required == 1) ? 'required' : ''; ?>>
                                                                    <option value=""><?php echo trans("select_option"); ?></option>
                                                                    <option value="1_business_day" <?php echo ($product->shipping_time == "1_business_day") ? 'selected' : ''; ?>><?php echo trans("1_business_day"); ?></option>
                                                                    <option value="2_3_business_days" <?php echo ($product->shipping_time == "2_3_business_days") ? 'selected' : ''; ?>><?php echo trans("2_3_business_days"); ?></option>
                                                                    <option value="4_7_business_days" <?php echo ($product->shipping_time == "4_7_business_days") ? 'selected' : ''; ?>><?php echo trans("4_7_business_days"); ?></option>
                                                                    <option value="8_15_business_days" <?php echo ($product->shipping_time == "8_15_business_days") ? 'selected' : ''; ?>><?php echo trans("8_15_business_days"); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 m-t-15 shipping-cost-container" style="<?php echo ($this->settings_model->is_shipping_option_require_cost($product->shipping_cost_type) == 1) ? 'display:block;' : ''; ?>">
                                                            <label class="control-label"><?php echo trans('shipping_cost'); ?></label>
                                                            <div class="input-group">
                                                                <?php if ($this->payment_settings->default_product_currency != "all"): ?>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text input-group-text-currency" id="basic-addon3"><?php echo get_currency($this->payment_settings->default_product_currency); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <input type="text" name="shipping_cost" aria-describedby="basic-addon3" class="form-control form-input price-input" value="<?php echo get_price($product->shipping_cost, 'input'); ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-6 m-t-15 shipping-cost-container" style="<?php echo ($this->settings_model->is_shipping_option_require_cost($product->shipping_cost_type) == 1) ? 'display:block;' : ''; ?>">
                                                            <label class="control-label"><?php echo trans('shipping_cost_per_additional_product'); ?></label>
                                                            <div class="input-group">
                                                                <?php if ($this->payment_settings->default_product_currency != "all"): ?>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text input-group-text-currency" id="basic-addon3"><?php echo get_currency($this->payment_settings->default_product_currency); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <input type="text" name="shipping_cost_additional" aria-describedby="basic-addon3" class="form-control form-input price-input" value="<?php echo get_price($product->shipping_cost_additional, 'input'); ?>" placeholder="<?php echo $this->input_initial_price; ?>" onpaste="return false;" maxlength="32" required>
                                                            </div>
                                                            <small><?php echo trans("shipping_cost_per_additional_product_exp"); ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($this->form_settings->product_location == 1 && $product->product_type == 'physical'):
                                        if ($product->country_id == 0) {
                                            $country_id = $this->auth_user->country_id;
                                            $state_id = $this->auth_user->state_id;
                                            $city_id = $this->auth_user->city_id;
                                            $address = $this->auth_user->address;
                                            $zip_code = $this->auth_user->zip_code;
                                        } else {
                                            $country_id = $product->country_id;
                                            $state_id = $product->state_id;
                                            $city_id = $product->city_id;
                                            $address = $product->address;
                                            $zip_code = $product->zip_code;
                                        }
                                        ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('location'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group m-0">
                                                    <?php $this->load->view("partials/_location", ['countries' => $this->countries, 'country_id' => $country_id, 'state_id' => $state_id, 'city_id' => $city_id, 'map' => true]); ?>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 m-b-sm-15">
                                                            <input type="text" name="address" id="address_input" class="form-control form-input" value="<?php echo html_escape($address); ?>" placeholder="<?php echo trans("address") ?>">
                                                        </div>

                                                        <div class="col-12 col-sm-3">
                                                            <input type="text" name="zip_code" id="zip_code_input" class="form-control form-input" value="<?php echo html_escape($zip_code); ?>" placeholder="<?php echo trans("zip_code") ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="map-result">
                                                        <!--load map-->
                                                        <?php
                                                        if ($product->country_id == 0) {
                                                            $this->load->view("product/_load_map", ["map_address" => get_location($this->auth_user)]);
                                                        } else {
                                                            $this->load->view("product/_load_map", ["map_address" => get_location($product)]);
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group m-t-15">
                                        <div class="custom-control custom-checkbox custom-control-validate-input">
                                            <?php if ($product->is_draft == 1): ?>
                                                <input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" required>
                                            <?php else: ?>
                                                <input type="checkbox" class="custom-control-input" name="terms_conditions" id="terms_conditions" value="1" checked>
                                            <?php endif; ?>
                                            <?php $page_terms_condition = get_page_by_default_name("terms_conditions", $this->selected_lang->id); ?>
                                            <label for="terms_conditions" class="custom-control-label"><?php echo trans("terms_conditions_exp"); ?>&nbsp;<a href="<?php echo lang_base_url() . $page_terms_condition->slug; ?>" class="link-terms" target="_blank"><strong><?php echo html_escape($page_terms_condition->title); ?></strong></a></label>
                                        </div>
                                    </div>

                                    <div class="form-group m-t-15">
                                        <?php if ($product->is_draft == 1): ?>
                                            <a href="<?php echo site_url("dashboard/edit-product/". $product->id); ?>" class="btn btn-lg btn-custom float-left"><?php echo trans("back"); ?></a>
                                            <button type="submit" name="submit" value="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("submit"); ?></button>
                                            <button type="submit" name="submit" value="save_as_draft" class="btn btn-lg btn-secondary color-white float-right m-r-10"><?php echo trans("save_as_draft"); ?></button>
                                        <?php else: ?>
                                            <a href="<?php echo site_url("dashboard/edit-product/". $product->id); ?>" id="btn_tab_product_images" class="btn btn-info float-left"><?php echo trans("back"); ?></a>
                                            <button type="submit" name="submit" value="save_changes" class="btn btn-primary float-right"><?php echo trans("save_changes"); ?></button>
                                        <?php endif; ?>
                                    </div>
                                    <?php echo form_close(); ?><!-- form end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->
</div>
</main>
