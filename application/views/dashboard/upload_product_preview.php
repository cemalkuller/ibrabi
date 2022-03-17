<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;">ÜRÜN LİSTESİ</h1>
<div class="ml-3 mr-3">
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
                <img src="<?php echo get_product_item_image($product); ?>" class="img-fluid" style="height:70px;width:50px;object-fit: cover;">
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
                    <a class="dropdown-item" href="#">Sil</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
</main>
