
<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;"><?php echo trans("earnings"); ?></h1>
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
                                <div class="col-6">

                                    <div class="card-deck mb-3 text-center">
                                        <div class="card mb-4 box-shadow">
                                            <div class="card-header">
                                                <h4 class="my-0 font-weight-normal"><?php echo trans('sales'); ?></h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title"><?php echo $user->number_of_sales; ?></h1>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li><?php echo trans("number_of_total_sales"); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card mb-4 box-shadow">
                                            <div class="card-header">
                                                <h4 class="my-0 font-weight-normal"><?php echo trans('balance'); ?></h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title"><?php echo price_formatted($user->balance, $this->payment_settings->default_product_currency); ?></h1>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li><?php echo trans("balance_exp"); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 ml-3 mr-3">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                            <th scope="col"><?php echo trans("order"); ?></th>
                                            <th scope="col"><?php echo trans("price"); ?></th>
                                            <th scope="col"><?php echo trans("commission_rate"); ?></th>
                                            <th scope="col"><?php echo trans("shipping_cost"); ?></th>
                                            <th scope="col"><?php echo trans("earned_amount"); ?></th>
                                            <th scope="col"><?php echo trans("date"); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($earnings as $earning): ?>
                                            <tr>
                                                <td>#<?php echo $earning->order_number; ?></td>
                                                <td><?php echo price_formatted($earning->price, $earning->currency); ?></td>
                                                <td><?php echo $earning->commission_rate; ?>%</td>
                                                <td><?php echo price_formatted($earning->shipping_cost, $earning->currency); ?></td>
                                                <td>
                                                    <?php echo price_formatted($earning->earned_amount, $earning->currency);
                                                    $order = get_order_by_order_number($earning->order_number);
                                                    if (!empty($order) && $order->payment_method == "Cash On Delivery"):?>
                                                        <span class="text-danger">(-<?php echo price_formatted($earning->earned_amount, $earning->currency); ?>)</span><br><small class="text-danger"><?php echo trans("cash_on_delivery"); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo formatted_date($earning->created_at); ?></td>
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
