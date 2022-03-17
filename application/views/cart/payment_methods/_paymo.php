<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($cart_payment_method->payment_option == "paymo"): ?>
    <script src=" http://cdn.pays.uz/checkout/js/v1.0.1/test-checkout.js"> </script>
    <div id="parent-frame"></div>
    <?php
    $key = '290'.'500000'.'1512366'.'mLEReYu2H2VCecNGKn0NuoY4pfOrsPuU';
    $key = hash('sha256', $key);
    ?>
    <script th:inline="javascript">
    /*<![CDATA[*/
    paymo_open_widget({
    parent_id: "parent-frame",
    store_id: "290",
    account: "1512366",
    //terminal_id: "31",
    success_redirect: "https://ibrabi.com/success-redirect",
    fail_redirect: "https://ibrabi.com/fail-redirect",
    version: "1.0.0",
    amount: 500000, //500000 тийин = 5000 сумов
    details:"",
    lang:"ru",
    //key:"mLEReYu2H2VCecNGKn0NuoY4pfOrsPuU",
    key: '<?php echo $key; ?>',
    theme:"blue"
    });
    /*]]>*/
    </script>
<?php endif; ?>



