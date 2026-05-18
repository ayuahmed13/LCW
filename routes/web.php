<?php

// Start Common Controllers Needed For All Projects

use App\Http\Controllers\Admin\Blog\AdminBlogController;
use App\Http\Controllers\Admin\Cms\AboutUsCmsController;
use App\Http\Controllers\Admin\Cms\HomeCmsController;
use App\Http\Controllers\Admin\Cms\PageCoontentCmsController;
use App\Http\Controllers\Admin\ContactEnquiry\ContactEnquiryController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Front\Login\UserLoginController;
use App\Http\Controllers\Admin\Master\GstMasterController;
use App\Http\Controllers\Admin\Master\CityMasterController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Master\StateMasterController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Admin\Master\BrandsMasterController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\Master\CountryMasterController;
use App\Http\Controllers\Admin\Master\PinCodeMasterController;
use App\Http\Controllers\Admin\Master\CategoryMasterController;
use App\Http\Controllers\Front\Register\UserRegisterController;
use App\Http\Controllers\Admin\SystemUsers\SystemUserController;
use App\Http\Controllers\Front\MyAccount\UserMyAccountController;
use App\Http\Controllers\Admin\Master\SubCategoryMasterController;
use App\Http\Controllers\Admin\Master\SubSubCategoryMasterController;
use App\Http\Controllers\Admin\NotFoundController\NotFoundController;
use App\Http\Controllers\Admin\SystemUsers\RolesPrivilegesController;
use App\Http\Controllers\Admin\Master\ProductParameterMasterController;
use App\Http\Controllers\Admin\Master\ProductParameterValueMasterController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Reseller\ResellerEnquiryController;
use App\Http\Controllers\Admin\StockManagement\StockManagementsController;
use App\Http\Controllers\Front\Blog\FrontBlogController;
use App\Http\Controllers\Front\Cart\FrontCartController;
use App\Http\Controllers\Front\Cart\FrontGuestCartController;
use App\Http\Controllers\Front\Checkout\FrontCheckoutController;
use App\Http\Controllers\Front\ContactUs\FrontContactUsController;
use App\Http\Controllers\Front\Home\FrontHomeController;
use App\Http\Controllers\Front\Orders\FrontOrdersController;
use App\Http\Controllers\Front\Payment\PaymentController;
use App\Http\Controllers\Front\Reseller\FrontResellerEnquiryController;
use App\Http\Controllers\Front\Wishlist\FrontWishlistController;
use App\Http\Controllers\Products\FrontProductsController;

// End Common Controllers Needed For All Project

// Project Controller Start Here

// Project Controller Ends Here

// Start Common Routes For The Projects
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});
Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return 'clear';
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index']);
});
Route::post('login-action', [LoginController::class, 'admin_login'])->name('login');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('reset-password', function(){ return abort(404); });
// End Common Routes For The Projects


// Start FrontEnd Routes

Route::get('/', function () {
    return redirect('/admin');
});

//Route::view('/', 'Front.index');
//Route::view('/about', 'Front.about');
//Route::view('/terms-conditions', 'Front.terms-conditions');
//Route::view('/privacy-policy', 'Front.privacy-policy');
//Route::view('/contact', 'Front.contact');
//Route::view('/blogs', 'Front.blogs');
//Route::view('/blog-details', 'Front.blog-detail');
Route::view('/service-details', 'Front.service-details');
//Route::view('/terms-conditions', 'Front.terms-conditions');
//Route::view('/privacy-policy', 'Front.privacy-policy');
//Route::view('/shopping-cart', 'Front.shopping-cart');
//Route::view('/product-detail', 'Front.product-detail');
//Route::view('/faqs', 'Front.FAQs');
//Route::view('/glossary', 'Front.glossary');
//Route::view('/brand-info', 'Front.brand-information');
//Route::view('/reseller', 'Front.reseller');
//Route::view('/checkout', 'Front.checkout');
//Route::view('/login', 'Front.login');
//Route::view('/register', 'Front.register');
//Route::view('/forget-password', 'Front.forget-password');
//Route::view('/my-account', 'Front.my-account');
//Route::view('/products', 'Front.products');
//Route::view('/product-categories', 'Front.product-categories');
Route::view('/product-categories1', 'Front.product-categories1');
Route::view('/wish-list', 'Front.wish-list');
//Route::view('/wishlist', 'Front.wishlist');
//Route::view('/my-account-address', 'Front.my-account-address');
//Route::view('/my-account-orders', 'Front.my-account-orders');
//Route::view('/my-account-orders-details', 'Front.my-account-orders-details');

// End Frontend Routes

