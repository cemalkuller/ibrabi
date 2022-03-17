
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
                                    
                                    <div class="review-total">
                                        <label class="label-review"><?php echo trans("reviews"); ?>&nbsp;(<?php echo $user_rating->count; ?>)</label>
                                        <?php if (!empty($reviews)):
                                            $this->load->view('partials/_review_stars', ['review' => $user_rating->rating]);
                                        endif; ?>
                                    </div>
                                    <?php if (empty($reviews)): ?>
                                        <p class="no-comments-found"><?php echo trans("no_reviews_found"); ?></p>
                                    <?php else: ?>
                                        <ul class="list-unstyled list-reviews">
                                            <?php foreach ($reviews as $review): ?>
                                                <li class="media">
                                                    <a href="<?php echo generate_profile_url($review->user_slug); ?>">
                                                        <img src="<?php echo get_user_avatar_by_id($review->user_id); ?>" alt="<?php echo get_shop_name_by_user_id($review->user_id); ?>" width="75" class="img-thumbnail">
                                                    </a>
                                                    <div class="media-body pl-2">
                                                        <?php $review_product = get_product($review->product_id);
                                                        if (!empty($review_product)):?>
                                                            <div class="row-custom m-b-10">
                                                                <a href="<?php echo generate_product_url_by_slug($review_product->slug); ?>"><small><?php echo html_escape($review_product->title); ?></small></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="row-custom">
                                                            <div class="rating">
                                                                <i class="<?php echo ($review >= 1) ? 'icon-star' : 'icon-star-o'; ?>"></i>
                                                                <i class="<?php echo ($review >= 2) ? 'icon-star' : 'icon-star-o'; ?>"></i>
                                                                <i class="<?php echo ($review >= 3) ? 'icon-star' : 'icon-star-o'; ?>"></i>
                                                                <i class="<?php echo ($review >= 4) ? 'icon-star' : 'icon-star-o'; ?>"></i>
                                                                <i class="<?php echo ($review >= 5) ? 'icon-star' : 'icon-star-o'; ?>"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row-custom">
                                                            <a href="<?php echo generate_profile_url($review->user_slug); ?>">
                                                                <small><?php echo get_shop_name_by_user_id($review->user_id); ?></small>
                                                            </a>
                                                        </div>
                                                        <div class="row-custom">
                                                            <small class="review">
                                                                <?php echo html_escape($review->review); ?>
                                                        </small>
                                                        </div>
                                                        <div class="row-custom">
                                                            <small class="date"><?php echo time_ago($review->created_at); ?></small>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

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
