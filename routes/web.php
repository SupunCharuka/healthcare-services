<?php

use App\Http\Controllers\Admin\AdminReviewsController;
use App\Http\Controllers\Admin\BankBranchController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommissionsController;
use App\Http\Controllers\Admin\ContactUSController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ManageProductCategoryController;
use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\ManageServiceController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\MemberListController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentInvoiceController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\StaticInputController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TicketsController as AdminTicketsController;
use App\Http\Controllers\Auth\MobileResetPasswordController;
use App\Http\Controllers\Auth\MobileVerifyController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\CustomerInvoiceController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\CustomerReviewController;
use App\Http\Controllers\Customer\HealthProfileController;
use App\Http\Controllers\Customer\InquiryController as CustomerInquiryController;
use App\Http\Controllers\Customer\MessagesController as CustomerMessagesController;
use App\Http\Controllers\Customer\TicketsController as CustomerTicketsController;
use App\Http\Controllers\Guest\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Member\AvailabilityController;
use App\Http\Controllers\Member\EducationController;
use App\Http\Controllers\Member\MemberInquiryController;
use App\Http\Controllers\Member\MemberOrderController;
use App\Http\Controllers\Member\MemberServiceController;
use App\Http\Controllers\Member\ReviewController;
use App\Http\Controllers\Member\WorkDetailController;
use App\Http\Controllers\OnlineShoppingController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ServiceProvider\BankDetailsController;
use App\Http\Controllers\ServiceProvider\BioDataController;
use App\Http\Controllers\ServiceProvider\BusinessProfileController;
use App\Http\Controllers\ServiceProvider\CommissionPayoutController;
use App\Http\Controllers\ServiceProvider\HealthProfilesController;
use App\Http\Controllers\ServiceProvider\MessagesController;
use App\Http\Controllers\ServiceProvider\TicketsController;
use App\Http\Controllers\VideoCallController;
use App\Models\Invoice;
use App\Services\FirebaseCloudMessage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function (\Illuminate\Http\Request $request) {
    //    $invoice = Invoice::find(2);
    //    $fcmClient = new FirebaseCloudMessage;
    //    $fcmClient->sendPushNotification(
    //        title: "New Invoice created!",
    //        body: "Your inquiry for {$invoice->inquiry->serviceCategory->name} accepted & invoice created. Kindly confirm with payment.",
    //        routeName: "customer/invoice/{$invoice->inquiry_id}",
    //        deviceToken: 'fJKs0OtLSoGKBVcOdUdLyD:APA91bGhdfajk4QcvLptzPgW5g1YSyrad6A60FUOg8uj2iWPZz_RpoPX7345pn40bsRWZ5VFGVWXbLBEOV-sBQ2IsoZP_S2qCw2ddva4-sq0BX3nJIXJaOeKkpt13OMC2ZJxm325Gt04',
    //
    //    );
    //    dd([
    //        'inquiry' => $invoice->inquiry,
    //        'invoice' => $invoice,
    //    ]);
});


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');
Route::get('links', [PublicController::class, 'links'])->name('/');

// Socialite routes
// Route::group(['prefix' => 'login'], function () {
//     // Google login
//     Route::get('google/redirect', [SocialLoginController::class, 'redirectToGoogle'])->name('login.google.redirect');
//     Route::get('google/callback', [SocialLoginController::class, 'handleGoogleCallback']);

//     // Facebook login
//     Route::get('facebook/redirect', [SocialLoginController::class, 'redirectToFacebook'])->name('login.facebook.redirect');
//     Route::get('facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);
// });

// Register custom routes
Route::group(['prefix' => 'register', 'middleware' => 'guest:' . config('fortify.guard')], function () {
    Route::get('/', [PublicController::class, 'register'])->name('register');
});

// Register service-provider routes
Route::group(['prefix' => 'service-provider', 'middleware' => 'guest:' . config('fortify.guard')], function () {
    Route::get('/register', [PublicController::class, 'serviceProviderRegister'])->name('service-provider.register');
});

//Inquiry
Route::get('/{servicecategory:slug}/inquiry', [PublicController::class, 'inquiry'])->name('inquiry');