//Route::view('/admin/blogs', 'Admin.Blogs.blogs');
//Route::view('/admin/add-blogs', 'Admin.Blogs.add-blogs');
//Route::view('/admin/contact', 'Admin.Contact.contact');
Route::view('/forget-password-admin', 'Admin.Forget-passwords.forget-password');
//Route::view('/admin/country', 'Admin.Master.country');
//Route::view('/admin/state', 'Admin.Master.state');
//Route::view('/admin/city', 'Admin.Master.city');
//Route::view('/admin/pincode', 'Admin.Master.pincode');
//Route::view('/admin/brands', 'Admin.Master.brands');
//Route::view('/admin/category', 'Admin.Master.category');
//Route::view('/admin/sub-category', 'Admin.Master.sub-category');
//Route::view('/admin/sub-sub-category', 'Admin.Master.sub-sub-category');
//Route::view('/admin/GST', 'Admin.Master.GST');
//Route::view('/admin/product-parameter', 'Admin.Master.product-parameter');
//Route::view('/admin/product-parameter-value', 'Admin.Master.product-parameter-value');
//Route::view('/admin/product', 'Admin.Product.product');
//Route::view('/admin/add-product', 'Admin.Product.add-product');



//Route::view('/admin/home', 'Admin.CMS.home');
//Route::view('/admin/about', 'Admin.CMS.about');
//Route::view('/admin/faq', 'Admin.CMS.faq');
//Route::view('/admin/pages-content', 'Admin.CMS.pages-content');
//Route::view('/admin/contact', 'Admin.Contact.contact');
//Route::view('/admin/customers', 'Admin.Customers.customers');
//Route::view('/admin/stock', 'Admin.Stock.stock');
//Route::view('/admin/orders', 'Admin.Orders.orders');
Route::view('/admin/confirmed', 'Admin.Orders.confirmed');
Route::view('/admin/pending-payment', 'Admin.Orders.pending-payment');
Route::view('/admin/inprocess', 'Admin.Orders.inprocess');
Route::view('/admin/delievered', 'Admin.Orders.delievered');
Route::view('/admin/cancelled', 'Admin.Orders.cancelled');
Route::view('/admin/pending-view', 'Admin.Orders.View.pending-view');
Route::view('/admin/payment-pending-view', 'Admin.Orders.View.payment-pending-view');
Route::view('/admin/confirmed-view', 'Admin.Orders.View.confirmed-view');
Route::view('/admin/inprocess-view', 'Admin.Orders.View.inprocess-view');
Route::view('/admin/delievered-view', 'Admin.Orders.View.delievered-view');
Route::view('/admin/cancelled-view', 'Admin.Orders.View.cancelled-view');
Route::view('/admin/return-orders-view', 'Admin.Orders.View.return-orders-view');
Route::view('/admin/return-orders', 'Admin.Orders.return-orders');
// Route::view('/admin/reseller', 'Admin.Reseller.reseller');
Route::view('/admin/reports', 'Admin.Reports.reports');

