
<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;">Trendyol'dan ürünlerinizi aktarın</h1>
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

                                        <div class="alert alert-primary" role="alert">
                                        Trendyol bilgilerinizi girdikten sonra ürünleriniz otomatik olarak Trendyol üzerinden sitemize eklenmeye başlayacatır.<br />
                                        <a href="<?php echo site_url('dashboard/products') ?>">Ürün Listesi</a> sayfasından kontrol edebilirsiniz.<br />
                                        Buradaki bilgilere Trendyol paneli üzerinden <a href="https://partner.trendyol.com/account/info">Entegrasyon Bilgileri</a> sayfasından ulaşabilirsiniz.
                                        </div>

                                </div>
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-12">

                                    <?php echo form_open_multipart("dashboard_controller/trendyol_post"); ?>

                                    <div class="form-box">
                                        <div class="form-box-body">

                                            <div class="form-group">
                                                <label class="control-label">Trendyol Api Key</label>
                                                <input type="text" name="trendyol_api_key" class="form-control form-input" value="<?php echo html_escape($user->trendyol_api_key); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Trendyol Api Secret</label>
                                                <input type="text" name="trendyol_api_secret" class="form-control form-input" value="<?php echo html_escape($user->trendyol_api_secret); ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Trendyol Satıcı Id</label>
                                                <input type="text" name="supplier_id" class="form-control form-input" value="<?php echo html_escape($user->supplier_id); ?>" required>
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

                <?php if($total > 0): ?>
                <div class="alert alert-secondary" role="alert">
                    Trendyol üzerinden toplam <strong><?php echo $total; ?></strong> ürününüz aktarılmıştır. Aşağıdan ürünlerinizin kategorilerini seçmeniz gerekmektedir.
                </div>
                
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">ÜRÜN KODU</th>
                        <th scope="col">FOTOĞRAF</th>
                        <th scope="col">ÜRÜN ADI</th>
                        <th scope="col">KATEGORİ</th>
                        <th scope="col">FİYAT</th>
                        <th scope="col">STOK</th>
                        <th scope="col">İŞLEMLER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td scope="row"><?php echo $product->id; ?></td>
                            <td width="50">
                                <img src="<?php echo get_product_image($product->id, 'image_small'); ?>" class="img-fluid" style="height:70px;width:50px;object-fit: cover;">
                            </td>
                            <td>
                                <a href="<?php echo generate_product_url($product); ?>" target="_blank">
                                    <?php echo $product->title; ?>
                                </a>
                            </td>
                            <td><?php echo $this->category_model->get_category($product->category_id)->name; ?></td>
                            <td><?php echo price_formatted($product->price, $product->currency); ?></td>
                            <td><?php echo $product->stock; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    İşlemler
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="<?php echo site_url('dashboard/edit-product/'.$product->id); ?>">Düzenle</a>
                                    <a href="#" onclick="delete_item('product_admin_controller/delete_product','<?php echo $product->id; ?>','Silmek istediğinize emin misiniz?');" class="dropdown-item">Sil</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

</div>
</main>
