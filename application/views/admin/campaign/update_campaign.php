<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/update_campaign_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <input type="hidden" name="id" value="<?php echo html_escape($item->id); ?>">

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo html_escape($item->title); ?>" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <div class="display-block m-b-15">
                        <img src="<?php echo site_url($item->image); ?>" alt="" style="height: 200px;"/>
                    </div>
                    <div class="display-block">
                        <a class='btn btn-success btn-sm btn-file-upload'>
                            <?php echo trans('select_image'); ?>
                            <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .jpg, .jpeg, .gif">
                        </a>
                    </div>

                    <div id="MultidvPreview" class="image-preview"></div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