// Start Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(CountryMasterController::class)->group(function () {
        Route::get('country-master', 'index');
        Route::post('country-master/store', 'store');
        Route::get('country-master/data-table', 'data_table');
        Route::get('country-master/edit/{id}', 'edit');
        Route::get('country-master/check-country-exist', 'check_country_exist');
        Route::get('country-master/check-country-code-exist', 'check_country_code_exist');

    });

    Route::controller(StateMasterController::class)->group(function () {
        Route::get('state-master', 'index');
        Route::post('state-master/store', 'store');
        Route::get('state-master/data-table', 'data_table');
        Route::get('state-master/edit/{id}', 'edit');
        Route::get('state-master/check-state-exist', 'check_state_exist');
    });

    Route::controller(CityMasterController::class)->group(function () {
        Route::get('city-master', 'index');
        Route::post('city-master/store', 'store');
        Route::get('city-master/data-table', 'data_table');
        Route::get('city-master/edit/{id}', 'edit');
        Route::get('city-master/check-city-exist', 'check_city_exist');
        Route::post('city-master/get-state-by-country-id', 'get_state_by_country_id');
    });

    Route::controller(PinCodeMasterController::class)->group(function () {
        Route::get('pin-code-master', 'index');
        Route::post('pin-code-master/store', 'store');
        Route::get('pin-code-master/data-table', 'data_table');
        Route::get('pin-code-master/edit/{id}', 'edit');
        Route::get('pin-code-master/check-city-pin-codes-exist', 'check_city_pin_codes_exist');
        Route::post('pin-code-master/get-city-by-state-id', 'get_city_by_state_id');
    });

    Route::controller(BrandsMasterController::class)->group(function () {
        Route::get('brands-master', 'index');
        Route::post('brands-master/store', 'store');
        Route::get('brands-master/data-table', 'data_table');
        Route::get('brands-master/edit/{id}', 'edit');
        Route::get('brands-master/check-brands-exist', 'check_brands_exist');     
    });

    Route::controller(CategoryMasterController::class)->group(function () {
        Route::get('category-master', 'index');
        Route::post('category-master/store', 'store');
        Route::get('category-master/data-table', 'data_table');
        Route::get('category-master/edit/{id}', 'edit');
        Route::get('category-master/check-category-exist', 'check_category_exist');     
    });

    Route::controller(SubCategoryMasterController::class)->group(function () {
        Route::get('sub-category-master', 'index');
        Route::post('sub-category-master/store', 'store');
        Route::get('sub-category-master/data-table', 'data_table');
        Route::get('sub-category-master/edit/{id}', 'edit');
        Route::get('sub-category-master/check-sub-category-exist', 'check_sub_category_exist');     
    });

    Route::controller(SubSubCategoryMasterController::class)->group(function () {
        Route::get('sub-sub-category-master', 'index');
        Route::post('sub-sub-category-master/store', 'store');
        Route::get('sub-sub-category-master/data-table', 'data_table');
        Route::get('sub-sub-category-master/edit/{id}', 'edit');
        Route::get('sub-sub-category-master/check-sub-sub-category-exist', 'check_sub_sub_category_exist');     
        Route::post('sub-sub-category-master/get-sub-category-by-category-id', 'get_sub_category_by_category_id');     
        Route::post('sub-sub-category-master/get-sub-sub-category-by-sub-category-id', 'get_sub_sub_category_by_sub_category_id');     
        
    });

    Route::controller(GstMasterController::class)->group(function () {
        Route::get('gst-master', 'index');
        Route::post('gst-master/store', 'store');
        Route::get('gst-master/data-table', 'data_table');
        Route::get('gst-master/edit/{id}', 'edit');
        Route::get('gst-master/check-gst-exist', 'check_gst_exist');
    });

    Route::controller(ProductParameterMasterController::class)->group(function () {
        Route::get('product-parameter-master', 'index');
        Route::post('product-parameter-master/store', 'store');
        Route::get('product-parameter-master/data-table', 'data_table');
        Route::get('product-parameter-master/edit/{id}', 'edit');
        Route::get('product-parameter-master/check-product-parameter-exist', 'check_product_parameter_exist');
    });

    Route::controller(ProductParameterValueMasterController::class)->group(function () {
        Route::get('product-parameter-value-master', 'index');
        Route::post('product-parameter-value-master/store', 'store');
        Route::get('product-parameter-value-master/data-table', 'data_table');
        Route::get('product-parameter-value-master/edit/{id}', 'edit');
        Route::get('product-parameter-value-master/check-product-parameter-value-exist', 'check_product_parameter_value_exist');
    });

    Route::controller(ProductsController::class)->group(function () {
        Route::get('product', 'index');
        Route::get('add-product', 'create');
        Route::post('product/store', 'store');
        Route::get('product/data-table', 'data_table');
        Route::get('product/edit/{id}', 'edit');
        Route::get('product/data-table-extra-tab', 'data_table_extra_tab');
        Route::get('product/check-slug-exist', 'check_slug_exist');
        
        Route::get('delete-gallery-image/{id}', 'DeleteGalleryImage');
        Route::get('product/delete-product-pdf/{id}', 'DeleteProductPdf');
        Route::get('product/delete-product-description-image/{id}', 'DeleteProductDescriptionImage');

        Route::get('product/check-gst-exist', 'check_product_exist');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index');
        Route::get('customers/data-table', 'data_table');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::post('orders/change-order-status', 'ChangeOrderStatus');
        Route::get('orders/data-table', 'data_table');
        Route::get('orders/view/{id}', 'view');
    });

    
    Route::controller(StockManagementsController::class)->group(function () {
        Route::get('stock', 'index');
        Route::get('stock/data-table', 'data_table');
        Route::post('stock/store', 'store');

    });

    Route::controller(HomeCmsController::class)->group(function () {
        Route::get('home', 'index');
        Route::post('home/store', 'store');
        Route::post('home/showcase-store', 'ShowcaseStore');
        Route::get('home/delete-showcase-image/{id}', 'DeleteShowcaseImage');
    });

    Route::controller(AboutUsCmsController::class)->group(function () {
        Route::get('about', 'index');
        Route::post('about/store', 'store');
        Route::post('about/testimonial-store', 'TestimonialStore');
        Route::get('about/data-table', 'data_table');
        Route::get('about/edit-testimonial/{id}', 'EditTestimonial');     
    });

    Route::controller(FaqController::class)->group(function () {
        Route::get('faq', 'index');
        Route::post('faq/store', 'store');
        Route::get('faq/data-table', 'data_table');
        Route::get('faq/edit/{id}', 'edit');
        Route::get('faq/check-faq-exist', 'check_faq_exist');     
    });

    Route::controller(PageCoontentCmsController::class)->group(function () {
        Route::get('pages-content', 'index');
        Route::post('pages-content/store', 'store');
        Route::post('pages-content/get-pages-content', 'get_pages_content');     
    });

    Route::controller(AdminBlogController::class)->group(function () {
        Route::get('blogs', 'index');
        Route::post('blogs/store', 'store');
        Route::get('blogs/add-blogs', 'AddBlogs');
        Route::get('blogs/data-table', 'data_table');
        Route::get('blogs/edit/{id}', 'edit');
        Route::get('blogs/check-slug-exist', 'check_slug_exist');     
    });
    Route::controller(ContactEnquiryController::class)->group(function () {
        Route::get('contact', 'index');
        Route::get('contact/data-table', 'data_table');
    });
    Route::controller(ResellerEnquiryController::class)->group(function () {
        Route::get('reseller', 'index');
        Route::get('reseller/data-table', 'data_table');
    });
    // Start Backend Common Routes For The Projects

    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('general-setting', 'index');
        Route::post('general-settings-store', 'store')->name('geraral.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('visual-setting', 'index');
        Route::post('visual-settings-store', 'store')->name('visual.settings.store');
    });

    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('roles-privileges','index');
        Route::get('roles-privileges/add','create');
        Route::post('roles-privileges/store','store')->name('roles-previllages.store');
        Route::get('roles-privileges/data-table','data_table');
        Route::get('roles-privileges/edit/{id}','edit');
        Route::get('roles-privileges/check-role-exist','check_role_exist');
    });

    Route::controller(SystemUserController::class)->group(function () {
        Route::get('system-user','index');
        Route::get('system-user/add','create');
        Route::post('system-user/store','store')->name('system-user.store');
        Route::get('system-user/data-table','data_table');
        Route::get('system-user/edit/{id}','edit');
        Route::get('system-user/check-user-exist','check_user_exist');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('change-password', 'view_change_password');
        Route::post('change-password', 'change_password');
        Route::get('logout', 'logout');
    });

    Route::controller(BaseController::class)->group(function () {
        Route::get('sub-category-list', 'subCategoryList');
        Route::get('common-delete', 'delete');
        Route::post('change-status', 'status')->name('change-status');
    });
    // End Backend Common Routes For The Projects

    route::get('/404', [NotFoundController::class, 'index']);
    
});
//End Backend Routes

 Route::controller(UserMyAccountController::class)->group(function () {
        
        Route::post('get-state-by-country-id', 'get_state_by_country_id');
        Route::post('get-city-by-state-id', 'get_city_by_state_id');
        Route::post('get-pincode-by-city-id', 'get_pincode_by_city_id');
        
    });
