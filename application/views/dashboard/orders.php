<main role="main" class="dashboard-main">
<h1 class="jumbotron-heading pt-3 pb-3 pl-3 pr-3" style="font-size: 28px;"><?php echo $title; ?></h1>
<div class="ml-3 mr-3">
    <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th scope="col"><?php echo trans("sale"); ?></th>
            <th scope="col"><?php echo trans("total"); ?></th>
            <th scope="col"><?php echo trans("payment"); ?></th>
            <th scope="col"><?php echo trans("status"); ?></th>
            <th scope="col"><?php echo trans("date"); ?></th>
            <th scope="col"><?php echo trans("options"); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td scope="row">
                #<?php echo $order->order_number; ?>
            </td>
            <td width="50">
                <?php echo price_formatted($order->price_total, $order->price_currency); ?>
            </td>
            <td>
                <?php if ($order->payment_status == 'payment_received'):
                    echo trans("payment_received");
                else:
                    echo trans("awaiting_payment");
                endif; ?>
            </td>
            <td>
                <strong class="font-600">
                    <?php if ($order->payment_status == 'awaiting_payment'):
                        if ($order->payment_method == 'Cash On Delivery') {
                            echo trans("order_processing");
                        } else {
                            echo trans("awaiting_payment");
                        }
                    else:
                        if ($order->status == 1):
                            echo trans("completed");
                        else:
                            echo trans("order_processing");
                        endif;
                    endif; ?>
                </strong>
            </td>
            <td><?php echo date("Y-m-d / h:i", strtotime($order->created_at)); ?></td>
            <td>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    İşlemler
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?php echo site_url('dashboard/order-details/'.$order->order_number); ?>"><?php echo trans('details'); ?></a>
                        <!-- <a class="dropdown-item" href="#">Sil</a> -->
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
</main>
