
<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;"><?php echo trans("shop_settings"); ?></h1>
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
                            
                            <div class="row mb-5">
                                <div class="col-12">

                                    <?php echo form_open_multipart("dashboard_controller/shop_settings_post"); ?>
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                                    <div class="form-box">
                                        <div class="form-box-body">

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("shop_name"); ?></label>
                                                <input type="text" name="shop_name" class="form-control form-input" value="<?php echo html_escape($user->shop_name); ?>" placeholder="<?php echo trans("shop_name"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("shop_description"); ?></label>
                                                <input type="text" name="about_me" class="form-control form-input" value="<?php echo html_escape($user->about_me); ?>" placeholder="<?php echo trans("shop_description"); ?>&nbsp;(<?php echo trans("optional"); ?>)">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("category"); ?></label>
                                                <div class="selectdiv">
                                                    <select id="categories" name="store_category" class="form-control" onchange="get_subcategories(this.value, 0);" required>
                                                        <option value=""><?php echo trans('select_category'); ?></option>
                                                        <?php foreach ($this->parent_categories as $item):
                                                            if (!empty($user->store_category) && $item->id == $user->store_category):?>
                                                                <option value="<?php echo $item->id; ?>" selected><?php echo category_name($item); ?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo $item->id; ?>"><?php echo category_name($item); ?></option>
                                                            <?php endif;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                                <!-- <div id="subcategories_container">
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
                                                </div> -->
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("email"); ?></label>
                                                <input type="text" name="email" class="form-control form-input" value="<?php echo html_escape($user->email); ?>" placeholder="<?php echo trans("email"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("phone"); ?></label>
                                                <input type="text" name="phone_number" class="form-control form-input" value="<?php echo html_escape($user->phone_number); ?>" placeholder="<?php echo trans("phone"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("first_name"); ?></label>
                                                <input type="text" name="first_name" class="form-control form-input" value="<?php echo html_escape($user->first_name); ?>" placeholder="<?php echo trans("first_name"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("last_name"); ?></label>
                                                <input type="text" name="last_name" class="form-control form-input" value="<?php echo html_escape($user->last_name); ?>" placeholder="<?php echo trans("last_name"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("address"); ?></label>
                                                <input type="text" name="address" class="form-control form-input" value="<?php echo html_escape($user->address); ?>" placeholder="<?php echo trans("address"); ?>" required>
                                            </div>


                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="same-address">
                                                <label class="custom-control-label" for="same-address">Mağaza tatil modu aktif edilsin</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info float-right mr-2"><?php echo trans("save_changes"); ?></button>
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

</div>
</main>
