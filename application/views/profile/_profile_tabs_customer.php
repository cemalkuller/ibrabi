<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--profile page tabs-->
<div class="profile-tabs">
    <ul class="nav">
        <!-- Siparişler -->
        <?php if ($this->auth_check): ?>
            <li class="nav-item <?php echo ($active_tab == 'orders') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo generate_url("orders"); ?>">
                    <span><?php echo trans("orders"); ?></span>
                </a>
            </li>
        <?php endif; ?>
        
        <!-- Değerlendirmeler -->
        <?php if ($this->auth_check): ?>
            <li class="nav-item <?php echo ($active_tab == 'reviews') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo generate_url("reviews") . "/" . $user->slug; ?>">
                    <span><?php echo trans("reviews"); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item <?php echo ($active_tab == 'wishlist') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>iBrabi Cüzdanım</span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'wishlist') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo generate_url("wishlist") . "/" . $user->slug; ?>">
                <span><?php echo trans("wishlist"); ?></span>
            </a>
        </li>

        <?php if ($this->auth_check): ?>
            <li class="nav-item <?php echo ($active_tab == 'settings') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo generate_url("settings/update-profile"); ?>">
                    <span><?php echo trans("settings"); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo generate_url("following") . "/" . $user->slug; ?>">
                <span><?php echo trans("following"); ?></span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>İndirim Kuponlarım</span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'shipping-address') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo generate_url("settings/shipping-address") . "/" . $user->slug; ?>">
                <span><?php echo trans("shipping_address"); ?></span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>Kayıtlı Kartlarım</span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>iBrabi Gold</span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>Duyuru Tercihlerim</span>
            </a>
        </li>

        <li class="nav-item <?php echo ($active_tab == 'following') ? 'active' : ''; ?>">
            <a class="nav-link" href="#">
                <span>Yardım</span>
            </a>
        </li>
        
        
    </ul>
</div>

<div class="row-custom">
    <!--Include banner-->
    <?php $this->load->view("partials/_ad_spaces_sidebar", ["ad_space" => "profile_sidebar", "class" => "m-t-30"]); ?>
</div>

