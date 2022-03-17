
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

                                    <?php echo form_open_multipart("dashboard_controller/set_iban_payout_account_post"); ?>
                                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                                    <div class="form-box">
                                        <div class="form-box-body">

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("full_name"); ?>*</label>
                                                <input type="text" name="iban_full_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_full_name); ?>" placeholder="<?php echo trans("full_name"); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("bank_name"); ?></label>
                                                <input type="text" name="iban_bank_name" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_bank_name); ?>" placeholder="<?php echo trans("bank_name"); ?>&nbsp;(<?php echo trans("optional"); ?>)">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("country"); ?></label>
                                                <div class="selectdiv">
                                                    <select id="categories" name="iban_country_id" class="form-control" onchange="get_subcategories(this.value, 0);" required>
                                                        <option value=""><?php echo trans('select_category'); ?></option>
                                                        <?php foreach ($this->countries as $item): ?>
                                                            <option value="<?php echo $item->id; ?>" <?php echo ($user_payout->iban_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><?php echo trans("iban_long"); ?>(<?php echo trans("iban"); ?>)*</label>
                                                <input type="text" name="iban_number" class="form-control form-input" value="<?php echo html_escape($user_payout->iban_number); ?>" placeholder="<?php echo trans("iban"); ?>" required>
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
