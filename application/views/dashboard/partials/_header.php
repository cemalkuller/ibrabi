<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?> | Mağaza Paneli</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/album/album.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/dashboard.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="<?php echo site_url('assets/js/dashboard.js') ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/script-1.6.js') ?>"></script>
    <script>
        $('<input>').attr({type: 'hidden', name: 'sys_lang_id', value: '<?php echo $this->selected_lang->id; ?>'}).appendTo('form');
        $('#form-product-filters input[name=sys_lang_id]').remove();
    </script>
    <script>var sys_lang_id = '<?php echo $this->selected_lang->id; ?>';var base_url = '<?php echo base_url(); ?>';var lang_base_url = '<?php echo lang_base_url(); ?>';var thousands_separator = '<?php echo $this->thousands_separator; ?>';var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';var txt_processing = '<?php echo trans("processing"); ?>';var sweetalert_ok = '<?php echo trans("ok"); ?>';var sweetalert_cancel = '<?php echo trans("cancel"); ?>';</script>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #273142!important;">
        <a class="navbar-brand pl-3 pr-3" href="<?php echo site_url('dashboard'); ?>">iBrabi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto ml-5">

                <li class="nav-item ml-3"><a class="nav-link" href="<?php echo site_url('dashboard') ?>">GENEL BAKIŞ</a></li>

                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ÜRÜN YÖNETİMİ</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                      <a class="dropdown-item" href="<?php echo site_url('dashboard/add-product'); ?>">YENİ ÜRÜN EKLE</a>
                      <a class="dropdown-item" href="<?php echo site_url('dashboard/products'); ?>">ÜRÜN LİSTESİ</a>
                      <a class="dropdown-item" href="<?php echo site_url('dashboard/upload-product'); ?>">TOPLU ÜRÜN YÜKLEME</a>
                      <a class="dropdown-item" href="<?php echo site_url('dashboard/trendyol'); ?>">TRENDYOL'DAN ÜRÜN AKTAR</a>
                      <!--<a class="dropdown-item" href="#">GÖRSEL GALERİSİ</a>
                      <a class="dropdown-item" href="#">BELGE İŞLEMLERİ</a>-->
                    </div>
                </li>
                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SİPARİŞLER</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/orders'); ?>">DEVAM EDEN SİPARİŞLER</a>
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/completed-orders'); ?>">TAMAMLANAN SİPARİŞLER</a>
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/canceled-orders'); ?>">İPTAL EDİLENLER</a>
                        <a class="dropdown-item" href="#">İADE İŞLEMLERİ</a>
                        <!-- <a class="dropdown-item" href="#">TOPLU SİPARİŞ İŞLEMLERİ</a>
                        <a class="dropdown-item" href="#">SİPARİŞ SORULARI</a>
                        <a class="dropdown-item" href="#">SİPARİŞ FATURA LİSTESİ</a>
                        <a class="dropdown-item" href="#">iBrabi E-FATURAM</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ÖDEME VE FATURA</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/earnings'); ?>">ÖDEME İŞLEMLERİ</a>
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/set-payout-account'); ?>">ÖDEME HESABI</a>
                        <!-- <a class="dropdown-item" href="#">GÜNLÜK KAYITLAR</a>
                        <a class="dropdown-item" href="#">FATURA LİSTELEME</a>
                        <a class="dropdown-item" href="#">EKSTRE LİSTELEME</a>
                        <a class="dropdown-item" href="#">ÖDEME İŞLEMLERİ</a>
                        <a class="dropdown-item" href="#">CARİ HESAP EKSTRESİ</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PROMOSYONLAR</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="<?php echo site_url('dashboard/campaigns'); ?>">KAMPANYALAR</a>
                    <!-- <a class="dropdown-item" href="#">KUPONLARIM</a>
                    <a class="dropdown-item" href="#">İNDİRİM OLUŞTUR</a>
                    <a class="dropdown-item" href="#">TEKLİFLERİM</a> -->
                    </div>
                </li>
                <li class="nav-item ml-3"><a class="nav-link" href="<?php echo site_url('dashboard/reviews'); ?>">DEĞERLENDİRMELER</a></li>
                <li class="nav-item ml-3"><a class="nav-link" href="<?php echo site_url('dashboard/shop-settings'); ?>">MAĞAZA YÖNETİMİ</a></li>
                <!-- <li class="nav-item ml-3"><a class="nav-link" href="#">REKLAM YÖNETİMİ</a></li> -->
            </ul>
            <!-- <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search">
            </form> -->
            <nav class="my-2 my-md-0 mr-md-3 navbar-nav right-navbar">
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-life-ring"></i> DESTEK</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('/'); ?>" class="nav-link"><i class="fas fa-link"></i> SİTEYE GİT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo get_shop_name($this->auth_user); ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="<?php echo site_url('dashboard/shop-settings'); ?>">MAĞAZA YÖNETİMİ</a>
                    <a class="dropdown-item" href="<?php echo site_url('settings/update-profile'); ?>">KULLANICI YÖNETİMİ</a>
                    <!-- <a class="dropdown-item" href="#">KARGO İŞLEMLERİ</a> -->
                    <a class="dropdown-item" href="#">ÇIKIŞ YAP</a>
                    </div>
                </li>
            </nav>
        </div>
        </nav>
    </header>