<main role="main" class="dashboard-main pb-5">
<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="dashboard-title">Toplu Ürün Yükleyin</h1>
      <p class="lead">Ürünlerinizi yükleyerek hemen satış yapmaya başlayın</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="dashboard-box bg-light">
                <img src="<?php echo site_url('assets/img/excel-icon.png'); ?>" width="100">
                <h2 class="mt-3">Excel Şablonunu İndir</h2>
                <p>Excel şablonunu inceleyerek ürün şablonunuzu oluşturun</p>
                <p><a class="btn btn-secondary" href="javascript:void()" onclick="$('.excel_download_form').toggle();">Şablonu İndir »</a></p>
                <?php echo form_open_multipart(site_url('dashboard_controller/bulk_product_upload'), ['id' => 'form_validate', 'class' => "excel_download_form", 'style' => "display:none"]); ?><hr />
                    <div class="col-lg-12">
                        
                        <div class="form-group">
                            <div class="selectdiv">
                                <select id="categories" name="category_id" class="form-control" onchange="get_subcategories(this.value);" required>
                                    <option value=""><?php echo trans('select_category'); ?></option>
                                    <?php if (!empty($this->parent_categories)):
                                        foreach ($this->parent_categories as $item): ?>
                                            <option value="<?php echo html_escape($item->id); ?>"><?php echo category_name($item); ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div id="subcategories_container">
                                <select id="subcategories" name="subcategory_id" class="form-control" onchange="get_thirdcategories(this.value);" style="display: none">
                                </select>
                                <select id="thirdcategories" name="thirdcategory_id" class="form-control" style="display: none">
                                </select>
                            </div>

                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <input type="submit" id="upload_btn" class="btn btn-secondary btn-block" value="<?php echo trans('download'); ?>">
                    </div> 
                <?php echo form_close(); ?>
            </div>
        </div><!-- /.col-lg-4 -->

        <div class="col-lg-4">
            <div class="dashboard-box bg-light">
                <img src="<?php echo site_url('assets/img/excel-icon2.png'); ?>" width="100">
                <h2 class="mt-3">Excel Yükleyin</h2>
                <p>Hazırlamış olduğunuz Excel şablonunu hemen yükleyin</p>
                <p><a class="btn btn-secondary" href="javascript:void()" onclick="$('.excel_upload_form').toggle();" role="button">Excel Yükle »</a></p>
                <!-- <form action="<?php echo base_url();?>dashboard_controller/bulk_product_upload" method="post" enctype="multipart/form-data" class="excel_upload_form" style="display: none"> -->
                <?php echo form_open_multipart(site_url('dashboard_controller/bulk_product_upload'), ['id' => 'form_validate', 'class' => "excel_upload_form", 'style' => "display:none"]); ?><hr />
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="selectdiv">
                                <select name="upload_type" class="form-control" required>
                                    <option value="new_product">Yeni Ürün Ekle</option>
                                    <option value="update_product">Ürün Güncelle</option>
                                    <option value="stock_price_update">Stok & Fiyat Güncelle</option>
                                    <option value="delete_product">Ürün Silme</option>
                                    <!-- <option value="new_product">Ürün Arşive Alma</option>
                                    <option value="new_product">Ürün Arşivden Kaldırma</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="selectdiv">
                                <select id="categories" name="category_id" class="form-control" onchange="get_subcategories(this.value);" required>
                                    <option value=""><?php echo trans('select_category'); ?></option>
                                    <?php if (!empty($this->parent_categories)):
                                        foreach ($this->parent_categories as $item): ?>
                                            <option value="<?php echo html_escape($item->id); ?>"><?php echo category_name($item); ?></option>
                                        <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div id="subcategories_container">
                                <select id="subcategories" name="subcategory_id" class="form-control" onchange="get_thirdcategories(this.value);" style="display: none">
                                </select>
                                <select id="thirdcategories" name="thirdcategory_id" class="form-control" style="display: none">
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <!-- <input type="file" name="uploadFile" id="uploadFile" class="filestyle" data-icon="false"> -->
                            <div class="custom-file">
                                <input type="file" name="uploadFile" id="uploadFile" class="filestyle" required>
                                <label class="custom-file-label text-left" for="uploadFile">Dosya Seçin</label>
                                <div class="preview-xlsx mt-4"></div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <input type="submit" id="upload_btn" class="btn btn-secondary btn-block" value="Yükle">
                    </div> 
                <?php echo form_close(); ?>
            </div>
        </div><!-- /.col-lg-4 -->
    </div>
</div>
</main>

<script>
$('#uploadFile').change(function(){
    var filename = $('input[type=file]').val().split('\\').pop();
    $('.preview-xlsx').empty();
    $('.preview-xlsx').html('<img src="https://ibrabi.com/assets/img/excel-icon.png" width="25"> ' + filename);
});
function get_subcategories(parent_id) {
    var data = {
        "parent_id": parent_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        url: base_url + "category_controller/get_subcategories",
        type: "POST",
        data: data,
        success: function (response) {
            $('#subcategories').css('display', 'inherit');
            $('#subcategories').empty();
            $('#subcategories').append(response);
        }
    });
}

function get_thirdcategories(parent_id) {
    var data = {
        "parent_id": parent_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        url: base_url + "category_controller/get_subcategories",
        type: "POST",
        data: data,
        success: function (response) {
            $('#thirdcategories').css('display', 'inherit');
            $('#thirdcategories').empty();
            $('#thirdcategories').append(response);
        }
    });
}
</script>
