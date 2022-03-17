<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$routes = $this->config->item('routes');

$route['default_controller'] = 'home_controller';
$route['404_override'] = 'home_controller/error_404';
$route['translate_uri_dashes'] = FALSE;
$route['error-404'] = 'home_controller/error_404';

/**Api routes */
$route['api/auth/login']['post']  = 'Api/auth_controller/login';
$route['api/auth/logout']['post']  = 'Api/auth_controller/logout';
$route['api/auth/register']['post'] = 'Api/auth_controller/register';
$route['api/vendors'] = 'Api/auth_controller/vendors';
$route['api/vendor/(:any)'] = 'Api/auth_controller/vendor/$1';
$route['api/members'] = 'Api/auth_controller/members';
$route['api/member/(:any)'] = 'Api/auth_controller/member/$1';
$route['api/products'] = 'Api/product_controller/products';
$route['api/product/(:any)'] = 'Api/product_controller/product/$1';
$route['api/get_products'] = 'Api/product_controller/get_products';
$route['api/get_product_images/(:any)'] = 'Api/product_controller/get_product_images/$1';
$route['api/main_banners'] = 'Api/banner_controller/main_banners';
$route['api/sidebar_banners'] = 'Api/banner_controller/sidebar_banners';
$route['api/brand/(:any)'] = 'Api/banner_controller/brand/$1';
$route['api/languages'] = 'Api/language_controller/languages';
$route['api/orders'] = 'Api/order_controller/orders';
$route['api/completed_orders'] = 'Api/order_controller/completed_orders';
$route['api/order/(:any)'] = 'Api/order_controller/order/$1';
$route['api/order_products/(:any)'] = 'Api/order_controller/order_products/$1';
$route['api/messages'] = 'Api/message_controller/messages';
$route['api/followers'] = 'Api/auth_controller/followers';
$route['api/following'] = 'Api/auth_controller/following';
$route['api/reviews'] = 'Api/auth_controller/reviews';
//categories
$route['api/get_parent_categories'] = 'Api/product_controller/get_parent_categories';
$route['api/get_subcategories_by_parent_id/(:any)/(:any)'] = 'Api/category_controller/get_subcategories_by_parent_id/$1/$2';
//cart
$route['api/cart'] = 'Api/cart_controller/cart';
$route['api/add_to_cart/(:any)'] = 'Api/cart_controller/add_to_cart/$1';
$route['api/remove_from_cart/(:any)'] = 'Api/cart_controller/remove_from_cart/$1';
//brands
$route['api/brands'] = 'Api/brand_controller/brands';
//get brand products
$route['api/get_brand_products/(:any)'] = 'Api/brand_controller/get_brand_products/$1';
//search products
$route['api/search_products/(:any)'] = 'Api/product_controller/search_products/$1';

/**Dashboard Routes */
$route['satis-yap'] = 'home_controller/start_selling';
$route['dashboard'] = 'dashboard_controller/dashboard';
$route['dashboard/products'] = 'dashboard_controller/products';
$route['dashboard/add-product'] = 'dashboard_controller/add_product';
$route['dashboard/edit-product/(:any)'] = 'dashboard_controller/edit_product/$1';
$route['dashboard/product-details/(:any)'] = 'dashboard_controller/edit_product_details/$1';
$route['dashboard/upload-product'] = 'dashboard_controller/upload_product';
$route['dashboard/orders'] = 'dashboard_controller/orders';
$route['dashboard/order-details/(:any)'] = 'dashboard_controller/order_details/$1';
$route['dashboard/completed-orders'] = 'dashboard_controller/completed_orders';
$route['dashboard/canceled-orders'] = 'dashboard_controller/canceled_orders';
$route['dashboard/refund-orders'] = 'dashboard_controller/refund_orders';
$route['dashboard/shop-settings'] = 'dashboard_controller/shop_settings';
$route['dashboard/earnings'] = 'dashboard_controller/earnings';
$route['dashboard/set-payout-account'] = 'dashboard_controller/set_payout_account';
$route['dashboard/campaigns'] = 'dashboard_controller/campaigns';
$route['dashboard/trendyol'] = 'dashboard_controller/trendyol';
$route['dashboard/reviews'] = 'dashboard_controller/reviews';



/**Payment Routes */
$route['success-redirect'] = 'order_controller/success_redirect';
$route['fail-redirect'] = 'order_controller/fail_redirect';
$route["add-to-cart-direct-(:num)"] = 'cart_controller/add_to_cart_direct/$1';


