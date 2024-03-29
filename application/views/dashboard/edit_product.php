<!-- File Manager -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/file-manager/file-manager.css">
<script src="<?php echo base_url(); ?>assets/vendor/file-manager/file-manager.js"></script>
<!-- Ckeditor js -->
<script src="<?php echo base_url(); ?>assets/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/ckeditor/lang/<?php echo $this->selected_lang->ckeditor_lang; ?>.js"></script>

<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;">ÜRÜN BİLGİLERİ</h1>
<div class="ml-3 mr-3">

<!-- Wrapper -->
<div id="wrapper">
    <div class="">
        <div class="row">
            <div id="content" class="col-12">

                <div class="form-add-product">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-12">
                                    <!-- include message block -->
                                    <?php $this->load->view('product/_messages'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 m-b-30">
                                    <label class="control-label font-600"><?php echo trans("images"); ?></label>
                                    <?php $this->load->view("product/_image_update_box"); ?>
                                </div>
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-12">
                                    <?php echo form_open('dashboard_controller/edit_product_post', ['id' => 'form_validate', 'class' => 'validate_price', 'onkeypress' => "return event.keyCode != 13;"]); ?>
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                                    <?php if ($this->general_settings->physical_products_system == 1 && $this->general_settings->digital_products_system == 0): ?>
                                        <input type="hidden" name="product_type" value="physical">
                                    <?php elseif ($this->general_settings->physical_products_system == 0 && $this->general_settings->digital_products_system == 1): ?>
                                        <input type="hidden" name="product_type" value="digital">
                                    <?php else: ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('product_type'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php if ($this->general_settings->physical_products_system == 1): ?>
                                                            <div class="col-12 col-sm-6 col-option">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="product_type" value="physical" id="product_type_1" class="custom-control-input" <?php echo ($product->product_type == 'physical') ? 'checked' : ''; ?> required>
                                                                    <label for="product_type_1" class="custom-control-label"><?php echo trans('physical'); ?></label>
                                                                    <p class="form-element-exp"><?php echo trans('physical_exp'); ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($this->general_settings->digital_products_system == 1): ?>
                                                            <div class="col-12 col-sm-6 col-option">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="product_type" value="digital" id="product_type_2" class="custom-control-input" <?php echo ($product->product_type == 'digital') ? 'checked' : ''; ?> required>
                                                                    <label for="product_type_2" class="custom-control-label"><?php echo trans('digital'); ?></label>
                                                                    <p class="form-element-exp"><?php echo trans('digital_exp'); ?></>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($active_product_system_array['active_system_count'] > 1): ?>
                                        <div class="form-box">
                                            <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('listing_type'); ?></h4>
                                            </div>
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php if ($this->general_settings->marketplace_system == 1): ?>
                                                            <div class="col-12 col-sm-6 col-option listing_sell_on_site">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="listing_type" value="sell_on_site" id="listing_type_1" class="custom-control-input" <?php echo ($product->listing_type == 'sell_on_site') ? 'checked' : ''; ?> required>
                                                                    <label for="listing_type_1" class="custom-control-label"><?php echo trans('add_product_for_sale'); ?></label>
                                                                    <p class="form-element-exp"><?php echo trans('add_product_for_sale_exp'); ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($this->general_settings->classified_ads_system == 1): ?>
                                                            <div class="col-12 col-sm-6 col-option listing_ordinary_listing <?php echo ($product->product_type == 'digital') ? 'hidden' : ''; ?>">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="listing_type" value="ordinary_listing" id="listing_type_2" class="custom-control-input" <?php echo ($product->listing_type == 'ordinary_listing') ? 'checked' : ''; ?> required>
                                                                    <label for="listing_type_2" class="custom-control-label"><?php echo trans('add_product_services_listing'); ?></label>
                                                                    <p class="form-element-exp"><?php echo trans('add_product_services_listing_exp'); ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($this->general_settings->bidding_system == 1): ?>
                                                            <div class="col-12 col-sm-6 col-option listing_bidding">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="listing_type" value="bidding" id="listing_type_3" class="custom-control-input" <?php echo ($product->listing_type == 'bidding') ? 'checked' : ''; ?> required>
                                                                    <label for="listing_type_3" class="custom-control-label"><?php echo trans('add_product_get_price_requests'); ?></label>
                                                                    <p class="form-element-exp"><?php echo trans('add_product_get_price_requests_exp'); ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <input type="hidden" name="listing_type" value="<?php echo $active_product_system_array['active_system_value']; ?>">
                                    <?php endif; ?>

                                    <div class="form-box">
                                        <!-- <div class="form-box-head">
                                            <h4 class="title"><?php echo trans('details'); ?></h4>
                                        </div> -->
                                        <div class="form-box-body">

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("title"); ?></label>
                                                <input type="text" name="title" class="form-control form-input" value="<?php echo html_escape($product->title); ?>" placeholder="<?php echo trans("title"); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("sku"); ?>&nbsp;(<?php echo trans("product_code"); ?>)</label>
                                                <input type="text" name="sku" class="form-control form-input" value="<?php echo html_escape($product->sku); ?>" placeholder="<?php echo trans("sku"); ?>&nbsp;(<?php echo trans("optional"); ?>)">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("category"); ?></label>
                                                <div class="selectdiv">
                                                    <select id="categories" name="category_id_0" class="form-control" onchange="get_subcategories(this.value, 0);" required>
                                                        <option value=""><?php echo trans('select_category'); ?></option>
                                                        <?php foreach ($this->parent_categories as $item):
                                                            if (!empty($parent_categories_array[0]) && $item->id == $parent_categories_array[0]->id):?>
                                                                <option value="<?php echo $item->id; ?>" selected><?php echo category_name($item); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo $item->id; ?>"><?php echo category_name($item); ?></option>
                                                            <?php endif;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                                <div id="subcategories_container">
                                                    <?php if (!empty($parent_categories_array)):
                                                        for ($i = 1; $i < count($parent_categories_array); $i++):
                                                            if (!empty($parent_categories_array[$i]) && !empty($category)):?>
                                                                <?php $subcategories = get_subcategories($this->categories, $parent_categories_array[$i]->parent_id);
                                                                if (!empty($subcategories)):?>
                                                                    <div class="selectdiv m-t-5">
                                                                        <select id="categories" name="category_id_<?php echo $i; ?>" class="form-control subcategory-select" data-select-id="<?php echo $i; ?>" onchange="get_subcategories(this.value, '<?php echo $i; ?>');" required>
                                                                            <option value=""><?php echo trans('select_category'); ?></option>
                                                                            <?php foreach ($subcategories as $subcategory): ?>
                                                                                <option value="<?php echo $subcategory->id; ?>" <?php echo ($subcategory->id == $parent_categories_array[$i]->id) ? 'selected' : ''; ?>> <?php echo category_name($subcategory); ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                <?php endif;
                                                            endif;
                                                        endfor;
                                                    endif; ?>

                                                    <?php $new_subcategories = get_subcategories($this->categories, $category->id);
                                                    if (!empty($new_subcategories) && !empty($category)):?>
                                                        <div class="selectdiv m-t-5">
                                                            <select id="categories" name="category_id_<?php echo $i + 1; ?>" class="form-control subcategory-select" data-select-id="<?php echo $i; ?>" onchange="get_subcategories(this.value, '<?php echo $i + 1; ?>');" required>
                                                                <option value=""><?php echo trans('select_category'); ?></option>
                                                                <?php foreach ($new_subcategories as $subcategory): ?>
                                                                    <option value="<?php echo $subcategory->id; ?>"><?php echo category_name($subcategory); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans('description'); ?></label>
                                                <div class="row">
                                                    <div class="col-sm-12 mb-2">
                                                        <button type="button" class="btn btn-sm btn-secondary color-white btn_ck_add_image"><i class="icon-image"></i><?php echo trans("add_image"); ?></button>
                                                        <button type="button" class="btn btn-sm btn-info color-white btn_ck_add_video"><i class="icon-image"></i><?php echo trans("add_video"); ?></button>
                                                        <button type="button" class="btn btn-sm btn-warning color-white btn_ck_add_iframe"><i class="icon-image"></i><?php echo trans("add_iframe"); ?></button>
                                                    </div>
                                                </div>
                                                <textarea name="description" id="ckEditor" class="text-editor"><?php echo $product->description; ?></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <?php if ($product->is_draft != 1 && is_admin()): ?>
                                        <div class="form-box">
                                            <!-- <div class="form-box-head">
                                                <h4 class="title"><?php echo trans('options'); ?></h4>
                                            </div> -->
                                            <div class="form-box-body">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo trans('visibility'); ?></label>
                                                    <div class="selectdiv">
                                                        <select name="visibility" class="form-control" required>
                                                            <option value="1" <?php echo ($product->visibility == 1) ? 'selected' : ''; ?>><?php echo trans('visible'); ?></option>
                                                            <option value="0" <?php echo ($product->visibility == 0) ? 'selected' : ''; ?>><?php echo trans('hidden'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <input type="hidden" name="visibility" value="<?php echo $product->visibility; ?>">
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <?php if ($product->is_draft == 1): ?>
                                            <button type="submit" class="btn btn-lg btn-custom float-right"><?php echo trans("save_and_continue"); ?></button>
                                        <?php else: ?>
                                            <a href="<?php echo site_url("dashboard/product-details/". $product->id); ?>" class="btn btn-primary float-right"><?php echo trans("edit_details"); ?></a>
                                            <button type="submit" class="btn btn-info float-right mr-2"><?php echo trans("save_changes"); ?></button>
                                        <?php endif; ?>
                                    </div>
                                    <?php echo form_close(); ?>
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

<script>
    function get_subcategories(category_id, data_select_id) {
        var subcategories = get_subcategories_array(category_id);
        var date = new Date();
        //reset subcategories
        $('.subcategory-select').each(function () {
            if (parseInt($(this).attr('data-select-id')) > parseInt(data_select_id)) {
                $(this).remove();
            }
        });
        if (category_id == 0) {
            return false;
        }
        if (subcategories.length > 0) {
            var new_data_select_id = date.getTime();
            var select_tag = '<div class="selectdiv m-t-5"><select class="form-control subcategory-select" data-select-id="' + new_data_select_id + '" name="category_id_' + new_data_select_id + '" required onchange="get_subcategories(this.value,' + new_data_select_id + ');">' +
                '<option value=""><?php echo trans("select_category"); ?></option>';
            for (i = 0; i < subcategories.length; i++) {
                select_tag += '<option value="' + subcategories[i].id + '">' + subcategories[i].name + '</option>';
            }
            select_tag += '</select></div>';
            $('#subcategories_container').append(select_tag);
        }
        //remove empty selectdivs
        $(".selectdiv").each(function () {
            if ($(this).children('select').length == 0) {
                $(this).remove();
            }
        });
    }

    function get_subcategories_array(category_id) {
        var categories_array = <?php echo get_categories_json($this->selected_lang->id); ?>;
        var subcategories_array = [];
        for (i = 0; i < categories_array.length; i++) {
            if (categories_array[i].parent_id == category_id) {
                subcategories_array.push(categories_array[i]);
            }
        }
        return subcategories_array;
    }
</script>

<?php $this->load->view("product/_file_manager_ckeditor"); ?>

<!-- Ckeditor -->
<script>
    var ckEditor = document.getElementById('ckEditor');
    if (ckEditor != undefined && ckEditor != null) {
        CKEDITOR.replace('ckEditor', {
            language: '<?php echo $this->selected_lang->ckeditor_lang; ?>',
            filebrowserBrowseUrl: 'path',
            removeButtons: 'Save',
            allowedContent: true,
            extraPlugins: 'videoembed,oembed'
        });
    }

    function selectFile(fileUrl) {
        window.opener.CKEDITOR.tools.callFunction(1, fileUrl);
    }

    CKEDITOR.on('dialogDefinition', function (ev) {
        var editor = ev.editor;
        var dialogDefinition = ev.data.definition;

        // This function will be called when the user will pick a file in file manager
        var cleanUpFuncRef = CKEDITOR.tools.addFunction(function (a) {
            $('#ckFileManagerModal').modal('hide');
            CKEDITOR.tools.callFunction(1, a, "");
        });
        var tabCount = dialogDefinition.contents.length;
        for (var i = 0; i < tabCount; i++) {
            var browseButton = dialogDefinition.contents[i].get('browse');
            if (browseButton !== null) {
                browseButton.onClick = function (dialog, i) {
                    editor._.filebrowserSe = this;
                    var iframe = $('#ckFileManagerModal').find('iframe').attr({
                        src: editor.config.filebrowserBrowseUrl + '&CKEditor=body&CKEditorFuncNum=' + cleanUpFuncRef + '&langCode=en'
                    });
                    $('#ckFileManagerModal').appendTo('body').modal('show');
                }
            }
        }
    });

    CKEDITOR.on('instanceReady', function (evt) {
        $(document).on('click', '.btn_ck_add_image', function () {
            if (evt.editor.name != undefined) {
                evt.editor.execCommand('image');
            }
        });
        $(document).on('click', '.btn_ck_add_video', function () {
            if (evt.editor.name != undefined) {
                evt.editor.execCommand('videoembed');
            }
        });
        $(document).on('click', '.btn_ck_add_iframe', function () {
            if (evt.editor.name != undefined) {
                evt.editor.execCommand('iframe');
            }
        });
    });
</script>

</div>
</main>
