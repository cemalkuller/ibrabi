<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="top-bar">

    <!--
    <div class="top_bar_banner" style="background: #ff6000;">
        <div class="container">
            <img src="http://ibrabishop.com/uploads/banners/topbar-banner.png" alt="" style="text-align:center; height:85px; display: table; margin: auto;">
        </div>
    </div>
    -->

    <div class="container">
        <div class="row">
            <!--<div class="col-6 col-left">
                <?php if (!empty($this->menu_links)): ?>
                    <ul class="navbar-nav">
                        <?php foreach ($this->menu_links as $menu_link):
                            if ($menu_link->location == 'top_menu'):?>
                                <li class="nav-item"><a href="<?php echo generate_menu_item_url($menu_link); ?>" class="nav-link"><?php echo html_escape($menu_link->title); ?></a></li>
                            <?php endif;
                        endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>-->


            <div class="col-12 col-right">
                
                <ul class="navbar-nav">    
                    <?php if ($this->auth_check): ?>
                        <!-- <?php if (is_multi_vendor_active()): ?>
                            <li class="nav-item"><a href="<?php echo generate_url("sell_now"); ?>" class="nav-link"><?php echo trans("sell_now"); ?></a></li>
                        <?php endif; ?> -->

                    <?php else: ?>
                        <?php if (is_multi_vendor_active()): ?>
                            <li class="nav-item"><a href="javascript:void(0)" class="nav-link" data-toggle="modal" data-target="#loginModal"><?php echo trans("sell_now"); ?></a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($this->general_settings->multilingual_system == 1 && count($this->languages) > 1): ?>
                        <li class="nav-item dropdown language-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                <img src="<?php echo base_url($this->selected_lang->flag_path); ?>" class="flag"><?php echo html_escape($this->selected_lang->name); ?><i class="icon-arrow-down"></i>
                            </a>
                            <div class="dropdown-menu">
                                <?php foreach ($this->languages as $language):
                                    $lang_url = base_url() . $language->short_form . "/";
                                    if ($language->id == $this->general_settings->site_lang) {
                                        $lang_url = base_url();
                                    } ?>
                                    <a href="<?php echo $lang_url; ?>" class="<?php echo ($language->id == $this->selected_lang->id) ? 'selected' : ''; ?> " class="dropdown-item">
                                        <img src="<?php echo base_url($language->flag_path); ?>" class="flag"><?php echo $language->name; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">

                    <?php //if (!$this->auth_check or !is_user_vendor()): ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url('satis-yap'); ?>" class="nav-link">
                            &nbsp;Satış Yap / Mağaza Aç
                        </a>
                    </li>
                    <?php //endif; ?>

                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            &nbsp;Sipariş Takibi 
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="<?php echo site_url('hakkimizda'); ?>" class="nav-link">
                            &nbsp;Hakkımızda 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('blog'); ?>" class="nav-link">
                            &nbsp;Blog 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('iletisim'); ?>" class="nav-link">
                            &nbsp;İletişim 
                        </a>
                    </li>
                </ul>
                
            </div>


        </div>
    </div>
</div>