$general_settings = $this->config->item('general_settings');
$languages = $this->config->item('languages');
foreach ($languages as $language) {
    if ($language->status == 1) {
        $key = "";
        if ($general_settings->site_lang != $language->id) {
            $key = $language->short_form . '/';
            $route[$language->short_form] = 'home_controller/index';
            $route[$key . '/error-404'] = 'home_controller/error_404';
        }

        //auth
        $route[$key . $routes->register]['GET'] = 'auth_controller/register';
        $route[$key . $routes->forgot_password]['GET'] = 'auth_controller/forgot_password';
        $route[$key . $routes->reset_password]['GET'] = 'auth_controller/reset_password';
        //profile
        $route[$key . $routes->profile . '/(:any)']['GET'] = 'profile_controller/profile/$1';
        $route[$key . $routes->wishlist . '/(:any)']['GET'] = 'profile_controller/wishlist/$1';
        $route[$key . $routes->wishlist]['GET'] = 'home_controller/guest_wishlist/$1';
        $route[$key . $routes->followers . '/(:any)']['GET'] = 'profile_controller/followers/$1';
        $route[$key . $routes->following . '/(:any)']['GET'] = 'profile_controller/following/$1';
        $route[$key . $routes->reviews . '/(:any)']['GET'] = 'profile_controller/reviews/$1';
        /*settings*/
        $route[$key . $routes->settings]['GET'] = 'profile_controller/update_profile';
        $route[$key . $routes->settings . '/' . $routes->update_profile]['GET'] = 'profile_controller/update_profile';
        $route[$key . $routes->settings . '/' . $routes->shop_settings]['GET'] = 'profile_controller/shop_settings';
        $route[$key . $routes->settings . '/' . $routes->personal_information]['GET'] = 'profile_controller/personal_information';
        $route[$key . $routes->settings . '/' . $routes->social_media]['GET'] = 'profile_controller/social_media';
        $route[$key . $routes->settings . '/' . $routes->change_password]['GET'] = 'profile_controller/change_password';
        $route[$key . $routes->settings . '/' . $routes->shipping_address]['GET'] = 'profile_controller/shipping_address';
        $route[$key . $routes->members]['GET'] = 'home_controller/members';
        /*product*/
        $route[$key . $routes->start_selling]['GET'] = 'product_controller/start_selling';
        $route[$key . $routes->sell_now]['GET'] = 'product_controller/add_product';
        $route[$key . $routes->sell_now . '/(:num)']['GET'] = 'product_controller/edit_draft/$1';
        $route[$key . $routes->sell_now . '/' . $routes->product_details . '/(:num)']['GET'] = 'product_controller/edit_product_details/$1';
        $route[$key . $routes->sell_now . '/' . $routes->edit_product . '/(:num)']['GET'] = 'product_controller/edit_product/$1';
        $route[$key . $routes->search]['GET'] = 'home_controller/search';
        $route[$key . $routes->products]['GET'] = 'home_controller/products';
        $route[$key . $routes->drafts]['GET'] = 'profile_controller/drafts';
        $route[$key . $routes->downloads]['GET'] = 'profile_controller/downloads';
        $route[$key . $routes->pending_products]['GET'] = 'profile_controller/pending_products';
        $route[$key . $routes->hidden_products]['GET'] = 'profile_controller/hidden_products';
        /*promoted product*/
        $route[$key . $routes->promote_product . '/' . $routes->pricing . '/(:num)']['GET'] = 'promote_controller/pricing/$1';
        /*blog*/
        $route[$key . $routes->blog . '/(:any)']['GET'] = 'home_controller/blog_category/$1';
        $route[$key . $routes->blog . '/' . $routes->tag . '/(:any)']['GET'] = 'home_controller/tag/$1';
        $route[$key . $routes->blog . '/(:any)/(:any)']['GET'] = 'home_controller/post/$1/$2';
        /*messages*/
        $route[$key . $routes->messages]['GET'] = 'message_controller/messages';
        $route[$key . $routes->messages . '/' . $routes->conversation . '/(:num)']['GET'] = 'message_controller/conversation/$1';
        /*rss feeds*/
        $route[$key . $routes->rss_feeds]['GET'] = 'rss_controller/rss_feeds';
        $route[$key . 'rss/' . $routes->latest_products]['GET'] = 'rss_controller/latest_products';
        $route[$key . 'rss/' . $routes->featured_products]['GET'] = 'rss_controller/featured_products';
        $route[$key . 'rss/' . $routes->category . '/(:any)']['GET'] = 'rss_controller/rss_by_category/$1';
        $route[$key . 'rss/' . $routes->seller . '/(:any)']['GET'] = 'rss_controller/rss_by_seller/$1';
        /*cart*/
        $route[$key . $routes->cart]['GET'] = 'cart_controller/cart';
        $route[$key . $routes->cart . '/' . $routes->shipping]['GET'] = 'cart_controller/shipping';
        $route[$key . $routes->cart . '/' . $routes->payment_method]['GET'] = 'cart_controller/payment_method';
        $route[$key . $routes->cart . '/' . $routes->payment]['GET'] = 'cart_controller/payment';
        /*orders*/
        $route[$key . $routes->orders]['GET'] = 'order_controller/orders';
        $route[$key . $routes->orders . '/' . $routes->completed_orders]['GET'] = 'order_controller/completed_orders';
        $route[$key . $routes->order_details . '/(:num)']['GET'] = 'order_controller/order/$1';
        $route[$key . $routes->order_completed . '/(:num)']['GET'] = 'cart_controller/order_completed/$1';
        $route[$key . $routes->promote_payment_completed]['GET'] = 'cart_controller/promote_payment_completed';
        $route[$key . 'invoice/(:num)']['GET'] = 'order_controller/invoice/$1';
        /*sales*/
        $route[$key . $routes->sales]['GET'] = 'order_controller/sales';
        $route[$key . $routes->sales . '/' . $routes->completed_sales]['GET'] = 'order_controller/completed_sales';
        $route[$key . $routes->sale . '/(:num)']['GET'] = 'order_controller/sale/$1';
        /*earnings*/
        $route[$key . $routes->earnings]['GET'] = 'earnings_controller/earnings';
        $route[$key . $routes->set_payout_account]['GET'] = 'earnings_controller/set_payout_account';
        $route[$key . $routes->payouts]['GET'] = 'earnings_controller/payouts';
        /*bidding*/
        $route[$key . $routes->quote_requests]['GET'] = 'bidding_controller/quote_requests';
        $route[$key . $routes->sent_quote_requests]['GET'] = 'bidding_controller/sent_quote_requests';
        /*any*/
        if ($general_settings->site_lang != $language->id) {
            $route[$key . '(:any)/(:any)']['GET'] = 'home_controller/subcategory/$1/$2';
            $route[$key . '(:any)']['GET'] = 'home_controller/any/$1';
        }
    }
}