Route::group(['middleware' => ['prevent-back-history', 'is_user']], function () {
    Route::controller(UserLoginController::class)->group(function () {
        Route::get('change-password', 'view_change_password');
        Route::post('change-password', 'change_password');
        Route::get('logout', 'UserLogout');
    });

    Route::controller(UserMyAccountController::class)->group(function () {
        Route::get('my-account', 'index');
        Route::post('my-account/store','store');
        Route::get('my-account/check-old-password','CheckOldPassword');
        Route::post('my-account/set-new-password','SetNewPassword');
        //Front.my-account-address
        Route::get('my-account-address', 'MyAccountAddress');
        Route::post('my-account-address/store', 'MyAccountAddressStore');
        Route::get('my-account-address/delete/{id}', 'MyAccountDeleteAddress');
        Route::post('get-address-by-address-type', 'GetAddressByAddressType');
        
        // Route::post('get-state-by-country-id', 'get_state_by_country_id');
        // Route::post('get-city-by-state-id', 'get_city_by_state_id');
        // Route::post('get-pincode-by-city-id', 'get_pincode_by_city_id');
        Route::post('get-address-by-id', 'get_address_by_id');
        
    });

    Route::controller(FrontCartController::class)->group(function () {
        Route::get('cart', 'index');
        Route::post('cart/add-to-cart', 'AddToCartAjax');
        Route::post('cart/remove-from-cart', 'RemoveFromCart');
       
    });
    
    Route::controller(FrontWishlistController::class)->group(function () {
        Route::get('wishlist', 'index');
        Route::post('wishlist/add-to-wishlist','AddToWishlist');
        Route::post('wishlist/remove-from-wishlist','RemoveFromWishlist');
    });

     Route::controller(FrontOrdersController::class)->group(function () {
        Route::get('my-account-orders', 'MyAccountOrders');
        Route::get('my-account-orders-details/{id}', 'MyAccountOrdersDetails');
        Route::post('order/place-order','PlaceOrder');
        //Route::get('order/place-order','PlaceOrder');
        
    });

    
    
});

  Route::controller(PaymentController::class)->group(function () {
        Route::get('stripe-checkout', 'checkout');
        Route::post('create-session', 'createSession')->name('create.session');
        Route::post('create-payment', 'createSession')->name('create.payment');
        Route::get('success', 'success')->name('success');;
        Route::get('cancel', 'cancel')->name('cancel');
        
        
    });
