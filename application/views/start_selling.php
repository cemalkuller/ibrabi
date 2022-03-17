<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 4rem;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  bottom: 3rem;
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;
  background-color: #777;
}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}


/* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
.marketing .col-lg-4 {
  margin-bottom: 1.5rem;
  text-align: center;
}
.marketing h2 {
  font-weight: 400;
}
.marketing .col-lg-4 p {
  margin-right: .75rem;
  margin-left: .75rem;
}


/* Featurettes
------------------------- */

.featurette-divider {
  margin: 5rem 0; /* Space out the Bootstrap <hr> more */
}

/* Thin out the marketing headings */
.featurette-heading {
  font-weight: 300;
  line-height: 1;
  letter-spacing: -.05rem;
}


/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 40em) {
  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 1.25rem;
    font-size: 1.25rem;
    line-height: 1.4;
  }

  .featurette-heading {
    font-size: 40px;
  }
}

@media (min-width: 62em) {
  .featurette-heading {
    margin-top: 3rem;
  }
}

</style>

<!-- Wrapper -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="position-relative overflow-hidden text-center">
            <div class="col-md-9 p-lg-5 mx-auto my-5">
                <h3 class="font-weight-normal">Yurtdışınden binlerce müşteriye e-ihracat ile satış yap </h3>
                <p class="lead font-weight-normal">Yüz binlerce müşteriye ulaşma fırsatı ve uygun teslimat ücretleri sunan iBrabi.Com ile birkaç adımda yurtdışına satış yapmaya başlayabilirsiniz</p>
                <a class="btn btn-outline-secondary" href="<?php echo site_url('basvuru-icin-gerekli-evraklar'); ?>">Başvuru için gerekli evraklar</a>
                <a class="btn btn-outline-secondary" href="<?php echo generate_url("start_selling"); ?>">ibrabi Satıcı Başvurusu</a>
            </div>
            <div class="product-device box-shadow d-none d-md-block"></div>
            <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- <img src="<?php echo site_url('assets/img/start-selling/icons.png'); ?>"> -->
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Uygun Fiyatlı Kargo Yapısı</h5>
                <p class="card-text">Yurtdışına satış sürecinde çoğu satıcının korkulu rüyası teslimat süreci iBrabi.com ile çok daha kolay!</p>
              </div>
            </div>
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Ücretsiz Mağaza Açılışı</h5>
                <p class="card-text">iBrabi'de tek tıkla ücretsiz bir şekilde mağazanızı açabilir, hemen ürünlerinizi satmaya başlayabilirsiniz.</p>
              </div>
            </div>
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Reklam Bütçeniz Bizden</h5>
                <p class="card-text">iBrabi.com olarak hem yürtiçinde,hem yurtdışına satış yapma yolculuğunuzda reklam maliyetlerinizi biz karşılıyor, reklam planlamalarını biz yürütüyoruz.</p>
              </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Dükkanınızı ücretsiz bir şekilde açın ve ürünlerinizi yükleyin</h5>
                <p class="card-text">•	Ücretsiz bir şekilde Birkaç basit adımla mağazanızı oluşturun ve ürünlerinizi listeleyin. Ürünlerinizin sisteme yüklenmesi ve mağazanızın optimizasyon sürecinde destek ekibimiz sizinle!
                <br>•	Firmanızı mikro ihracat ile yurtdışına açma sürecinde reklam bütçelerimizle ve destek ekibimizle yanınızdayız.
                </p>
              </div>
            </div>
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Müşteriler mağazanıza gelsin ve sipariş almaya başlayın</h5>
                <p class="card-text">•	iBrabi.com ürünleriniz için ayırdığı reklam bütçesi ve kategorilerinize özel reklam planlarımızla ücretsiz bir şekilde yeni müşteriler kazanın.
                <br>•	Yurtdışına satış yaparak siz de mikro ihracatçı olun, hem teşviklerin hem de döviz ile gelir elde etmenin ayrıcalıklarından yararlananın.
                </p>
              </div>
            </div>
            <div class="float-left col-4">
              <div class="card-body">
                <h5 class="card-title">Art Kargo güvencesi ile uygun fiyatlı ve kolay bir şekilde kargo gönderin</h5>
                <p class="card-text">•	Yurtdışına satış yaparken en büyük korkulardan biri olan yüksek maliyetli kargo süreçlerini Art Kargo güvencesi ile kolaylaştırın.
                <br>•	Size sağlayacağımız siparişe özel takip edilebilir kargo kodu ile teslimatınızı Aras Kargo  aracılığı ile saniyeler içinde gönderin.
                </p>
              </div>
            </div>
        </div>
    </div><hr />

    <div class="row">
      <!-- <h3 class="font-weight-normal">iBrabi'de satıcı olma sürecine dair aklınıza takılanlar...</h3> -->
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Herhangi bir ücret ödeyecek miyim?
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                Hayır,iBrabi’de mağazanızı açmak ücretsizdir.iBrabi mağaza açılışının yanı sıra ürünlerinize özel optimize edilmiş binlerce dolara varan reklam paketlerini tedarikçilerine ücretsiz bir şekilde sunar. iBrabi satıcıları, sadece ve sadece satış yaptığında %20 olmak üzere komisyon öder ve bu komisyon karşılığı uygun fiyatlı kargo gibi birçok konuda avantaj sağlar.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Yaptığım satışların ücretlerini nasıl tahsil ederim?
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                iBrabi satıcı paneliniz üzerinde yaptığınız satışları ve bakiyenizi rahatlıkla görüntüleyebilir,ayrıntılı analiz raporlarımızı inceleyebilirsiniz. Ayrıca güvenli ödeme altyapımız sayesinde istediğiniz miktarda bakiyeyi belirlediğiniz banka hesabına tek tıkla gönderebilirsiniz.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Ürünlerimi yurtdışına nasıl kargolayacağım?
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                Ürünlerinizi yurtdışına kargolamak için tek yapmanız gereken aldığınız sipariş sonucunda otomatik olarak oluşturulacak barkodu çıktı alıp anlaşmalı kargo sağlayıcılarımıza teslim etmek… Gönderileriniz Art Kargo çatısı altında 8’dan fazla ülkeye uygun fiyatlara hızlı bir şekilde teslim edilecektir.
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Ürünlerimi mağazama nasıl ekleyeceğim?
              </button>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
                Eğer popüler pazaryerlerinden herhangi birinde mağazanız bulunuyorsa ürünlerinizi tek tıkla sistemimize yükleyebilirsiniz. Ayrıca diğer durumlarda elinizdeki ürünleri mağazanıza eklemeniz için destek ekibimiz tüm süreçte sizin yanınızda…
            </div>
          </div>
        </div>
      </div>
    </div>

    <br>


    <!--
    <div class="row featurette mt-5">
        <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
        <img class="featurette-image img-fluid mx-auto" src="<?php echo site_url('assets/img/start-selling/image1.png'); ?>">
        </div>
    </div><hr />

    <div class="row featurette mt-5">
        <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5 order-md-1">
        <img class="featurette-image img-fluid mx-auto" src="<?php echo site_url('assets/img/start-selling/image2.png'); ?>">
        </div>
    </div>
    -->

</div>

<script>
    $(function () {
        $('.page-text-content iframe').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
        $('.page-text-content iframe').addClass('embed-responsive-item');
    });
</script>