//static routes
include_once "routes_static.php";

/*
 *
 * ADMIN ROUTES
 *
 */
$route[$routes->admin] = 'admin_controller/index';
//login
$route[$routes->admin . '/login'] = 'common_controller/admin_login';
/*navigation routes*/
$route[$routes->admin . '/navigation'] = 'admin_controller/navigation';
/*slider routes*/
$route[$routes->admin . '/slider'] = 'admin_controller/slider';
$route[$routes->admin . '/update-slider-item/(:num)'] = 'admin_controller/update_slider_item/$1';
/*page routes*/
$route[$routes->admin] = 'admin_controller/index';
$route[$routes->admin . '/settings'] = 'admin_controller/settings';
$route[$routes->admin . '/email-settings'] = 'admin_controller/email_settings';
$route[$routes->admin . '/social-login'] = 'admin_controller/social_login_settings';

$route[$routes->admin . '/add-page'] = 'page_controller/add_page';
$route[$routes->admin . '/update-page'] = 'page_controller/update_page';
$route[$routes->admin . '/pages'] = 'page_controller/pages';
$route[$routes->admin . '/pages'] = 'page_controller/pages';
/*order routes*/
$route[$routes->admin . '/orders'] = 'order_admin_controller/orders';
$route[$routes->admin . '/order-details/(:num)'] = 'order_admin_controller/order_details/$1';
$route[$routes->admin . '/kargo-olustur/(:num)'] = 'order_admin_controller/kargo_olustur/$1';
$route[$routes->admin . '/barkod/(:num)'] = 'order_admin_controller/barkod/$1';
$route[$routes->admin . '/transactions'] = 'order_admin_controller/transactions';
$route[$routes->admin . '/order-bank-transfers'] = 'order_admin_controller/order_bank_transfers';
$route[$routes->admin . '/invoices'] = 'order_admin_controller/invoices';
$route[$routes->admin . '/digital-sales'] = 'order_admin_controller/digital_sales';
/*homepage manager*/
$route[$routes->admin . '/main-banners'] = 'banner_admin_controller/main_banners';
$route[$routes->admin . '/sidebar-banners'] = 'banner_admin_controller/sidebar_banners';
$route[$routes->admin . '/update-banner/(:num)/(:num)'] = 'banner_admin_controller/update_banner/$1/$2';
/*brand manager*/
$route[$routes->admin . '/brands'] = 'brand_admin_controller/brands';
$route[$routes->admin . '/update-brand/(:num)'] = 'brand_admin_controller/update_brand/$1"';
/*product routes*/
$route[$routes->admin . '/products'] = 'product_admin_controller/products';
$route[$routes->admin . '/pending-products'] = 'product_admin_controller/pending_products';
$route[$routes->admin . '/hidden-products'] = 'product_admin_controller/hidden_products';
$route[$routes->admin . '/drafts'] = 'product_admin_controller/drafts';
$route[$routes->admin . '/deleted-products'] = 'product_admin_controller/deleted_products';
$route[$routes->admin . '/product-details/(:num)'] = 'product_admin_controller/product_details/$1';
/*featured product routes*/
$route[$routes->admin . '/featured-products'] = 'product_admin_controller/featured_products';
$route[$routes->admin . '/featured-products-transactions'] = 'product_admin_controller/featured_products_transactions';
$route[$routes->admin . '/featured-products-pricing'] = 'product_admin_controller/featured_products_pricing';
/*bidding system*/
$route[$routes->admin . '/quote-requests'] = 'admin_controller/quote_requests';
/*page routes*/
$route[$routes->admin . '/pages'] = 'page_controller/pages';
$route[$routes->admin . '/update-page/(:num)'] = 'page_controller/update_page/$1';
/*category routes*/
$route[$routes->admin . '/add-category'] = 'category_controller/add_category';
$route[$routes->admin . '/categories'] = 'category_controller/categories';
$route[$routes->admin . '/update-category/(:num)'] = 'category_controller/update_category/$1';
$route[$routes->admin . '/update-subcategory/(:num)'] = 'category_controller/update_subcategory/$1';
$route[$routes->admin . '/subcategories'] = 'category_controller/subcategories';
$route[$routes->admin . '/add-subcategory'] = 'category_controller/add_subcategory';
/*custom fields*/
$route[$routes->admin . '/add-custom-field'] = 'category_controller/add_custom_field';
$route[$routes->admin . '/custom-fields'] = 'category_controller/custom_fields';
$route[$routes->admin . '/update-custom-field/(:num)'] = 'category_controller/update_custom_field/$1';
$route[$routes->admin . '/custom-field-options/(:num)'] = 'category_controller/custom_field_options/$1';
/*earnings*/
$route[$routes->admin . '/earnings'] = 'earnings_admin_controller/earnings';
$route[$routes->admin . '/completed-payouts'] = 'earnings_admin_controller/completed_payouts';
$route[$routes->admin . '/payout-requests'] = 'earnings_admin_controller/payout_requests';
$route[$routes->admin . '/payout-settings'] = 'earnings_admin_controller/payout_settings';
$route[$routes->admin . '/add-payout'] = 'earnings_admin_controller/add_payout';
$route[$routes->admin . '/seller-balances'] = 'earnings_admin_controller/seller_balances';
$route[$routes->admin . '/update-seller-balance/(:num)'] = 'earnings_admin_controller/update_seller_balance/$1';
/*blog routes*/
$route[$routes->admin . '/blog-add-post'] = 'blog_controller/add_post';
$route[$routes->admin . '/blog-posts'] = 'blog_controller/posts';
$route[$routes->admin . '/update-blog-post/(:num)'] = 'blog_controller/update_post/$1';
$route[$routes->admin . '/blog-categories'] = 'blog_controller/categories';
$route[$routes->admin . '/update-blog-category/(:num)'] = 'blog_controller/update_category/$1';
/*comment routes*/
$route[$routes->admin . '/pending-product-comments'] = 'product_admin_controller/pending_comments';
$route[$routes->admin . '/product-comments'] = 'product_admin_controller/comments';
$route[$routes->admin . '/pending-blog-comments'] = 'blog_controller/pending_comments';
$route[$routes->admin . '/blog-comments'] = 'blog_controller/comments';
/*review routes*/
$route[$routes->admin . '/reviews'] = 'product_admin_controller/reviews';
/*ad spaces routes*/
$route[$routes->admin . '/ad-spaces'] = 'admin_controller/ad_spaces';
/*seo tools routes*/
$route[$routes->admin . '/seo-tools'] = 'admin_controller/seo_tools';
/*location*/
$route[$routes->admin . '/location-settings'] = 'admin_controller/location_settings';
$route[$routes->admin . '/countries'] = 'admin_controller/countries';
$route[$routes->admin . '/states'] = 'admin_controller/states';
$route[$routes->admin . '/add-country'] = 'admin_controller/add_country';
$route[$routes->admin . '/update-country/(:num)'] = 'admin_controller/update_country/$1';
$route[$routes->admin . '/add-state'] = 'admin_controller/add_state';
$route[$routes->admin . '/update-state/(:num)'] = 'admin_controller/update_state/$1';
$route[$routes->admin . '/cities'] = 'admin_controller/cities';
$route[$routes->admin . '/add-city'] = 'admin_controller/add_city';
$route[$routes->admin . '/update-city/(:num)'] = 'admin_controller/update_city/$1';
/*users routes*/
$route[$routes->admin . '/members'] = 'admin_controller/members';
$route[$routes->admin . '/vendors'] = 'admin_controller/vendors';
$route[$routes->admin . '/administrators'] = 'admin_controller/administrators';
$route[$routes->admin . '/shop-opening-requests'] = 'admin_controller/shop_opening_requests';
$route[$routes->admin . '/add-administrator'] = 'admin_controller/add_administrator';
$route[$routes->admin . '/edit-user/(:num)'] = 'admin_controller/edit_user/$1';

