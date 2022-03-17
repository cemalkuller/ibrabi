<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
			<div class="box-header with-border">
				<div class="left">
					<h3 class="box-title">Kampanya Ekle</h3>
				</div>
				<div class="right">
					<a href="<?php echo admin_url(); ?>campaigns" class="btn btn-success btn-add-new">
						<i class="fa fa-list-ul"></i>&nbsp;&nbsp;Kampanyalar
					</a>
				</div>
			</div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/add_campaign_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('title'); ?></label>
                    <input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
                           value="<?php echo old('title'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('image'); ?></label>
                    <div class="display-block">
                        <a class='btn btn-success btn-sm btn-file-upload'>
                            <?php echo trans('select_image'); ?>
                            <input type="file" id="Multifileupload" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" required>
                        </a>
                    </div>

                    <div id="MultidvPreview" class="image-preview"></div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Kampanya Ekle</button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>



