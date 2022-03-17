<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $animation_array = ["none", "bounce", "flash", "pulse", "rubberBand", "shake", "swing", "tada", "wobble", "jello", "heartBeat", "bounceIn", "bounceInDown", "bounceInLeft",
	"bounceInRight", "bounceInUp", "fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig", "flip",
	"flipInX", "flipInY", "lightSpeedIn", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight", "slideInUp", "slideInDown", "slideInLeft",
	"slideInRight", "zoomIn", "zoomInDown", "zoomInLeft", "zoomInRight", "zoomInUp", "hinge", "jackInTheBox", "rollIn"]; ?>

<div class="row">
	<div class="col-lg-5 col-md-12">
		<div class="box box-primary">
			<!-- /.box-header -->
			<div class="box-header with-border">
				<h3 class="box-title">Marka Ekle</h3>
			</div><!-- /.box-header -->

			<!-- form start -->
			<?php echo form_open_multipart('banner_admin_controller/add_banner_post'); ?>
			<input type="hidden" name="type" value="3">

			<div class="box-body">
				<!-- include message block -->
				<?php if (empty($this->session->flashdata("msg_settings"))):
					$this->load->view('admin/includes/_messages_form');
				endif; ?>
				<div class="form-group">
					<label><?php echo trans("language"); ?></label>
					<select name="lang_id" class="form-control">
						<?php foreach ($this->languages as $language): ?>
							<option value="<?php echo $language->id; ?>" <?php echo ($this->selected_lang->id == $language->id) ? 'selected' : ''; ?>><?php echo $language->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label"><?php echo trans('title'); ?></label>
					<input type="text" class="form-control" name="title" placeholder="<?php echo trans('title'); ?>"
						   value="<?php echo old('title'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
				</div>
				<div class="form-group">
					<label class="control-label"><?php echo trans('link'); ?></label>
					<input type="text" class="form-control" name="link" placeholder="<?php echo trans('link'); ?>"
						   value="<?php echo old('link'); ?>" <?php echo ($this->rtl == true) ? 'dir="rtl"' : ''; ?>>
				</div>

				<div class="form-group">
					<label class="control-label"><?php echo trans('image'); ?> (200x200)</label>
					<div class="display-block">
						<a class='btn btn-success btn-sm btn-file-upload'>
							<?php echo trans('select_image'); ?>
							<input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" required onchange="show_preview_image(this);">
						</a>
					</div>
					<img src="<?php echo IMG_BASE64_1x1; ?>" id="img_preview_file" class="img-file-upload-preview">
				</div>

			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right">Marka Ekle</button>
			</div>
			<!-- /.box-footer -->
			<?php echo form_close(); ?><!-- form end -->
		</div>
	</div>

	<div class="col-lg-7 col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Markalar</h3>
			</div><!-- /.box-header -->

			<!-- include message block -->
			<div class="col-sm-12">
				<?php $this->load->view('admin/includes/_messages'); ?>
			</div>

			<div class="box-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped dataTable" id="cs_datatable_lang" role="grid"
								   aria-describedby="example1_info">
								<thead>
								<tr role="row">
									<th width="20"><?php echo trans('id'); ?></th>
									<th><?php echo trans('image'); ?></th>
									<th><?php echo trans('language'); ?></th>
									<th><?php echo trans('order'); ?></th>
									<th class="th-options"><?php echo trans('options'); ?></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($banners as $item): ?>
									<tr>
										<td><?php echo html_escape($item->id); ?></td>
										<td>
											<img src="<?php echo base_url() . $item->image; ?>" alt="" style="width: 75px;"/>
										</td>
										<td>
											<?php
											$language = get_language($item->lang_id);
											if (!empty($language)) {
												echo $language->name;
											} ?>
										</td>
										<td><?php echo $item->item_order; ?></td>

										<td>
											<div class="dropdown">
												<button class="btn bg-purple dropdown-toggle btn-select-option"
														type="button"
														data-toggle="dropdown"><?php echo trans('select_option'); ?>
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu options-dropdown">
													<li>
														<a href="<?php echo admin_url(); ?>update-banner/<?php echo html_escape($item->id); ?>/3"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
													</li>
													<li>
														<a href="javascript:void(0)" onclick="delete_item('banner_admin_controller/delete_main_banner_post','<?php echo $item->id; ?>','Silmek istediğinize emin misiniz?');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
													</li>
												</ul>
											</div>
										</td>
									</tr>

								<?php endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div>
	</div>
</div>