$route[$routes->admin . '/cache-system'] = 'admin_controller/cache_system';
$route[$routes->admin . '/storage'] = 'admin_controller/storage';
/*languages routes*/
$route[$routes->admin . '/languages'] = 'language_controller/languages';
$route[$routes->admin . '/update-language/(:num)'] = 'language_controller/update_language/$1';
$route[$routes->admin . '/translations/(:num)'] = 'language_controller/update_translations/$1';
$route[$routes->admin . '/search-phrases'] = 'language_controller/search_phrases';
/*payment routes*/
$route[$routes->admin . '/payment-settings'] = 'settings_controller/payment_settings';
$route[$routes->admin . '/visual-settings'] = 'admin_controller/visual_settings';
$route[$routes->admin . '/system-settings'] = 'admin_controller/system_settings';
/*currency*/
$route[$routes->admin . '/currency-settings'] = 'admin_controller/currency_settings';
$route[$routes->admin . '/update-currency/(:num)'] = 'admin_controller/update_currency/$1';
//newsletter
$route[$routes->admin . '/send-email-subscribers'] = 'admin_controller/send_email_subscribers';
$route[$routes->admin . '/subscribers'] = 'admin_controller/subscribers';

$route[$routes->admin . '/contact-messages'] = 'admin_controller/contact_messages';
$route[$routes->admin . '/preferences'] = 'admin_controller/preferences';
//campaigns
$route[$routes->admin . '/campaigns'] = 'admin_controller/campaigns';
$route[$routes->admin . '/add-campaign'] = 'admin_controller/add_campaign';
$route[$routes->admin . '/update-campaign/(:num)'] = 'admin_controller/update_campaign/$1';

//form settings
$route[$routes->admin . '/form-settings'] = 'settings_controller/form_settings';
$route[$routes->admin . '/form-settings/shipping-options'] = 'settings_controller/shipping_options';
$route[$routes->admin . '/form-settings/edit-shipping-option/(:num)'] = 'settings_controller/edit_shipping_option/$1';
$route[$routes->admin . '/form-settings/product-conditions'] = 'settings_controller/product_conditions';
$route[$routes->admin . '/form-settings/edit-product-condition/(:num)'] = 'settings_controller/edit_product_condition/$1';

$route[$routes->admin . '/font-settings'] = 'settings_controller/font_settings';
$route[$routes->admin . '/update-font/(:num)'] = 'settings_controller/update_font/$1';
$route[$routes->admin . '/route-settings'] = 'settings_controller/route_settings';


$route['(:any)/(:any)']['GET'] = 'home_controller/subcategory/$1/$2';
$route['(:any)']['GET'] = 'home_controller/any/$1';