//Product
Route::get('/products', [OnlineShoppingController::class, 'index'])->name('public.product');
Route::get('/products/{product:slug}', [OnlineShoppingController::class, 'subCategory'])->name('public.productSub');
Route::get('/products/p/{category:slug}', [OnlineShoppingController::class, 'viewSub'])->name('public.viewSub');
Route::get('/view-product/{product:slug}', [OnlineShoppingController::class, 'viewProduct'])->name('view.product');
Route::get('/view-cart', [OnlineShoppingController::class, 'viewCart'])->name('product.cart');

Route::get('checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::get('place-order/{order}', [CheckoutController::class, 'placeOrder'])->name('placeOrder');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancelled', [CheckoutController::class, 'cancelled'])->name('checkout.cancelled');


Route::get('/about-us', [PublicController::class, 'aboutUs'])->name('public.aboutUs');
Route::get('/contact-us', [PublicController::class, 'contactUs'])->name('public.contactUs');
Route::get('/user-guide', [PublicController::class, 'userGuide'])->name('public.userGuide');

//Foreign Page
Route::get('/foreign', [PublicController::class, 'foreignPage'])->name('public.foreign-visitors');

Route::get('/services', [PublicController::class, 'services'])->name('public.serviceCategory');

Route::post('/set-language', [LanguageController::class, 'updateLanguage'])->name('update.language');

Route::get('/meeting/{inquiryId}/{roomID}', [VideoCallController::class, 'index'])->name('video-call')->middleware('signed');

Route::get('guest/invoice/{inquiry}', [InvoiceController::class, 'guestInvoice'])->name('guest.invoice')->middleware('signed');
Route::post('guest/invoice/online', [InvoiceController::class, 'guestOnlinePay']);
Route::post('guest/invoice/bank-transfer', [InvoiceController::class, 'guestBankTransfer']);

Route::get('/blog', [BlogController::class, 'index'])->name('public.blogs');
Route::get('/blog/{blog:slug}/blog-details', [BlogController::class, 'blogDetails'])->name('public.blogDetails');

Route::group(['middleware' => 'guest:' . config('fortify.guard')], function () {
    Route::get('/forgot-password/mobile', [MobileResetPasswordController::class, 'mobileView'])->name('forgot-password.mobile');
    Route::match(['get', 'post'], '/forgot-password/mobile/send-otp', [MobileResetPasswordController::class, 'sendOtp'])->name('forgot-password.mobile.send-otp');
    Route::get('/forgot-password/mobile/otp', [MobileResetPasswordController::class, 'otp'])->name('forgot-password.mobile.otp');
    Route::post('/forgot-password/verify/otp', [MobileResetPasswordController::class, 'verifyResetPasswordOtp'])->name('forgot-password.mobile.verify.otp');
});
// Mobile verification
Route::group(['middleware' => ['auth:sanctum', 'verified', 'role:service-provider|customer']], function () {
    Route::get('verify/phone-number', [MobileVerifyController::class, 'verifyPhoneView'])->name('verify.phone');
    Route::post('verify/phone', [MobileVerifyController::class, 'verifyCode'])->name('verify.code');
    Route::get('verify/phone/send-code', [MobileVerifyController::class, 'sendCode'])->name('verify.sendCode');
});

Route::get('add/phone-number', [MobileVerifyController::class, 'addPhoneNumberView'])->name('add.phoneNumber.View');
Route::post('add/phone-number', [MobileVerifyController::class, 'addPhoneNumber'])->name('add.phoneNumber');

//SUPER ADMIN
Route::group(["prefix" => "super-admin", 'middleware' => ['auth:sanctum', 'verified', 'role:super-admin']], function () {
    Route::get('dashboard', [PublicController::class, 'superAdmin'])->name('super-admin.dashboard');
});

