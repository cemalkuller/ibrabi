<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo $title; ?> - <?php echo $language->name; ?></h3>
        </div>
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
                    <table class="table table-bordered table-striped dataTable">
                        <?php $this->load->view('admin/language/_filter_translations'); ?>
                        <thead>
                        <tr role="row">
                            <th><?php echo trans('id'); ?></th>
                            <th><?php echo trans('phrase'); ?></th>
                            <th><?php echo trans('label'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($translations as $item): ?>
                            <tr class="tr-phrase">
                                <td style="width: 50px;"><?php echo $item->id; ?></td>
                                <td style="width: 40%;"><input type="text" class="form-control" value="<?php echo $item->label; ?>" <?php echo ($language->text_direction == "rtl") ? 'dir="rtl"' : ''; ?> readonly></td>
                                <td style="width: 60%;"><input type="text" data-label="<?php echo $item->label; ?>" data-lang="<?php echo $item->lang_id; ?>" class="form-control input_translation" value="<?php echo $item->translation; ?>" <?php echo ($language->text_direction == "rtl") ? 'dir="rtl"' : ''; ?>></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($translations)): ?>
                    <p class="text-center">
                        <?php echo trans("no_records_found"); ?>
                    </p>
                <?php endif; ?>
                <div class="col-sm-12 table-ft">
                    <div class="row">
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($language->text_direction == "rtl"): ?>
    <link href="<?php echo base_url(); ?>assets/admin/css/rtl.css" rel="stylesheet"/>
<?php endif; ?>
