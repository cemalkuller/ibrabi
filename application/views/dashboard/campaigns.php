
<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;"><?php echo $title; ?></h1>
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
                                </div>
                            </div>
                            
                            <div class="row mb-5">

                                <div class="col-12 ml-3 mr-3">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Görsel</th>
                                                <th scope="col">Kampanya</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($campaigns as $campaign): ?>
                                            <tr>
                                                <td align="center"><img src="<?php echo site_url($campaign->image); ?>" width="400" /></td>
                                                <td><?php echo $campaign->title; ?></td>
                                                <td><a href="#" class="btn btn-secondary text-light">Ürün Ekle</a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->

</div>
</main>
