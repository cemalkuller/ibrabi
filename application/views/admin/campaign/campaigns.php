<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>
	</div><!-- /.box-header -->

	<div class="box-body">
		<div class="row">
			<!-- include message block -->
			<div class="col-sm-12">
				<?php $this->load->view('admin/includes/_messages'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped" role="grid">
						<thead>
						<tr role="row">
							<th><?php echo trans('id'); ?></th>
                            <th>Fotoğraf</th>
							<th>Kampanya Adı</th>
							<th><?php echo trans('date'); ?></th>
							<th class="max-width-120"><?php echo trans('options'); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($campaigns as $item): ?>
							<tr>
								<td><?php echo $item->id; ?></td>
								<td><img src="<?php echo site_url($item->image); ?>" width="200" /></td>
                                <td><?php echo $item->title; ?></td>
								<td><?php echo formatted_date($item->created_at); ?></td>
								<td>
									<div class="dropdown">
										<button class="btn bg-purple dropdown-toggle btn-select-option"
												type="button"
												data-toggle="dropdown"><?php echo trans('select_option'); ?>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu options-dropdown">
											<li>
												<a href="<?php echo site_url('admin/update-campaign/'.$item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
												<a href="javascript:void(0)" onclick="delete_item('admin_controller/delete_campaign_post','<?php echo $item->id; ?>','<?php echo trans("confirm_delete"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
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