//ADMIN
Route::group(["prefix" => "admin", 'middleware' => ['auth:sanctum', 'verified', 'has_any_admin_role', 'checkAccountStatus']], function () {

    Route::get('dashboard', [PublicController::class, 'admin'])->name('admin.dashboard');

    //Manage User
    Route::get('manage-user', [ManageUserController::class, 'index'])->name('admin.manage-user');
    Route::get('manage-user/{user}/edit', [ManageUserController::class, 'edit'])->name('admin.manage-user.edit');
    Route::delete('manage-user/{user}', [ManageUserController::class, 'destroy'])->name('admin.manage-user.destroy');

    Route::get('deactivate-users', [ManageUserController::class, 'deactivate'])->name('admin.manage-user.deactivate');
    Route::post('recovery-user/{user}', [ManageUserController::class, 'recovery']);

    //permission
    Route::get('permission', [PermissionController::class, 'index'])->name('admin.permission');
    Route::get('permission/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permission.edit');
    Route::delete('permission/{permission}', [PermissionController::class, 'destroy'])->name('admin.permission.destroy');

    //role
    Route::get('role', [RoleController::class, 'index'])->name('admin.role');
    Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::delete('role/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    //Service Category
    Route::get('service-category', [ServiceCategoryController::class, 'index'])->name('admin.category');
    Route::get('service-category/{category}/edit', [ServiceCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::delete('service-category/{category}', [ServiceCategoryController::class, 'destroy'])->name('admin.category.destroy');

    //Service Category - Arrange - local
    Route::get('service-category/local/arrange', [ServiceCategoryController::class, 'localSort'])->name('admin.category.localOrder');
    Route::post('service-category/local/update-arrange', [ServiceCategoryController::class, 'updateLocalOrder']);

    //Service Category - Arrange - foreign
    Route::get('service-category/foreign/arrange', [ServiceCategoryController::class, 'foreignSort'])->name('admin.category.foreignOrder');
    Route::post('service-category/foreign/update-arrange', [ServiceCategoryController::class, 'updateForeignOrder']);

    //Sub Category
    Route::get('service-category/{category}/sub-category', [ServiceCategoryController::class, 'subCategory'])->name('admin.subCategory');
    Route::get('service-category/sub-category/{subcategory}/edit', [ServiceCategoryController::class, 'subCategoryEdit'])->name('admin.subCategory.edit');
    Route::delete('service-category/sub-category/{subcategory}', [ServiceCategoryController::class, 'subCategoryDestroy'])->name('admin.subCategory.destroy');

    //Manage Doctors
    Route::get('doctors', [MemberListController::class, 'getDoctorsList'])->name('admin.getDoctorsList');
    Route::get('pending-doctors', [MemberListController::class, 'pendingDoctors'])->name('admin.pendingDoctors');
    Route::get('approved-doctors', [MemberListController::class, 'approvedDoctors'])->name('admin.approvedDoctors');
    Route::get('rejected-doctors', [MemberListController::class, 'rejectedDoctors'])->name('admin.rejectedDoctors');
    Route::get('doctors/{member}/education-details', [MemberListController::class, 'doctorEducation'])->name('admin.doctorEducation');
    Route::get('doctors/{member}/work-details', [MemberListController::class, 'doctorWork'])->name('admin.doctorWork');
    Route::post('doctors/approve-doctor', [MemberListController::class, 'approveDoctor']);
    Route::post('doctors/reject-doctor', [MemberListController::class, 'rejectDoctor']);

    //Manage Service Provider
    Route::get('service-provider', [ServiceProviderController::class, 'index'])->name('admin.serviceProvider');
    Route::get('pending-service-provider', [ServiceProviderController::class, 'pendingServiceProviders'])->name('admin.pendingServiceProviders');
    Route::get('approved-service-provider', [ServiceProviderController::class, 'approvedServiceProviders'])->name('admin.approvedServiceProviders');
    Route::get('rejected-service-provider', [ServiceProviderController::class, 'rejectedServiceProviders'])->name('admin.rejectedServiceProviders');
    Route::post('service-provider/approve', [ServiceProviderController::class, 'approveServiceProvider']);
    Route::post('service-provider/reject', [ServiceProviderController::class, 'rejectServiceProvider']);

    //Members  List
    Route::get('member-list', [MemberListController::class, 'getMembers'])->name('admin.getMembers');
    Route::get('member-list/{member}/member-details', [MemberListController::class, 'memberDetails'])->name('admin.memberDetails');
    Route::get('member-list/{member}/member-service', [MemberListController::class, 'memberServices'])->name('admin.memberServices');

    //Services
    Route::get('manage-services', [ManageServiceController::class, 'index'])->name('admin.getServices');
    Route::post('manage-services/{service}/approve', [ManageServiceController::class, 'approveService']);
    Route::post('manage-services/{service}/reject', [ManageServiceController::class, 'rejectService']);
    Route::get('mange-services/{service}/bank-detail', [ManageServiceController::class, 'bankDetails'])->name('admin.bankDetails');
    Route::get('mange-services/pending-services', [ManageServiceController::class, 'pendingServices'])->name('admin.pendingServices');
    Route::get('mange-services/approve-services', [ManageServiceController::class, 'approveServices'])->name('admin.approveServices');
    Route::get('mange-services/reject-services', [ManageServiceController::class, 'rejectServices'])->name('admin.rejectServices');

    //Inquiry
    Route::get('inquiries', [InquiryController::class, 'getInquiry'])->name('admin.getInquiry');
    Route::get('pending-inquiries', [InquiryController::class, 'pendingInquiries'])->name('admin.pendingInquiries');
    Route::get('unpaid-inquiries', [InquiryController::class, 'unpaidInquiries'])->name('admin.unpaidInquiries');
    Route::get('confirm-inquiries', [InquiryController::class, 'confirmInquiries'])->name('admin.confirmInquiries');
    Route::get('completed-inquiries', [InquiryController::class, 'completedInquiries'])->name('admin.completedInquiries');
    Route::get('rejected-inquiries', [InquiryController::class, 'rejectedInquiries'])->name('admin.rejectedInquiries');
    Route::get('inquiries/{inquiryId}/details', [InquiryController::class, 'getInquiryDetails'])->name('admin.getInquiryDetails');
    Route::post('inquiries/assign-service', [InquiryController::class, 'assignService'])->name('admin.assignService');
    Route::post('inquiries/unassign-service', [InquiryController::class, 'unassignService'])->name('admin.unassignService');
    Route::post('inquiries/save-cost', [InquiryController::class, 'saveCost'])->name('admin.saveCost');
    Route::get('inquiries/check-unread-inquiries', [InquiryController::class, 'checkUnreadInquiries'])->name('admin.checkPendingInquiries');

    Route::post('inquiry/{inquiry}/completed', [InquiryController::class, 'completedInquiry']);
    Route::post('inquiry/{inquiry}/reject', [InquiryController::class, 'rejectInquiry']);

    //Add new inquiry
    Route::get('inquiries/service-categories', [InquiryController::class, 'serviceCategories'])->name('admin.serviceCategories');
    Route::get('service-categories/{serviceCategory:slug}/inquiry', [InquiryController::class, 'newInquiry'])->name('admin.newInquiry');

    //View Availability
    Route::get('inquiries/{service}/availability', [InquiryController::class, 'memberAvailability'])->name('admin.memberAvailability');

    //District
    Route::get('districts', [DistrictController::class, 'index'])->name('admin.province.districts');
    Route::get('districts/{district}/edit', [DistrictController::class, 'edit'])->name('admin.province.districts.edit');
    Route::delete('districts/{district}', [DistrictController::class, 'destroy'])->name('admin.province.districts.destroy');

    //City
    Route::get('districts/{district:slug}/cities', [CityController::class, 'index'])->name('admin.district.city');
    Route::get('districts/{district:slug}/cities/{city}/edit', [CityController::class, 'edit'])->name('admin.district.city.edit');
    Route::delete('districts/cities/{city}', [CityController::class, 'destroy'])->name('admin.district.city.destroy');

    //Service Category
    Route::get('service-category/{category:slug}/input', [ServiceCategoryController::class, 'input'])->name('admin.input');
    Route::get('service-category/input/{input}/edit', [ServiceCategoryController::class, 'inputEdit'])->name('admin.input.edit');
    Route::delete('service-category/input/{input}', [ServiceCategoryController::class, 'inputDestroy'])->name('admin.input.destroy');

    //Reviews
    Route::get('reviews', [AdminReviewsController::class, 'index'])->name('admin.reviews');
    Route::post('reviews/publish', [AdminReviewsController::class, 'publish'])->name('admin.publish');
    Route::post('reviews/unpublish', [AdminReviewsController::class, 'unpublish'])->name('admin.unpublish');
    Route::post('reviews/delete', [AdminReviewsController::class, 'delete'])->name('admin.reviews.delete');

    //Manage Product Category
    Route::get('manage-product-category', [ManageProductCategoryController::class, 'index'])->name('admin.manageProduct');
    Route::get('product-category/{product}/edit', [ManageProductCategoryController::class, 'edit'])->name('admin.productCategory.edit');
    Route::delete('product-category/{productCategory}', [ManageProductCategoryController::class, 'destroy'])->name('admin.productCategory.destroy');

    //Manage Product Sub Category
    Route::get('product-category/{productcategory:slug}/sub-category', [ManageProductCategoryController::class, 'subCategory'])->name('admin.productSubCategory');
    Route::get('product-category/sub-category/{subcategory:slug}/edit', [ManageProductCategoryController::class, 'subCategoryEdit'])->name('admin.productSubCategory.edit');
    Route::delete('product-category/sub-category/{subcategory}', [ManageProductCategoryController::class, 'subCategoryDestroy'])->name('admin.productSubCategory.destroy');

    //Create Product
    Route::get('product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('product/{product:slug}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    Route::post('product/images', [ProductController::class, 'store'])->name('admin.product.store');

    //Arrange Inputs Field
    Route::get('input-fields/{category}/arrange', [ServiceCategoryController::class, 'sort'])->name('admin.inputs.sort');
    Route::post('input-fields/{category}/arrange', [ServiceCategoryController::class, 'updateOrder']);

    // Update Location
    Route::post('{inquiry}/update-location', [InquiryController::class, 'updateLocation']);

    //Orders
    Route::get('orders', [OrderController::class, 'Orders'])->name('admin.orders');
    Route::get('orders/{order}/details', [OrderController::class, 'orderDetails'])->name('admin.orderDetails');
    Route::post('orders/approve-order', [OrderController::class, 'approveOrder']);
    Route::post('orders/reject-order', [OrderController::class, 'rejectOrder']);
    Route::post('order/mark-received/{order}', [OrderController::class, 'markReceived']);
    Route::put('order-item/{orderItem}/price', [OrderController::class, 'updatePrice'])->name('update.product.price');

    //Pages
    Route::get('pages', [PageController::class, 'index'])->name('admin.pages');
    Route::get('pages/{page:slug}/edit', [PageController::class, 'edit'])->name('admin.page.edit');
    Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('admin.page.destroy');


    //Business Profile
    Route::get('business-profile', [BusinessController::class, 'index'])->name('admin.businessProfile');
    Route::get('business-profile/{business}/view-details', [BusinessController::class, 'viewDetails'])->name('admin.viewBusinessProfile');
    Route::post('business-profile/approve', [BusinessController::class, 'approveBusinessProfile']);
    Route::post('business-profile/reject', [BusinessController::class, 'rejectBusinessProfile']);

    //Static Inputs
    Route::get('static-input/{category:slug}', [StaticInputController::class, 'index'])->name('admin.staticInput');
    Route::post('static-input/check', [StaticInputController::class, 'checkStaticInputs']);
    Route::post('static-input/uncheck', [StaticInputController::class, 'uncheckStaticInputs']);

    //Invoice
    Route::get('invoice/{inquiry}', [InquiryController::class, 'invoice'])->name('admin.invoice');

    Route::post('payment/approve', [PaymentController::class, 'approvePayment']);
    Route::post('payment/reject', [PaymentController::class, 'rejectPayment']);

    Route::get('contacts', [ContactUSController::class, 'index'])->name('admin.contact');


    //Payment Invoice
    Route::prefix('payment-invoice')->group(function () {
        Route::get('/all', [PaymentInvoiceController::class, 'all'])->name('admin.paymentInvoice.all');
        Route::get('/paid', [PaymentInvoiceController::class, 'paid'])->name('admin.paymentInvoice.paid');
        Route::get('/pending', [PaymentInvoiceController::class, 'pending'])->name('admin.paymentInvoice.pending');
        Route::get('/unpaid', [PaymentInvoiceController::class, 'unpaid'])->name('admin.paymentInvoice.unpaid');
        Route::get('/{invoice}/payment-detail', [PaymentController::class, 'paymentDetail'])->name('admin.paymentDetail');
    });


    //Banner
    Route::get('banners', [BannerController::class, 'index'])->name('admin.banner');
    Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

    //Arrange Banner
    Route::get('banners/local/{banner}/arrange', [BannerController::class, 'localSort'])->name('admin.banner.localSort');
    Route::post('banners/local/{banner}/arrange', [BannerController::class, 'updateLocalOrder']);
    Route::get('banners/foreign/{banner}/arrange', [BannerController::class, 'foreignSort'])->name('admin.banner.foreignSort');
    Route::post('banners/foreign/{banner}/arrange', [BannerController::class, 'updateForeignOrder']);

    //Commissions
    Route::get('commissions', [CommissionsController::class, 'commission'])->name('admin.commission');
    Route::get('commissions/{service}/{date}/view-inquiries', [CommissionsController::class, 'viewInquiries'])->name('admin.commission.inquiries');
    Route::post('commissions/mark-all-commissions-paid', [CommissionsController::class, 'markAllCommissionsPaid']);
    Route::post('commissions/mark-all-commissions-paid', [CommissionsController::class, 'markAllCommissionsPaid']);

    Route::get('paid-commissions', [CommissionsController::class, 'paidCommission'])->name('admin.commission.paid');
    Route::get('unpaid-commissions', [CommissionsController::class, 'notPaidCommission'])->name('admin.commission.notPaid');
    //Bank
    Route::get('bank', [BankController::class, 'index'])->name('admin.bank');
    Route::get('bank/{bank:slug}/edit', [BankController::class, 'edit'])->name('admin.bank.edit');
    Route::delete('bank/{bank}', [BankController::class, 'destroy']);

    Route::get('{bank:slug}/branch', [BankBranchController::class, 'index'])->name('admin.branch');
    Route::get('branch/{branch:slug}/edit', [BankBranchController::class, 'edit'])->name('admin.branch.edit');
    Route::delete('branch/{branch}', [BankBranchController::class, 'destroy']);

    Route::get('reports/service-providers', [ReportsController::class, 'serviceProviders'])->name('admin.reports.serviceProviders');
    Route::get('reports/doctors', [ReportsController::class, 'doctors'])->name('admin.reports.doctors');
    Route::get('reports/services', [ReportsController::class, 'services'])->name('admin.reports.services');
    Route::get('reports/customers', [ReportsController::class, 'customers'])->name('admin.reports.customers');
    Route::get('reports/inquiries', [ReportsController::class, 'inquiries'])->name('admin.reports.inquiries');
    Route::get('reports/payment-invoices', [ReportsController::class, 'paymentInvoices'])->name('admin.reports.paymentInvoices');

    Route::get('customers', [CustomersController::class, 'index'])->name('admin.customers');
    Route::post('update-user-member-type', [CustomersController::class, 'updateUserMemberType']);

    Route::get('blog', [BlogController::class, 'create'])->name('admin.blog');
    Route::get('blog/{blog:slug}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::delete('blog/{blog}', [BlogController::class, 'destroy']);

    //Testimonials
    Route::get('manage/testimonials', [TestimonialController::class, 'manage'])->name('admin.testimonials.manage');
    Route::get('create/testimonial', [TestimonialController::class, 'create'])->name('admin.testimonial.create');
    Route::get('testimonial/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
    Route::delete('testimonial/{testimonial}', [TestimonialController::class, 'destroy']);
});

//SERVICE-PROVIDER|ADMIN
Route::group(["prefix" => "service-provider", 'middleware' => ['auth:sanctum', 'checkAccountStatus', 'verified', 'role:service-provider|admin'], "as" => 'service-provider.'], function () {

    //Service
    Route::get('service', [MemberServiceController::class, 'index'])->name('service');
    Route::get('service/{service:slug}/edit', [MemberServiceController::class, 'edit'])->name('service.edit')->middleware('signed');
    Route::delete('service/{service}', [MemberServiceController::class, 'destroy']);

    Route::get('service/{service:slug}/bank-details', [BankDetailsController::class, 'index'])->name('bankDetails');

    //My Inquiry
    Route::get('my-inquiry', [MemberInquiryController::class, 'index'])->name('inquiry');
    Route::get('my-inquiry/{inquiryId}/details', [MemberInquiryController::class, 'inquiryDetails'])->name('inquiryDetails')->middleware('signed');
    Route::post('my-inquiry/complete', [MemberInquiryController::class, 'complete'])->name('complete');
    Route::post('my-inquiry/reject', [MemberInquiryController::class, 'reject'])->name('reject');

    //Invoice
    Route::get('invoice/{inquiry}', [MemberInquiryController::class, 'invoice'])->name('invoice')->middleware('signed');

    Route::get('heath-profile/{user}', [HealthProfilesController::class, 'index'])->name('customer.medicalReport')->middleware('signed');


    Route::get('support-tickets', [AdminTicketsController::class, 'index'])->name('adminTickets.index');
    Route::get('support-tickets/{ticket}/view', [AdminTicketsController::class, 'view'])->name('adminView.index');
    Route::post('support-ticket/{ticket}/open', [TicketsController::class, 'open']);
    Route::post('support-ticket/{ticket}/close', [TicketsController::class, 'close']);
    Route::get('support-ticket/{ticket}/view', [TicketsController::class, 'view'])->name('view.index');

    Route::get('education-details/{education}/edit', [EducationController::class, 'edit'])->name('education.edit');

    Route::get('work-details/{workdetail}/edit', [WorkDetailController::class, 'edit'])->name('workDetails.edit');

    Route::get('business-profile/{business?}', [BusinessProfileController::class, 'businessProfile'])->name('profile');
});

//SERVICE-PROVIDER
Route::group(["prefix" => "service-provider", 'middleware' => ['auth:sanctum', 'verified', 'role:service-provider', 'checkAccountStatus'], "as" => 'service-provider.'], function () {

    Route::get('dashboard', [PublicController::class, 'serviceProvider'])->name('dashboard');

    Route::get('bio-data', [BioDataController::class, 'index'])->name('bioData');

    //Education
    Route::get('my-education-details', [EducationController::class, 'index'])->name('education');
    Route::delete('my-education-details/{education}', [EducationController::class, 'destroy'])->name('education.destroy');

    //Work experience
    Route::get('my-work-details', [WorkDetailController::class, 'index'])->name('workDetails');
    Route::delete('my-work-details/{workdetail}', [WorkDetailController::class, 'destroy'])->name('workDetails.destroy');

    //My Reviews
    Route::get('my-reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::get('my-reviews/{serviceCategoryId}', [ReviewController::class, 'viewReviews'])->name('viewReviews');

    //Orders
    Route::get('orders', [MemberOrderController::class, 'orders'])->name('orders')->middleware('profile-completeness');
    Route::get('orders/{order}', [MemberOrderController::class, 'orderDetails'])->name('orderDetails')->middleware('signed');
    Route::post('mark-received/{order}', [MemberOrderController::class, 'markReceived']);


    //Availability
    Route::get('availability', [AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('availability/store', [AvailabilityController::class, 'store'])->name('availability.store');
    Route::post('availability/update', [AvailabilityController::class, 'updateEvent'])->name('availability.update');
    Route::post('availability/delete', [AvailabilityController::class, 'deleteEvent'])->name('availability.deleteEvent');
    Route::post('availability/clone', [AvailabilityController::class, 'cloneEvent'])->name('availability.cloneEvent');



    //Support ticket
    Route::get('support-ticket', [TicketsController::class, 'index'])->name('tickets.index')->middleware('profile-completeness');
    Route::get('support-ticket/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::get('support-ticket/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::delete('support-ticket/{ticket}/delete', [TicketsController::class, 'destroy']);

    Route::get('messages', [MessagesController::class, 'index'])->name('messages');

    Route::get('commission-payout', [CommissionPayoutController::class, 'index'])->name('commission.payout');
    Route::get('paid/commission-payout', [CommissionPayoutController::class, 'paidCommissions'])->name('commission.payout.paid');
    Route::get('unpaid/commission-payout', [CommissionPayoutController::class, 'unpaidCommissions'])->name('commission.payout.unpaid');
});

//CUSTOMER
Route::group(["prefix" => "customer", 'middleware' => ['auth:sanctum', 'verified', 'role:customer', 'checkAccountStatus', 'userFieldsCheck']], function () {

    Route::get('dashboard', [PublicController::class, 'customer'])->name('customer.dashboard');

    //My Inquiry
    Route::get('my-inquiry', [CustomerInquiryController::class, 'myInquiry'])->name('customer.myInquiry');
    Route::get('my-inquiry/{inquiry}', [CustomerInquiryController::class, 'myInquiryDetails'])->name('customer.myInquiryDetails')->middleware('signed');
    Route::post('my-inquiry/reject/{inquiry}', [CustomerInquiryController::class, 'reject'])->name('customer.myInquiry.reject');
    Route::get('my-inquiry/write-review/{inquiryId}', [CustomerInquiryController::class, 'writeReview'])->name('customer.writeReview');


    Route::get('my-invoices', [CustomerInquiryController::class, 'viewInvoice'])->name('customer.invoice.list');

    //My Reviews
    Route::get('my-reviews', [CustomerReviewController::class, 'myReviews'])->name('customer.myReviews');

    //My Orders
    Route::get('my-orders', [CustomerOrderController::class, 'myOrders'])->name('customer.myOrders');
    Route::get('my-orders/{order}/details', [CustomerOrderController::class, 'orderDetails'])->name('customer.orderDetails')->middleware('signed');
    Route::post('mark-received/{order}', [CustomerOrderController::class, 'markReceived']);

    Route::get('invoice/{inquiry}', [CustomerInquiryController::class, 'invoice'])->name('customer.invoice')->middleware('signed');
    Route::post('invoice/online', [CustomerInquiryController::class, 'onlinePay']);
    Route::post('invoice/bank-transfer', [CustomerInquiryController::class, 'bankTransfer']);

    Route::get('health-profile', [HealthProfileController::class, 'index'])->name('customer.healthProfile');
    Route::get('health-profile/{health}/edit', [HealthProfileController::class, 'edit'])->name('customer.healthProfile.edit')->middleware('signed');
    Route::delete('health-profile/{health}', [HealthProfileController::class, 'destroy']);

    Route::get('support-ticket', [CustomerTicketsController::class, 'index'])->name('customer.supportTicket');
    Route::get('support-ticket/create', [CustomerTicketsController::class, 'create'])->name('customer.supportTicket.create');
    Route::get('support-ticket/{ticket}/edit', [CustomerTicketsController::class, 'edit'])->name('customer.supportTicket.edit');
    Route::delete('support-ticket/{ticket}/delete', [CustomerTicketsController::class, 'destroy']);

    Route::post('support-ticket/{ticket}/open', [CustomerTicketsController::class, 'open']);
    Route::post('support-ticket/{ticket}/close', [CustomerTicketsController::class, 'close']);
    Route::get('support-ticket/{ticket}/view', [CustomerTicketsController::class, 'view'])->name('customer.supportTicket.view');

    Route::get('messages', [CustomerMessagesController::class, 'index'])->name('customer.messages');

    Route::get('invoice/online-payment/success', [CustomerInvoiceController::class, 'success'])->name('customer.invoiceOnlinePayment.success');
    Route::get('invoice/online-payment/cancelled', [CustomerInvoiceController::class, 'cancelled'])->name('customer.invoiceOnlinePayment.cancelled');
});