//Route::get('/gcart', [FrontGuestCartController::class, 'index'])->name('gcart.index');
Route::post('/gcart/add', [FrontGuestCartController::class, 'addAjax'])->name('gcart.add');
Route::post('/gcart/remove', [FrontGuestCartController::class, 'remove'])->name('gcart.remove');
Route::post('/gcart/clear', [FrontGuestCartController::class, 'clear'])->name('gcart.clear');
Route::post('/gcart/update-quantity', [FrontGuestCartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::get('/shopping-cart', [FrontGuestCartController::class, 'index']);
Route::get('/cart/empty-cart', [FrontGuestCartController::class, 'EmptyCart']);

//Route::view('/product-categories', 'Front.product-categories');
//Route::get('product-categories', [UserRegisterController::class, 'index']);

// Front routes

Route::get('/', [FrontHomeController::class, 'index']);
Route::get('about', [FrontHomeController::class, 'AboutUsCms']);
Route::get('privacy-policy', [FrontHomeController::class, 'PrivacyPolicyCms']);
Route::get('terms-conditions', [FrontHomeController::class, 'TermsConditionsCms']);
Route::get('glossary', [FrontHomeController::class, 'GlossaryCms']);
Route::get('brand-info', [FrontHomeController::class, 'ProductBrandCms']);
Route::get('faqs', [FrontHomeController::class, 'FrontFaq']);
Route::get('contact', [FrontContactUsController::class, 'index']);
Route::post('contact-store', [FrontContactUsController::class, 'store']);
Route::get('reseller', [FrontResellerEnquiryController::class, 'index']);
Route::post('reseller-store', [FrontResellerEnquiryController::class, 'store']);

Route::get('blogs', [FrontBlogController::class, 'index']);
Route::get('blog-details/{slug}', [FrontBlogController::class, 'BlogDetails']);

Route::get('products/', [FrontProductsController::class, 'AllProducts']);
Route::get('products/all', [FrontProductsController::class, 'AllProducts']);

Route::get('products/search-results', [FrontProductsController::class, 'ProductSearchResult']);
Route::post('products/get-parameter-wise-count', [FrontProductsController::class, 'getParameterWiseCount']);

Route::get('product-categories/{slug}', [FrontProductsController::class, 'CategoryWiseProduct']);
Route::get('product-sub-categories/{slug}', [FrontProductsController::class, 'SubCategoryWiseProduct']);
Route::get('product-sub-sub-categories/{slug}', [FrontProductsController::class, 'SubSubCategoryWiseProduct']);
Route::get('product-detail/{slug}', [FrontProductsController::class, 'productDetails']);

Route::get('register', [UserRegisterController::class, 'index']);
Route::post('register-action', [UserRegisterController::class, 'store']);
Route::post('check-user-email-exists', [UserRegisterController::class, 'CheckUserEmailExists']);

Route::post('verify-otp', [UserRegisterController::class, 'VerifyOtp']);
Route::post('resend-otp', [UserRegisterController::class, 'ResendOtp']);

Route::get('checkout/', [FrontCheckoutController::class, 'index']);

Route::get('login', [UserLoginController::class, 'index']);
Route::post('user-login-action', [UserLoginController::class, 'UserLoginAction']);
Route::get('reset-password', [UserLoginController::class, 'ResetPassword']);
Route::post('reset-user-password-action', [UserLoginController::class, 'ResetUserPasswordAction']);
Route::get('reset-password-form/{token}', [UserLoginController::class, 'showUserResetPasswordForm']);
Route::post('submit-user-reset-password-form', [UserLoginController::class, 'submitUserResetPasswordForm']);

Route::fallback(function () {
    return redirect('admin/404');
});
