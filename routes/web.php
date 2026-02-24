<?php

use App\Lead;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    WebsiteController,
    UsersController,
    ApiController,
    PermissionController,
    RoleController,
    ProcessController,
    EmailCronJobController,
    LogViewerController
};
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Auth\{
    LoginController,
    SocialLoginController
};

use App\Http\Controllers\CommonSetting\CommonSettingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\CustomerType\CustomerTypeController;
use App\Http\Controllers\CustomerPhone\CustomerPhoneController;
use App\Http\Controllers\ReferralSource\ReferralSourceController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Lead\LeadController;
use App\Http\Controllers\ControlPanel\ControlPanelController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\SalesMan\SalesManController;
use App\Http\Controllers\YearEstimation\YearEstimationController;
use App\Http\Controllers\YearEstimateMonth\YearEstimateMonthController;
use App\Http\Controllers\Stage\StageController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\AppointmentAttendee\AppointmentAttendeeController;
use App\Http\Controllers\AppointmentAttachment\AppointmentAttachmentController;
use App\Http\Controllers\TermAndCondition\TermAndConditionController;
use App\Http\Controllers\PhotoAndDocument\PhotoAndDocumentController;
use App\Http\Controllers\PhotoAndDocumentAttachment\PhotoAndDocumentAttachmentController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\TaskAttachments\TaskAttachmentsController;
use App\Http\Controllers\TaskAssignUser\TaskAssignUserController;
use App\Http\Controllers\JobNote\JobNoteController;
use App\Http\Controllers\JobNoteAttachment\JobNoteAttachmentController;
use App\Http\Controllers\UserMailSend\UserMailSendController;
use App\Http\Controllers\UserMailSendAttachment\UserMailSendAttachmentController;
use App\Http\Controllers\FollowUpCallNote\FollowUpCallNoteController;
use App\Http\Controllers\FollowUpCallNotesUser\FollowUpCallNotesUserController;
use App\Http\Controllers\Estimate\EstimateController;
use App\Http\Controllers\EstimateAttachment\EstimateAttachmentController;
use App\Http\Controllers\Proposal\ProposalController;
use App\Http\Controllers\ProposalAttachment\ProposalAttachmentController;
use App\Http\Controllers\ReceivePayment\ReceivePaymentController;
use App\Http\Controllers\PaymentType\PaymentTypeController;
use App\Http\Controllers\Mark\MarkController;
use App\Http\Controllers\WorkCrew\WorkCrewController;
use App\Http\Controllers\WorkCrewJobRepresentative\WorkCrewJobRepresentativeController;
use App\Http\Controllers\WorkCrewCompanyCrew\WorkCrewCompanyCrewController;
use App\Http\Controllers\WorkCrewLabour\WorkCrewLabourController;
use App\Http\Controllers\ProgressBoard\ProgressBoardController;
use App\Http\Controllers\ProgressBoardCategory\ProgressBoardCategoryController;
use App\Http\Controllers\Material\MaterialController;
use App\Http\Controllers\MaterialAttachment\MaterialAttachmentController;
use App\Http\Controllers\MaterialDeliveryDate\MaterialDeliveryDateController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Priority\PriorityController;
use App\Http\Controllers\Announcement\AnnouncementController;
use App\Http\Controllers\AssignAnnouncement\AssignAnnouncementController;
use App\Http\Controllers\ChangeOrder\ChangeOrderController;
use App\Http\Controllers\ChangeOrderAttachment\ChangeOrderAttachmentController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\InvoiceAttachment\InvoiceAttachmentController;
use App\Http\Controllers\UsersMailboxConfiguration\UsersMailboxConfigurationController;
use App\Http\Controllers\UsersMailboxesSent\UsersMailboxesSentController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Http\Controllers\CampaignDetail\CampaignDetailController;
use App\Http\Controllers\ReportPermission\ReportPermissionController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\LeadStage\LeadStageController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\LeadMail\LeadMailController;
use App\Http\Controllers\EmailTemplate\EmailTemplateController;
use App\Http\Controllers\EmailTemplateAttachment\EmailTemplateAttachmentController;
use App\Http\Controllers\ProposalTemplate\ProposalTemplateController;
use App\Http\Controllers\ProposalTemplateAttachment\ProposalTemplateAttachmentController;
use App\Http\Controllers\CostOfGoodSold\CostOfGoodSoldController;
use App\Http\Controllers\CogsMaterial\CogsMaterialController;
use App\Http\Controllers\CompanyContact\CompanyContactController;
use App\Http\Controllers\CustomerCommunication\CustomerCommunicationController;
use App\Http\Controllers\Advertisement\AdvertisementController;
use App\Http\Controllers\MonthlyAdvertisement\MonthlyAdvertisementController;
use App\Http\Controllers\SchedulingTask\SchedulingTaskController;
use App\Http\Controllers\SchedulingTaskUser\SchedulingTaskUserController;
use App\Http\Controllers\RoofEstimateCalculator\RoofEstimateCalculatorController;
use App\Http\Controllers\RoofEstimateCalculatorLabel\RoofEstimateCalculatorLabelController;
use App\Http\Controllers\RoofEstimateCalculatorEaveRake\RoofEstimateCalculatorEaveRakeController;
use App\Http\Controllers\RoofEstimateCalculatorFlatArea\RoofEstimateCalculatorFlatAreaController;
use App\Http\Controllers\RoofEstimateCalculatorDownspout\RoofEstimateCalculatorDownspoutController;
use App\Http\Controllers\Roofestimatecalculatorpreferd\RoofestimatecalculatorpreferdController;
use App\Http\Controllers\RoofEstimateCalculatorSystem\RoofEstimateCalculatorSystemController;
use App\Http\Controllers\StoreRoofEstimateCalculatorUnderfifteenSQ\StoreRoofEstimateCalculatorUnderfifteenSQController;
use App\Http\Controllers\RoofEstimateCalculatorFlatRoof\RoofEstimateCalculatorFlatRoofController;
use App\Http\Controllers\StoreRoofEstimateCalculatorGutter\StoreRoofEstimateCalculatorGutterController;
use App\Http\Controllers\Holiday\HolidayController;
use App\Http\Controllers\HolidayDate\HolidayDateController;
use App\Http\Controllers\SidingEstimateCalculator\SidingEstimateCalculatorController;
use App\Http\Controllers\SidingEstimateCalculatorLabel\SidingEstimateCalculatorLabelController;
use App\Http\Controllers\SidingEstimateCalculatorFlatArea\SidingEstimateCalculatorFlatAreaController;
use App\Http\Controllers\SidingEstimateCalculatorDownspout\SidingEstimateCalculatorDownspoutController;
use App\Http\Controllers\StoreSideEstimateCalculatorGutter\StoreSideEstimateCalculatorGutterController;
use App\Http\Controllers\ChimneyEstimateCalculator\ChimneyEstimateCalculatorController;
use App\Http\Controllers\ChimneyEstimateCalculatorLabel\ChimneyEstimateCalculatorLabelController;
use App\Http\Controllers\ChimneyEstimateBricksRow\ChimneyEstimateBricksRowController;
use App\Http\Controllers\StoreChimneyEstimateCalculatorChimney\StoreChimneyEstimateCalculatorChimneyController;
use App\Http\Controllers\StoreChimneyEstimateCalculatorLiner\StoreChimneyEstimateCalculatorLinerController;
use App\Http\Controllers\ProductPricingEstimateCalculator\ProductPricingEstimateCalculatorController;
use App\Http\Controllers\ProductPricingEstimateCalculatorLabels\ProductPricingEstimateCalculatorLabelsController;
use App\Http\Controllers\ProductPricingEstimateCalculatorEaveRakes\ProductPricingEstimateCalculatorEaveRakesController;
use App\Http\Controllers\ProductPricingEstimateCalculatorFlatArea\ProductPricingEstimateCalculatorFlatAreaController;
use App\Http\Controllers\ProductPricingEstimateCalculatorDownspouts\ProductPricingEstimateCalculatorDownspoutsController;
use App\Http\Controllers\StoreProductPricingMaterialList\StoreProductPricingMaterialListController;
use App\Http\Controllers\StoreProductPricingPriceList\StoreProductPricingPriceListController;
use App\Http\Controllers\ProductPricingPriceList\ProductPricingPriceListController;
use App\Http\Controllers\ProductPricePdfMeasurement\ProductPricePdfMeasurementController;
use App\Http\Controllers\ProductPricePdfTotal\ProductPricePdfTotalController;
use App\Http\Controllers\ProductPricePdfAreaPitch\ProductPricePdfAreaPitchController;
use App\Http\Controllers\EmailTemplateVariable\EmailTemplateVariableController;
use App\Http\Controllers\StoreSideEstimateReplacement\StoreSideEstimateReplacementController;
use App\Http\Controllers\StoreSideEstimateOverExist\StoreSideEstimateOverExistController;
use App\Http\Controllers\CalculatorSize\CalculatorSizeController;
use App\Http\Controllers\EmailVariableType\EmailVariableTypeController;
use App\Http\Controllers\ProductPriceSkylight\ProductPriceSkylightController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\ProductCategory\ProductCategoryController;
use App\Http\Controllers\ProductMaterialSection\ProductMaterialSectionController;
use App\Http\Controllers\FolderManagement\FolderManagementController;
use App\Http\Controllers\FolderManagementAttachment\FolderManagementAttachmentController;
use App\Http\Controllers\FinanceSheet\FinanceSheetController;
use App\Http\Controllers\FinanceGrossIncome\FinanceGrossIncomeController;
use App\Http\Controllers\FinanceCogs\FinanceCogsController;
use App\Http\Controllers\FinanceGrossExpense\FinanceGrossExpenseController;
use App\Http\Controllers\FinanceOhExpense\FinanceOhExpenseController;
use App\Http\Controllers\CampaignAttachment\CampaignAttachmentController;
use App\Http\Controllers\CalculatorBaseValue\CalculatorBaseValueController;
use App\Http\Controllers\UserCheckIn\UserCheckInController;
use App\Http\Controllers\PositionBlock\PositionBlockController;
use App\Http\Controllers\StaffFinance\StaffFinanceController;
use App\Http\Controllers\Call\CallController;
use App\Http\Controllers\EmailTemplateFolder\EmailTemplateFolderController;
use App\Http\Controllers\CustomerOwnerType\CustomerOwnerTypeController;
use App\Http\Controllers\Credit\CreditController;
use App\Http\Controllers\Refund\RefundController;
use App\Http\Controllers\Trade\TradeController;
use App\Http\Controllers\SubContractorCompanyDetail\SubContractorCompanyDetailController;
use App\Http\Controllers\MaterialListing\MaterialListingController;
use App\Http\Controllers\SubContractorInsuranceInfo\SubContractorInsuranceInfoController;
use App\Http\Controllers\SubContractorRecurringEmail\SubContractorRecurringEmailController;
use App\Http\Controllers\SubContractorProposal\SubContractorProposalController;
use App\Http\Controllers\RoofEstimateSkylight\RoofEstimateSkylightController;
use App\Http\Controllers\EmailBranding\EmailBrandingController;
use App\Http\Controllers\SubContractorInvoice\SubContractorInvoiceController;
use App\Http\Controllers\SubContractorInvoiceAttachment\SubContractorInvoiceAttachmentController;
use App\Http\Controllers\SubContractorReceiveable\SubContractorReceiveableController;
use App\Http\Controllers\ChatMessage\ChatMessageController;
use App\Http\Controllers\ProductTemplate\ProductTemplateController;
use App\Http\Controllers\ProductListTemplate\ProductListTemplateController;
use App\Http\Controllers\ProposalType\ProposalTypeController;
use App\Http\Controllers\ChatBotRoom\ChatBotRoomController;
use App\Http\Controllers\ChatBotMessage\ChatBotMessageController;
use App\Http\Controllers\CustomerReferral\CustomerReferralController;
use App\Http\Controllers\WorkForceHour\WorkForceHourController;
use App\Http\Controllers\SubContractorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Route::get('abc', function () {
    $leads = Lead::where('progress_status', 1)->get();
    return $leads;
});


Route::get('testing', [WebsiteController::class, 'testing'])->name('testing');

// Central domain home - redirect to login or admin panel
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
})->name('index');

// Laravel 11 Fix: Allow all authenticated users to access dashboard
// The dashboard controller will handle role-based content display
Route::group(['middleware' => ['universal', 'auth']], function () {
    Route::get('/dashboard', [WebsiteController::class, 'dashboard']);
    Route::get('account-settings', [UsersController::class, 'getSettings']);
    Route::post('account-settings', [UsersController::class, 'saveSettings']);

    // User Management routes
    Route::get('users', [UsersController::class, 'getIndex']);
    Route::get('user/create', [UsersController::class, 'create']);
    Route::post('user/create', [UsersController::class, 'save']);
    Route::get('user/edit/{id}', [UsersController::class, 'edit']);
    Route::post('user/edit/{id}', [UsersController::class, 'update']);
    Route::get('user/delete/{id}', [UsersController::class, 'delete']);
    Route::get('user/deleted/', [UsersController::class, 'getDeletedUsers']);
    Route::get('user/restore/{id}', [UsersController::class, 'restoreUser']);

    Route::get('campaign', [WebsiteController::class, 'campaign'])->name('campaign');
    Route::get('customize_proposals/{id}', [WebsiteController::class, 'customizeProposals'])->name('customize_proposals');
    Route::get('customize_proposals_new/{id}', [WebsiteController::class, 'customizeProposalsNew'])->name('customize_proposals_new');
    Route::post('store_customize_proposals', [WebsiteController::class, 'storeCustomizeProposals'])->name('store_customize_proposals');
    Route::get('customize_proposals_edit/{id}', [WebsiteController::class, 'customizeProposalsEdit'])->name('customize_proposals_edit');
    Route::get('customize_signature_proposals/{id}', [WebsiteController::class, 'customizeSignatureProposals'])->name('customize_signature_proposals');
    Route::get('user_draft_proposals/{id}', [WebsiteController::class, 'userDraftProposals'])->name('user_draft_proposals');
    Route::get('proposal_generator', [WebsiteController::class, 'proposalGenerator'])->name('proposal_generator');
    Route::get('sub_contractor', [WebsiteController::class, 'subContractor'])->name('sub_contractor');
    Route::post('upload_proposal_image', [WebsiteController::class, 'uploadProposalImage'])->name('upload_proposal_image');
    Route::post('upload_proposal_screen_shot', [WebsiteController::class, 'uploadProposalScreenShot'])->name('upload_proposal_screen_shot');
    Route::post('customize_proposals_duplicate/{id}', [WebsiteController::class, 'customizeProposalsDuplicate'])->name('customize_proposals_duplicate');


    //Route::get('staff', [WebsiteController::class, 'staff'])->name('staff');
    Route::get('leads', [WebsiteController::class, 'leads'])->name('leads');
    Route::get('sales_team', [WebsiteController::class, 'salesTeam'])->name('sales_team');
    Route::get('target', [WebsiteController::class, 'target'])->name('target');
    Route::get('work_type', [WebsiteController::class, 'workType'])->name('work_type');
    Route::get('call', [WebsiteController::class, 'call'])->name('call');
    Route::get('customer_manager', [WebsiteController::class, 'customerManager'])->name('customer_manager');
    Route::get('user_profile', [WebsiteController::class, 'profile'])->name('user_profile')->middleware('auth');
    Route::get('change_password', [WebsiteController::class, 'changePassword'])->name('change_password')->middleware('auth');
    Route::get('terms_and_condition', [WebsiteController::class, 'termsAndCondition'])->name('terms_and_condition')->middleware('auth');
    Route::get('email', [WebsiteController::class, 'email'])->name('email');
    Route::get('new_email', [WebsiteController::class, 'newEmail'])->name('new_email');
    Route::get('message', [WebsiteController::class, 'message'])->name('message');
    Route::get('jobs_won', [WebsiteController::class, 'jobsWon'])->name('jobs_won')->middleware('auth');
    Route::get('performance', [WebsiteController::class, 'performance'])->name('performance');
    Route::get('summary', [WebsiteController::class, 'summary'])->name('summary')->middleware('auth');
    Route::get('by_salesman', [WebsiteController::class, 'bySalesManReport'])->name('by_salesman')->middleware('auth');
    Route::get('job_listings/{representative_id?}', [WebsiteController::class, 'jobListings'])->name('job_listings')->middleware('auth');
    Route::get('company_performance', [WebsiteController::class, 'companyPerformance'])->name('company_performance');
    Route::get('profit_loss_analysis', [WebsiteController::class, 'profitLossAnalysis'])->name('profit_loss_analysis');
    Route::get('create_leads', [WebsiteController::class, 'createLeads'])->name('create_leads');
    Route::get('email_templating', [WebsiteController::class, 'emailTemplating'])->name('email_templating');
    Route::get('customer_detail', [WebsiteController::class, 'customerDetail'])->name('customer_detail');
    Route::post('phone_authentication', [WebsiteController::class, 'phoneAuthentication'])->name('phone_authentication');
    Route::get('create_staff', [WebsiteController::class, 'createStaff'])->name('create_staff');
    Route::get('proposal', [WebsiteController::class, 'showProposal'])->name('proposal');
    Route::get('proposal_editor', [WebsiteController::class, 'proposalEditor'])->name('proposal_editor');
    Route::get('get_activities/{leadId}', [WebsiteController::class, 'getActivities'])->name('get_activities');


    Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
        //    Route::get('/dashboard', function () {
        //        return view('dashboard.index');
        //    });
        Route::get('index2', function () {
            return view('dashboard.index2');
        });
        Route::get('index3', function () {
            return view('dashboard.index3');
        });
        Route::get('index4', function () {
            return view('ecommerce.index4');
        });
        Route::get('products', function () {
            return view('ecommerce.products');
        });
        Route::get('product-detail', function () {
            return view('ecommerce.product-detail');
        });
        Route::get('product-edit', function () {
            return view('ecommerce.product-edit');
        });
        Route::get('product-orders', function () {
            return view('ecommerce.product-orders');
        });
        Route::get('product-cart', function () {
            return view('ecommerce.product-cart');
        });
        Route::get('product-checkout', function () {
            return view('ecommerce.product-checkout');
        });
        Route::get('panels-wells', function () {
            return view('ui-elements.panels-wells');
        });
        Route::get('panel-ui-block', function () {
            return view('ui-elements.panel-ui-block');
        });
        Route::get('portlet-draggable', function () {
            return view('ui-elements.portlet-draggable');
        });
        Route::get('buttons', function () {
            return view('ui-elements.buttons');
        });
        Route::get('tabs', function () {
            return view('ui-elements.tabs');
        });
        Route::get('modals', function () {
            return view('ui-elements.modals');
        });
        Route::get('progressbars', function () {
            return view('ui-elements.progressbars');
        });
        Route::get('notification', function () {
            return view('ui-elements.notification');
        });
        Route::get('carousel', function () {
            return view('ui-elements.carousel');
        });
        Route::get('user-cards', function () {
            return view('ui-elements.user-cards');
        });
        Route::get('timeline', function () {
            return view('ui-elements.timeline');
        });
        Route::get('timeline-horizontal', function () {
            return view('ui-elements.timeline-horizontal');
        });
        Route::get('range-slider', function () {
            return view('ui-elements.range-slider');
        });
        Route::get('ribbons', function () {
            return view('ui-elements.ribbons');
        });
        Route::get('steps', function () {
            return view('ui-elements.steps');
        });
        Route::get('session-idle-timeout', function () {
            return view('ui-elements.session-idle-timeout');
        });
        Route::get('session-timeout', function () {
            return view('ui-elements.session-timeout');
        });
        Route::get('bootstrap-ui', function () {
            return view('ui-elements.bootstrap');
        });
        Route::get('starter-page', function () {
            return view('pages.starter-page');
        });
        Route::get('blank', function () {
            return view('pages.blank');
        });
        Route::get('blank', function () {
            return view('pages.blank');
        });
        Route::get('search-result', function () {
            return view('pages.search-result');
        });
        Route::get('custom-scroll', function () {
            return view('pages.custom-scroll');
        });
        Route::get('lock-screen', function () {
            return view('pages.lock-screen');
        });
        Route::get('recoverpw', function () {
            return view('pages.recoverpw');
        });
        Route::get('animation', function () {
            return view('pages.animation');
        });
        Route::get('profile', function () {
            return view('pages.profile');
        });
        Route::get('invoice', function () {
            return view('pages.invoice');
        });
        Route::get('gallery', function () {
            return view('pages.gallery');
        });
        Route::get('pricing', function () {
            return view('pages.pricing');
        });
        Route::get('400', function () {
            return view('pages.400');
        });
        Route::get('403', function () {
            return view('pages.403');
        });
        Route::get('404', function () {
            return view('pages.404');
        });
        Route::get('500', function () {
            return view('pages.500');
        });
        Route::get('503', function () {
            return view('pages.503');
        });
        Route::get('form-basic', function () {
            return view('forms.form-basic');
        });
        Route::get('form-layout', function () {
            return view('forms.form-layout');
        });
        Route::get('icheck-control', function () {
            return view('forms.icheck-control');
        });
        Route::get('form-advanced', function () {
            return view('forms.form-advanced');
        });
        Route::get('form-upload', function () {
            return view('forms.form-upload');
        });
        Route::get('form-dropzone', function () {
            return view('forms.form-dropzone');
        });
        Route::get('form-pickers', function () {
            return view('forms.form-pickers');
        });
        Route::get('basic-table', function () {
            return view('tables.basic-table');
        });
        Route::get('table-layouts', function () {
            return view('tables.table-layouts');
        });
        Route::get('data-table', function () {
            return view('tables.data-table');
        });
        Route::get('bootstrap-tables', function () {
            return view('tables.bootstrap-tables');
        });
        Route::get('responsive-tables', function () {
            return view('tables.responsive-tables');
        });
        Route::get('editable-tables', function () {
            return view('tables.editable-tables');
        });
        Route::get('inbox', function () {
            return view('inbox.inbox');
        });
        Route::get('inbox-detail', function () {
            return view('inbox.inbox-detail');
        });
        Route::get('compose', function () {
            return view('inbox.compose');
        });
        Route::get('contact', function () {
            return view('inbox.contact');
        });
        Route::get('contact-detail', function () {
            return view('inbox.contact-detail');
        });
        Route::get('calendar', function () {
            return view('extra.calendar');
        });
        Route::get('widgets', function () {
            return view('extra.widgets');
        });
        Route::get('morris-chart', function () {
            return view('charts.morris-chart');
        });
        Route::get('peity-chart', function () {
            return view('charts.peity-chart');
        });
        Route::get('knob-chart', function () {
            return view('charts.knob-chart');
        });
        Route::get('sparkline-chart', function () {
            return view('charts.sparkline-chart');
        });
        Route::get('simple-line', function () {
            return view('icons.simple-line');
        });
        Route::get('fontawesome', function () {
            return view('icons.fontawesome');
        });
        Route::get('map-google', function () {
            return view('maps.map-google');
        });
        Route::get('map-vector', function () {
            return view('maps.map-vector');
        });

        #Permission management
        Route::get('permission-management', [PermissionController::class, 'getIndex']);
        Route::get('permission/create', [PermissionController::class, 'create']);
        Route::post('permission/create', [PermissionController::class, 'save']);
        Route::get('permission/delete/{id}', [PermissionController::class, 'delete']);
        Route::get('permission/edit/{id}', [PermissionController::class, 'edit']);
        Route::post('permission/edit/{id}', [PermissionController::class, 'update']);

        #Role management
        Route::get('role-management', [RoleController::class, 'getIndex']);
        Route::get('role/create', [RoleController::class, 'create']);
        Route::post('role/create', [RoleController::class, 'save']);
        Route::get('role/delete/{id}', [RoleController::class, 'delete']);
        Route::get('role/edit/{id}', [RoleController::class, 'edit']);
        Route::post('role/edit/{id}', [RoleController::class, 'update']);

        #CRUD Generator
        Route::get('/crud-generator', ['uses' => [ProcessController::class, 'getGenerator']]);
        Route::post('/crud-generator', ['uses' => [ProcessController::class, 'postGenerator']]);

        # Activity log
        Route::get('activity-log', [LogViewerController::class, 'getActivityLog']);
        Route::get('activity-log/data', [LogViewerController::class, 'activityLogData'])->name('activity-log.data');

        #User Management routes
        //    Route::get('users',[UsersController::class, 'getIndex']);
        //    Route::get('user/create',[UsersController::class, 'create']);
        //    Route::post('user/create',[UsersController::class, 'save']);
        //    Route::get('user/edit/{id}',[UsersController::class, 'edit']);
        //    Route::post('user/edit/{id}',[UsersController::class, 'update']);
        //    Route::get('user/delete/{id}',[UsersController::class, 'delete']);
        //    Route::get('user/deleted/',[UsersController::class, 'getDeletedUsers']);
        //    Route::get('user/restore/{id}',[UsersController::class, 'restoreUser']);
    });

    //Log Viewer
    Route::get('log-viewers', [LogViewerController::class, 'index'])->name('log-viewers');
    Route::get('log-viewers/logs', [LogViewerController::class, 'listLogs'])->name('log-viewers.logs');
    Route::delete('log-viewers/logs/delete', [LogViewerController::class, 'delete'])->name('log-viewers.logs.delete');
    Route::get('log-viewers/logs/{date}', [LogViewerController::class, 'show'])->name('log-viewers.logs.show');
    Route::get('log-viewers/logs/{date}/download', [LogViewerController::class, 'download'])->name('log-viewers.logs.download');
    Route::get('log-viewers/logs/{date}/{level}', [LogViewerController::class, 'showByLevel'])->name('log-viewers.logs.filter');
    Route::get('log-viewers/logs/{date}/{level}/search', [LogViewerController::class, 'search'])->name('log-viewers.logs.search');
    Route::get('log-viewers/logcheck', [LogViewerController::class, 'logCheck'])->name('log-viewers.logcheck');


    // Social Login Routes
    Route::get('auth/{provider}/', [SocialLoginController::class, 'redirectToProvider']);
    Route::get('{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

    // Logout Route
    Route::get('logout', [LoginController::class, 'logout'])->middleware('universal');

    // Auth Routes (Login, Register, Password Reset)
    // Universal routes - work in both central and tenant contexts
    Route::middleware(['universal'])->group(function () {
        Auth::routes();
    });

    // Common Settings
    Route::resource('commonSetting/common-setting', CommonSettingController::class);
    Route::get('/clear-all', function () {
        $exitCodeConfig = Artisan::call('storage:link');
        $exitCodeConfig = Artisan::call('route:clear');
        $exitCodeCache  = Artisan::call('cache:clear');
        $exitCodeUpdate = Artisan::call('optimize:clear');
        $exitCodeView   = Artisan::call('view:clear');
        // $exitCodePermissionCache = Artisan::call('permission:cache-reset');
        //$exitCodePermissionCache = Artisan::call('cache:forget laravelspatie.permission.cache');
        return '<div style="text-align:center;"> <h1 style="text-align:center;">Cache and Config and permission cache are cleared.</h1><h4><a href="/">Go to home</a></h4></div>';
    });

    Route::get('/schedule-run', function () {
        Artisan::call('schedule:run');
    });

    // Resource Routes - Laravel 11 Style
    Route::resource('customerType/customer-type', CustomerTypeController::class);
    Route::resource('customer/customer', CustomerController::class);
    Route::resource('customerPhone/customer-phone', CustomerPhoneController::class);
    Route::resource('referralSource/referral-source', ReferralSourceController::class);
    Route::resource('staff/staff', StaffController::class);
    Route::get('get_role_details_staff/{id?}', [StaffController::class, 'getRoleDetails'])->name('get_role_details_staff');


    Route::resource('category/category', CategoryController::class);
    Route::resource('salesMan/sales-man', SalesManController::class);
    Route::get('get_role_details_sales_man/{id?}', [SalesManController::class, 'getRoleDetails'])->name('get_role_details_sales_man');


    Route::resource('lead/lead', LeadController::class);
    Route::resource('yearEstimation/year-estimation', YearEstimationController::class);
    Route::resource('yearEstimateMonth/year-estimate-month', YearEstimateMonthController::class);
    Route::resource('stage/stage', StageController::class);
    Route::resource('appointment/appointment', AppointmentController::class);
    Route::resource('appointmentAttendee/appointment-attendee', AppointmentAttendeeController::class);


    Route::post('upload_task_attachment', [WebsiteController::class, 'uploadTaskAttachment'])->name('upload_task_attachment');
    Route::get('remove_task_attachment/{image_name?}', [WebsiteController::class, 'removeTaskAttachment'])->name('remove_task_attachment');

    Route::post('upload_estimate_attachment', [WebsiteController::class, 'uploadEstimateAttachment'])->name('upload_estimate_attachment');
    Route::get('remove_estimate_attachment/{image_name?}', [WebsiteController::class, 'removeEstimateAttachment'])->name('remove_estimate_attachment');


    Route::post('upload_proposal_attachment', [WebsiteController::class, 'uploadProposalAttachment'])->name('upload_proposal_attachment');
    Route::get('remove_proposal_attachment/{image_name?}', [WebsiteController::class, 'removeProposalAttachment'])->name('remove_proposal_attachment');

    Route::post('upload_appointment_attachment', [WebsiteController::class, 'uploadAppointmentAttachment'])->name('upload_appointment_attachment');
    Route::get('remove_appointment_attachment/{image_name?}', [WebsiteController::class, 'removeAppointmentAttachment'])->name('remove_appointment_attachment');

    Route::post('upload_job_note_attachment', [WebsiteController::class, 'uploadJobAttachment'])->name('upload_job_note_attachment');
    Route::get('remove_job_note_attachment/{image_name?}', [WebsiteController::class, 'removeJobAttachment'])->name('remove_job_note_attachment');

    Route::post('upload_proposal_template_attachment', [WebsiteController::class, 'uploadProposalTemplateAttachment'])->name('upload_proposal_template_attachment');
    Route::get('remove_proposal_template_attachment/{image_name?}', [WebsiteController::class, 'removeProposalTemplateAttachment'])->name('remove_proposal_template_attachment');

    Route::post('upload_email_template_attachment', [WebsiteController::class, 'uploadEmailTemplateAttachment'])->name('upload_email_template_attachment');
    Route::get('remove_email_template_attachment/{image_name?}', [WebsiteController::class, 'removeEmailTemplateAttachment'])->name('remove_email_template_attachment');

    Route::post('upload_material_attachment', [WebsiteController::class, 'uploadMaterialAttachment'])->name('upload_material_attachment');
    Route::get('remove_material_attachment/{image_name?}', [WebsiteController::class, 'removeMaterialAttachment'])->name('remove_material_attachment');

    Route::post('upload_email_attachment', [WebsiteController::class, 'uploadEmailAttachment'])->name('upload_email_attachment');
    Route::post('email_send', [WebsiteController::class, 'EmailSend'])->name('email_send');
    Route::get('email_send', [WebsiteController::class, 'EmailSend'])->name('email_send');

    Route::post('update_lead_price', [WebsiteController::class, 'updateLeadPrice'])->name('update_lead_price');
    Route::post('update_positions', [WebsiteController::class, 'updatePositions'])->name('update_positions');
    Route::post('update_lead_positions', [WebsiteController::class, 'updateLeadPositions'])->name('update_lead_positions');

    Route::get('remove_email_attachment/{image_name?}', [WebsiteController::class, 'removeEmailAttachment'])->name('remove_email_attachment');

    Route::post('upload_photo_and_documents_attachment', [WebsiteController::class, 'uploadPhotoAndDocumentsAttachment'])->name('upload_photo_and_documents_attachment');
    Route::get('remove_photo_and_documents_attachment/{image_name?}', [WebsiteController::class, 'removePhotoAndDocumentsAttachment'])->name('remove_photo_and_documents_attachment');
    Route::get('lead_dropdown', [WebsiteController::class, 'leadDropdown'])->name('lead_dropdown');
    Route::get('reporting_for_stages', [WebsiteController::class, 'reportingForStages'])->name('reporting_for_stages');

    Route::resource('appointmentAttachment/appointment-attachment', AppointmentAttachmentController::class);

    Route::get('logActivity', [WebsiteController::class, 'logActivity']);
    Route::get('delete_stream', [WebsiteController::class, 'deleteStream'])->name('delete_stream');
    Route::get('status_change_stages/{id?}/{status?}', [WebsiteController::class, 'statusChangeStages'])->name('status_change_stages');
    Route::get('status_change_campaign/{id?}/{status?}', [WebsiteController::class, 'statusChangeCampaign'])->name('status_change_campaign');
    Route::get('status_change_appointment/{id?}/{status?}', [WebsiteController::class, 'statusChangeAppointment'])->name('status_change_appointment');
    Route::get('status_change_jobnote/{id?}/{status?}', [WebsiteController::class, 'statusChangeJobnote'])->name('status_change_jobnote');
    Route::get('status_change_payment_type/{id?}/{status?}', [WebsiteController::class, 'statusChangePaymentType'])->name('status_change_payment_type');
    Route::get('status_change_mark/{id?}/{status?}', [WebsiteController::class, 'statusChangeMark'])->name('status_change_mark');
    Route::get('status_change_category/{id?}/{status?}', [WebsiteController::class, 'statusChangeCategory'])->name('status_change_category');
    Route::get('status_change_referral_source/{id?}/{status?}', [WebsiteController::class, 'statusChangeReferralSource'])->name('status_change_referral_source');
    Route::get('status_change_priority/{id?}/{status?}', [WebsiteController::class, 'statusChangePriority'])->name('status_change_priority');
    Route::get('status_change_notification/{id?}', [WebsiteController::class, 'statusChangeNotification'])->name('status_change_notification');
    Route::get('delete_logs/{id?}', [WebsiteController::class, 'deleteLogs'])->name('delete_logs');
    Route::get('view_lead/{id?}', [WebsiteController::class, 'bySalesman'])->name('view_lead')->middleware('auth');
    Route::get('stages_update', [WebsiteController::class, 'stagesUpdate'])->name('stages_update');
    Route::post('update_stage_automation', [WebsiteController::class, 'updateStageAutomation'])->name('update_stage_automation');
    Route::post('profile_update', [WebsiteController::class, 'profileUpdate'])->name('profile_update');
    Route::post('change_user_password', [WebsiteController::class, 'changeUserPassword'])->name('change_user_password');
    Route::post('/checkPassword', [WebsiteController::class, 'checkpasswordvalid'])->name('check_password');
    Route::post('/check_email', [WebsiteController::class, 'checkEmail'])->name('check_email');
    Route::get('/get_logs', [WebsiteController::class, 'getLogs'])->name('get_logs');
    Route::get('/lead_by_stages/{stage_id?}/{year?}', [WebsiteController::class, 'leadByStages'])->name('lead_by_stages');
    Route::get('view_appointment_detail', [WebsiteController::class, 'viewAppointmentDetail'])->name('view_appointment_detail');
    Route::post('view_appointment_detail', [WebsiteController::class, 'viewAppointmentDetail'])->name('view_appointment_detail');
    Route::post('edit_appointment_modal', [WebsiteController::class, 'editAppointmentModal'])->name('edit_appointment_modal');
    Route::post('delete_appointment_modal', [WebsiteController::class, 'deleteAppointmentModal'])->name('delete_appointment_modal');
    Route::get('email_send_change_order/{change_order_id?}', [WebsiteController::class, 'emailSendChangeOrder'])->name('email_send_change_order');
    Route::get('email_send_invoice/{invoice_id?}', [WebsiteController::class, 'emailSendInvoice'])->name('email_send_invoice');
    Route::get('email_send_receive_payment/{receive_payment_id?}', [WebsiteController::class, 'emailSendReceivePayment'])->name('email_send_receive_payment');
    Route::post('edit_task_modal', [WebsiteController::class, 'editTaskModal'])->name('edit_task_modal');
    Route::post('delete_task', [WebsiteController::class, 'deleteTask'])->name('delete_task');
    Route::post('view_task_detail', [WebsiteController::class, 'viewTaskDetail'])->name('view_task_detail');
    Route::get('task_detail', [WebsiteController::class, 'taskDetail'])->name('task_detail');
    Route::post('edit_jobNote_modal', [WebsiteController::class, 'editJobNoteModal'])->name('edit_jobNote_modal');
    Route::post('delete_jobNote', [WebsiteController::class, 'deleteJobNote'])->name('delete_jobNote');
    Route::post('view_jobNote_detail', [WebsiteController::class, 'viewJobNoteDetail'])->name('view_jobNote_detail');
    Route::post('edit_proposal_modal', [WebsiteController::class, 'editProposalModal'])->name('edit_proposal_modal');
    Route::post('delete_proposal', [WebsiteController::class, 'deleteProposal'])->name('delete_proposal');
    Route::post('view_proposal_detail', [WebsiteController::class, 'viewProposalDetail'])->name('view_proposal_detail');
    Route::post('edit_material_modal', [WebsiteController::class, 'editMaterialModal'])->name('edit_material_modal');
    Route::post('delete_material', [WebsiteController::class, 'deleteMaterial'])->name('delete_material');
    Route::post('view_material_detail', [WebsiteController::class, 'viewMaterialDetail'])->name('view_material_detail');
    Route::post('edit_receive_payment_detail', [WebsiteController::class, 'editReceivePaymentDetail'])->name('edit_receive_payment_detail');
    Route::post('delete_receive_payment', [WebsiteController::class, 'deleteReceivePayment'])->name('delete_receive_payment');
    Route::post('view_receive_payment_detail', [WebsiteController::class, 'viewReceivePaymentDetail'])->name('view_receive_payment_detail');
    Route::post('edit_change_order_modal', [WebsiteController::class, 'editChangeOrderModal'])->name('edit_change_order_modal');
    Route::post('edit_invoice_modal', [WebsiteController::class, 'editInvoiceModal'])->name('edit_invoice_modal');
    Route::post('view_change_order_detail', [WebsiteController::class, 'viewChangeOrderDetail'])->name('view_change_order_detail');
    Route::any('view_invoice_detail', [WebsiteController::class, 'viewInvoiceDetail'])->name('view_invoice_detail');
    Route::post('delete_invoice', [InvoiceController::class, 'deleteInvoice'])->name('delete_invoice');
    Route::post('view_invoice_balance_sheet_detail', [WebsiteController::class, 'viewInvoiceBalanceSheetDetail'])->name('view_invoice_balance_sheet_detail');
    Route::post('view_cogs_detail', [WebsiteController::class, 'viewCOGSDetail'])->name('view_cogs_detail');
    Route::post('view_cogs_modal_detail', [WebsiteController::class, 'viewCOGSModalDetail'])->name('view_cogs_modal_detail');
    Route::post('edit_cogs_modal', [WebsiteController::class, 'editCOGSModalDetail'])->name('edit_cogs_modal');
    Route::post('delete_order_change', [WebsiteController::class, 'deleteOrderChange'])->name('delete_order_change');
    Route::get('change_order_email', [WebsiteController::class, 'changeOrderEmail'])->name('change_order_email');
    Route::post('delete_cogs', [WebsiteController::class, 'deleteCOGS'])->name('delete_cogs');



    Route::get('sub_contractor_show/{id}', [WebsiteController::class, 'subContractorShow']);
    Route::get('sub_contractor_create', [WebsiteController::class, 'subContractorCreate'])->name('sub_contractor_create');

    Route::get('/changeOrder/change-order/create', [WebsiteController::class, 'signature'])->name('signature');
    Route::post('/changeOrder/change-order/create', [WebsiteController::class, 'signatureStore']);

    Route::resource('termAndCondition/term-and-condition', TermAndConditionController::class);
    Route::resource('photoAndDocument/photo-and-document', PhotoAndDocumentController::class);
    Route::resource('photoAndDocumentAttachment/photo-and-document-attachment', PhotoAndDocumentAttachmentController::class);
    Route::resource('task/task', TaskController::class);
    Route::resource('taskAttachments/task-attachments', TaskAttachmentsController::class);
    Route::resource('taskAssignUser/task-assign-user', TaskAssignUserController::class);
    Route::resource('jobNote/job-note', JobNoteController::class);
    Route::resource('jobNoteAttachment/job-note-attachment', JobNoteAttachmentController::class);
    Route::resource('userMailSend/user-mail-send', UserMailSendController::class);
    Route::resource('userMailSendAttachment/user-mail-send-attachment', UserMailSendAttachmentController::class);
    Route::resource('followUpCallNote/follow-up-call-note', FollowUpCallNoteController::class);
    Route::resource('followUpCallNotesUser/follow-up-call-notes-user', FollowUpCallNotesUserController::class);
    Route::resource('estimate/estimate', EstimateController::class);
    Route::resource('estimateAttachment/estimate-attachment', EstimateAttachmentController::class);
    Route::resource('proposal/proposal', ProposalController::class);
    Route::resource('proposalAttachment/proposal-attachment', ProposalAttachmentController::class);
    Route::resource('receivePayment/receive-payment', ReceivePaymentController::class);
    Route::resource('paymentType/payment-type', PaymentTypeController::class);
    Route::resource('mark/mark', MarkController::class);
    Route::resource('workCrew/work-crew', WorkCrewController::class);
    Route::resource('workCrewJobRepresentative/work-crew-job-representative', WorkCrewJobRepresentativeController::class);
    Route::resource('workCrewCompanyCrew/work-crew-company-crew', WorkCrewCompanyCrewController::class);
    Route::resource('workCrewLabour/work-crew-labour', WorkCrewLabourController::class);
    Route::resource('progressBoard/progress-board', ProgressBoardController::class);
    Route::resource('progressBoardCategory/progress-board-category', ProgressBoardCategoryController::class);
    Route::resource('material/material', MaterialController::class);
    Route::get('material_listing/{id}', [MaterialController::class, 'materialListing']);
    Route::resource('materialAttachment/material-attachment', MaterialAttachmentController::class);
    Route::resource('materialDeliveryDate/material-delivery-date', MaterialDeliveryDateController::class);
    Route::resource('team/team', TeamController::class);
    Route::resource('priority/priority', PriorityController::class);
    Route::resource('announcement/announcement', AnnouncementController::class);
    Route::resource('assignAnnouncement/assign-announcement', AssignAnnouncementController::class);
    Route::get('months', [WebsiteController::class, 'months'])->name('months');
    Route::get('monthly_sales_report', [WebsiteController::class, 'monthlySalesReport'])->name('monthly_sales_report')->middleware('auth');
    Route::resource('changeOrder/change-order', ChangeOrderController::class);
    Route::get('/changeOrder/change-order/fetch-address/{lead_id?}', [WebsiteController::class, 'fetchAddress']);
    Route::get('view_lead/get_customer_data/{customer_id}', [WebsiteController::class, 'getCustomerData'])->name('get_customer_data');
    Route::get('/invoice/invoice/fetch-data/{lead_id?}', [WebsiteController::class, 'fetchData']);
    Route::resource('changeOrderAttachment/change-order-attachment', ChangeOrderAttachmentController::class);
    Route::resource('invoice/invoice', InvoiceController::class);
    Route::resource('invoiceAttachment/invoice-attachment', InvoiceAttachmentController::class);
    Route::get('view_change_order_pdf', [WebsiteController::class, 'viewChangeOrderPdf']);
    Route::get('/fetch-emails', [WebsiteController::class, 'fetchEmails'])->name('fetch_emails');
    Route::resource('usersMailboxConfiguration/users-mailbox-configuration', UsersMailboxConfigurationController::class);
    Route::get('fetch_user_un_seen_emails_cron_job', [EmailCronJobController::class, 'fetchUserUnSeenEmailsCronJob'])->name('fetch_user_un_seen_emails_cron_job');
    Route::get('fetch_user_seen_emails_cron_job', [EmailCronJobController::class, 'fetchUserSeenEmailsCronJob'])->name('fetch_user_seen_emails_cron_job');
    Route::post('configuration/mail_configuration_store', [WebsiteController::class, 'mailConfigurationStore'])->name('mail_configuration_store');
    Route::get('mail_configuration', [WebsiteController::class, 'mailConfiguration'])->name('mail_configuration')->middleware('auth');
    Route::post('delete_trash_emails', [WebsiteController::class, 'deleteTrashEmails'])->name('delete_trash_emails');
    Route::post('store_campaign', [WebsiteController::class, 'storeCampaign'])->name('store_campaign');
    Route::post('update_campaign', [WebsiteController::class, 'updateCampaign'])->name('update_campaign');
    Route::put('update_campaign_play_or_resume/{id?}', [WebsiteController::class, 'updateCampaignPlayOrResume'])->name('update_campaign_play_or_resume');
    Route::get('delete_campaign/{id?}', [WebsiteController::class, 'deleteCampaign'])->name('delete_campaign');
    Route::get('delete_campaignDetail/{id?}', [WebsiteController::class, 'deleteCampaignDetail'])->name('delete_campaignDetail');
    Route::get('campaign_cron', [WebsiteController::class, 'campaignCron'])->name('campaign_cron');
    Route::resource('usersMailboxesSent/users-mailboxes-sent', UsersMailboxesSentController::class);
    Route::resource('campaign/campaign', CampaignController::class)->middleware('auth');
    Route::resource('campaignDetail/campaign-detail', CampaignDetailController::class);
    Route::resource('reportPermission/report-permission', ReportPermissionController::class);
    Route::get('email_view/{id?}', [WebsiteController::class, 'emailView'])->name('email_view');
    Route::post('delete_inbox_emails/{id?}', [WebsiteController::class, 'deleteInboxEmails'])->name('delete_inbox_emails');
    Route::post('delete_emails', [WebsiteController::class, 'deleteEmails'])->name('delete_emails');
    Route::get('truncate_logs_activity', [WebsiteController::class, 'truncateActivityLogCroneJob'])->name('truncate_logs_activity'); //Daily after 24 hours.
    Route::get('notification', [WebsiteController::class, 'notification'])->name('notification');
    //Route::post('notification/store', [WebsiteController::class, 'storeNotification'])->name('store_notification');
    Route::get('notification/delete/{id?}', [WebsiteController::class, 'deleteNotification'])->name('delete_notification');
    Route::post('notification/delete/multiple', [WebsiteController::class, 'notificationDeleteMultiple'])->name('notification_delete_multiple');
    Route::get('stage/multiple/delete', [WebsiteController::class, 'stageMultipleDelete'])->name('stage_multiple_delete');
    Route::post('staff/multiple/delete', [WebsiteController::class, 'staffMultipleDelete'])->name('staff_multiple_delete');
    Route::post('customer_multiple_delete', [WebsiteController::class, 'customerMultipleDelete'])->name('customer_multiple_delete');
    Route::post('lead_multiple_delete', [WebsiteController::class, 'leadMultipleDelete'])->name('lead_multiple_delete');
    Route::post('/check_role', [WebsiteController::class, 'checkRole'])->name('check_role');
    Route::get('/send_email_to_users', [WebsiteController::class, 'sendEmailToUsers'])->name('send_email_to_users');
    Route::post('/add_email_to_lead', [WebsiteController::class, 'addEmailToLead'])->name('add_email_to_lead');
    Route::get('autocomplete_search_data', [WebsiteController::class, 'autocompleteSearchData'])->name('autocomplete_search_data');
    //Route::resource('notification/notification', Notification\NotificationController::class);
    Route::resource('leadStage/lead-stage', LeadStageController::class);
    Route::get('/task_assign_to_lead', [WebsiteController::class, 'taskAssignToLead'])->name('task_assign_to_lead');
    Route::get('/job_note_assign_to_lead', [WebsiteController::class, 'jobNoteAssignToLead'])->name('job_note_assign_to_lead');
    Route::get('update_stage_date/{id?}', [WebsiteController::class, 'updateStageDate'])->name('update_stage_date');
    Route::post('update_stage_date/{id?}', [WebsiteController::class, 'updateStageDateModal'])->name('update_stage_date_modal');
    Route::get('update_lead_status_date/{id?}', [WebsiteController::class, 'updateLeadStatusDate'])->name('update_lead_status_date');
    Route::resource('leadStage/lead-stage', LeadStageController::class);
    Route::get('/estimate_proposal_assign_to_lead', [WebsiteController::class, 'estimateProposalAssignToLead'])->name('estimate_proposal_assign_to_lead');
    Route::post('/material_assign_to_lead', [WebsiteController::class, 'materialAssignToLead'])->name('material_assign_to_lead');
    Route::get('/annoucement_assign_to_users', [WebsiteController::class, 'annoucementAssignToUsers'])->name('annoucement_assign_to_users');

    Route::post('/message_assign_to_lead', [WebsiteController::class, 'messageAssignToLead'])->name('message_assign_to_lead');

    //twilio related routes
    Route::post('/incoming_messages', [WebsiteController::class, 'incomingMessages']);
    Route::post('/incoming_messages_error', [WebsiteController::class, 'incomingMessagesError']);
    //end twilio related routes
    Route::post('view_lead_message', [WebsiteController::class, 'viewLeadMessage'])->name('view_lead_message');

    Route::post('edit_lead_message', [WebsiteController::class, 'editLeadMessage'])->name('edit_lead_message');
    Route::post('delete_lead_message', [WebsiteController::class, 'deleteLeadMessage'])->name('delete_lead_message');
    Route::post('view_lead_mail', [WebsiteController::class, 'viewLeadMail'])->name('view_lead_mail');
    Route::post('edit_lead_mail', [WebsiteController::class, 'editLeadMail'])->name('edit_lead_mail');
    Route::post('delete_lead_mail', [WebsiteController::class, 'deleteLeadMail'])->name('delete_lead_mail');
    Route::resource('message/message', MessageController::class);
    Route::resource('leadMail/lead-mail', LeadMailController::class);
    Route::post('/annoucement_assign_to_staff', [WebsiteController::class, 'annoucementAssignToStaff'])->name('annoucement_assign_to_staff');
    Route::resource('message/message', MessageController::class);
    Route::get('update_status_lead/{id?}/{status?}', [WebsiteController::class, 'updateStatusLead'])->name('update_status_lead');
    Route::post('update_status_lead_date/{id?}', [WebsiteController::class, 'updateStatusLeadDate'])->name('update_status_lead_date');
    Route::get('yearly_report/{id?}', [WebsiteController::class, 'yearlyReport'])->name('yearly_report')->middleware('auth');
    Route::get('category_status/{id?}/{status?}', [WebsiteController::class, 'categoryStatus'])->name('category_status');
    Route::get('material_status/{id?}/{status?}', [WebsiteController::class, 'materialStatus'])->name('material_status');
    Route::get('change_lead_date', [WebsiteController::class, 'changeLeadDate'])->name('change_lead_date');
    Route::get('get_email_template/{id?}', [WebsiteController::class, 'getEmailTemplate'])->name('get_email_template');
    Route::get('select_email_template', [WebsiteController::class, 'selectEmailTemplate'])->name('select_email_template');
    Route::get('get_proposal_template/{id?}', [WebsiteController::class, 'getProposalTemplate'])->name('get_proposal_template');
    Route::get('delete_lead_document/{photo_id?}', [WebsiteController::class, 'deleteLeadDocument'])->name('delete_lead_document');
    Route::get('photo_and_doc_document_primary_image/{photo_id?}/{lead_id?}', [WebsiteController::class, 'photoAndDocDocumentPrimaryImage'])->name('photo_and_doc_document_primary_image');
    Route::get('get_customer_detail/{customer_id?}', [WebsiteController::class, 'getCustomerDetail'])->name('get_customer_detail');
    Route::post('edit_status_year_esstimation', [WebsiteController::class, 'editStatusYearEsstimation'])->name('edit_status_year_esstimation');
    Route::resource('emailTemplate/email-template', EmailTemplateController::class);
    Route::get('email_template_listing/{id}', [EmailTemplateController::class, 'emailTemplateListing'])->name('email_template_listing');
    Route::resource('emailTemplateAttachment/email-template-attachment', EmailTemplateAttachmentController::class);
    Route::post('delete_email_template', [WebsiteController::class, 'deleteEmailTemplate'])->name('delete_email_template');
    Route::get('edit_lead_job/{id?}', [WebsiteController::class, 'editLeadJob'])->name('edit_lead_job');
    Route::get('edit_client_details/{id?}', [WebsiteController::class, 'editClientDetails'])->name('edit_client_details');

    Route::get('map_view_lead', [LeadController::class, 'mapViewLead'])->name('map_view_lead');
    Route::get('calender_task_view', [LeadController::class, 'calenderTaskView'])->name('calender_task_view');
    Route::get('job_insurance_for_lead/{id?}', [LeadController::class, 'jobInsuranceForLead'])->name('job_insurance_for_lead');
    Route::post('update_job_insurance_for_lead/{id?}', [LeadController::class, 'updateJobInsuranceForLead'])->name('update_job_insurance_for_lead');
    Route::get('photos_for_custom_proposal/{id}', [WebsiteController::class, 'photosForCustomProposal'])->name('photos_for_custom_proposal');
    Route::get('calendar_appointment_view', [AppointmentController::class, 'calendarAppointmentView'])->name('calendar_appointment_view');
    Route::get('lead_card_view', [LeadController::class, 'leadCardView'])->name('lead_card_view');
    Route::get('leads/export', [LeadController::class, 'exportLeads'])->name('leads.export');
    Route::resource('proposalTemplate/proposal-template', ProposalTemplateController::class);
    Route::resource('proposalTemplateAttachment/proposal-template-attachment', ProposalTemplateAttachmentController::class);
    Route::resource('costOfGoodSold/cost-of-good-sold', CostOfGoodSoldController::class);
    Route::resource('cogsMaterial/cogs-material', CogsMaterialController::class);
    Route::get('status_change_cogs_material/{id?}/{status?}', [CogsMaterialController::class, 'statusChangeCogsMaterial'])->name('status_change_cogs_material');
    Route::get('get_company_cam_project_list', [WebsiteController::class, 'getCompanyCamProjectList'])->name('get_company_cam_project_list');
    Route::get('store_company_cam_project', [WebsiteController::class, 'storeCompanyCamProject'])->name('store_company_cam_project');
    Route::get('user_view', [CustomerController::class, 'userView'])->name('user_view');
    Route::get('customers/export', [CustomerController::class, 'export'])->name('customers.export');
    Route::resource('companyContact/company-contact', CompanyContactController::class);
    Route::resource('customerCommunication/customer-communication', CustomerCommunicationController::class);
    Route::get('get_company_detail', [LeadController::class, 'getCompanyDetail']);
    Route::get('appointment_report_table', [AppointmentController::class, 'reportTable'])->name('report_table');
    Route::get('appointment_report_table_first', [AppointmentController::class, 'reportTableFirst'])->name('report_table_first');
    Route::get('sales_weekly', [AppointmentController::class, 'salesWeekly'])->name('sales_weekly');
    Route::get('appointment_per_day', [AppointmentController::class, 'getCalendarCsv']);
    Route::get('store_photo_and_doc', [WebsiteController::class, 'storePhotoAndDoc'])->name('store_photo_and_doc');
    Route::get('cost_of_lead', [WebsiteController::class, 'costOfLead'])->name('cost_of_lead')->middleware('auth');
    Route::get('create_new_year_estimate/{id}', [WebsiteController::class, 'createNewYearEstimate'])->name('create_new_year_estimate');
    Route::get('view_estimation/{id}', [WebsiteController::class, 'viewEstimation'])->name('view_estimation')->middleware('auth');
    Route::get('yearly_advertising_report', [WebsiteController::class, 'yearlyAdvertisingReport'])->name('yearly_advertising_report');
    Route::get('status_change_lead_card_view/{id?}/{archive_status?}', [LeadController::class, 'statusChangeLeadCardView'])->name('status_change_lead_card_view');
    Route::resource('advertisement/advertisement', AdvertisementController::class);
    Route::resource('monthlyAdvertisement/monthly-advertisement', MonthlyAdvertisementController::class);
    Route::get('get_lead_list_company_camp_project', [LeadController::class, 'getLeadListCompanyCampProject'])->name('get_lead_list_company_camp_project');
    Route::post('delete_monthly_advertisement', [AdvertisementController::class, 'deleteReferralSource'])->name('delete_monthly_advertisement');
    Route::get('get_document_company_camp', [LeadController::class, 'getDocumentCompanyCamp'])->name('get_document_company_camp');

    Route::resource('schedulingTask/scheduling-task', SchedulingTaskController::class);
    Route::resource('schedulingTaskUser/scheduling-task-user', SchedulingTaskUserController::class);
    Route::get('get_task_scheduling_id', [WebsiteController::class, 'getSchedulingTask'])->name('get_task_scheduling_id');
    Route::get('roof_estimation_calculator/{lead_id?}', [WebsiteController::class, 'roofEstimationCalculator'])->name('roof_estimation_calculator')->middleware('auth');
    Route::get('lead_detail/{lead_id?}', [WebsiteController::class, 'leadDetail'])->name('lead_detail');
    Route::get('get_leads_detail', [WebsiteController::class, 'getLeadsDetail'])->name('get_leads_detail');
    Route::get('roof_estimation_calculator_screen/{lead_id?}/{roof_estimation_calculator_id?}/{slug?}', [WebsiteController::class, 'roofEstimationCalculatorScreen'])->name('roof_estimation_calculator_screen');
    Route::get('siding_estimation_calculator/{lead_id?}', [WebsiteController::class, 'sidingEstimationCalculator'])->name('siding_estimation_calculator')->middleware('auth');
    Route::get('chimney_estimation_calculator/{lead_id?}', [WebsiteController::class, 'chimneyEstimationCalculator'])->name('chimney_estimation_calculator')->middleware('auth');
    Route::get('chimney_estimation_calculator_screen/{lead_id?}/{chimney_estimation_calculator_id?}/{slug?}', [WebsiteController::class, 'chimneyEstimationCalculatorScreen'])->name('chimney_estimation_calculator_screen');
    //Route::get('siding_estimation_calculator_replacement/{lead_id?}',[WebsiteController::class, 'sidingEstimationCalculatorReplacement'])->name('siding_estimation_calculator_replacement');
    //Route::get('siding_estimation_calculator_over_existing/{lead_id?}',[WebsiteController::class, 'sidingEstimationCalculatorOverExisting'])->name('siding_estimation_calculator_over_existing');
    //Route::get('siding_estimation_calculator_gutter/{lead_id?}',[WebsiteController::class, 'sidingEstimationCalculatorGutter'])->name('siding_estimation_calculator_gutter');
    Route::get('siding_estimation_calculator_screen/{lead_id?}/{siding_estimation_calculator_id?}/{slug?}', [WebsiteController::class, 'sidingEstimationCalculatorScreen'])->name('siding_estimation_calculator_screen');
    Route::post('store_siding_estimation_calculator', [LeadController::class, 'storeSidingEstimationCalculator'])->name('store_siding_estimation_calculator');
    Route::post('store_chimney_estimation_calculator', [LeadController::class, 'storeChimneyEstimationCalculator'])->name('store_chimney_estimation_calculator');
    Route::post('store_siding_replacement', [SidingEstimateCalculatorController::class, 'storeSidingReplacement'])->name('store_siding_replacement');
    Route::post('store_siding_over_existing', [SidingEstimateCalculatorController::class, 'storeSidingOverExisting'])->name('store_siding_over_existing');
    Route::post('store_product_pricing_estimation_calculator', [LeadController::class, 'storeProducPricingEstimateCalculator'])->name('store_product_pricing_estimation_calculator');
    Route::post('product_pdf_material_list', [LeadController::class, 'productPdfMaterialList'])->name('product_pdf_material_list');

    Route::post('update_task_scheduling', [WebsiteController::class, 'updateSchedulingTask'])->name('update_task_scheduling');
    Route::post('delete_task_scheduling', [SchedulingTaskController::class, 'deleteSchedulingTask'])->name('delete_task_scheduling');
    Route::post('update_date_scheduling_task', [SchedulingTaskController::class, 'updateDateSchedulingTask'])->name('update_date_scheduling_task');
    Route::post('update_date_appointments', [AppointmentController::class, 'updateDateAppointment'])->name('update_date_appointments');
    Route::post('store_roof_estimation_calculator', [LeadController::class, 'storeRoofEstimationCalculator'])->name('store_roof_estimation_calculator');
    Route::post('store_roof_estimate_calculator_prefer', [LeadController::class, 'storeRoofEstimateCalculatorPrefer'])->name('store_roof_estimate_calculator_prefer');
    Route::post('store_roof_estimate_calculator_system', [LeadController::class, 'storeRoofEstimateCalculatorSystem'])->name('store_roof_estimate_calculator_system');
    Route::post('store_roof_estimate_calculator_under_fifteen_sq', [LeadController::class, 'storeRoofEstimateCalculatorUnderfifteenSQ'])->name('store_roof_estimate_calculator_under_fifteen_sq');
    Route::post('store_roof_estimate_calculator_flat_roof', [LeadController::class, 'storeRoofEstimateCalculatorFlatRoof'])->name('store_roof_estimate_calculator_flat_roof');
    Route::post('store_roof_estimate_calculator_gutters', [LeadController::class, 'storeRoofEstimateCalculatorGutter'])->name('store_roof_estimate_calculator_gutters');
    Route::post('store_side_estimate_calculator_gutters', [LeadController::class, 'storeSideEstimateCalculatorGutter'])->name('store_side_estimate_calculator_gutters');
    Route::post('store_chimney_estimate_calculator_chimney', [LeadController::class, 'storeChimneyEstimateCalculatorChimney'])->name('store_chimney_estimate_calculator_chimney');
    Route::post('store_chimney_estimate_calculator_liner', [LeadController::class, 'storeChimneyEstimateCalculatorLiner'])->name('store_chimney_estimate_calculator_liner');
    Route::post('store_product_pricing_calculator_material_list', [LeadController::class, 'storeProductPricingCalculatorMaterialList'])->name('store_product_pricing_calculator_material_list');
    Route::post('store_product_pricing_calculator_price_list', [LeadController::class, 'storeProductPricingCalculatorPriceList'])->name('store_product_pricing_calculator_price_list');
    Route::post('store_product_pricing_calculator_pdf_measurement', [LeadController::class, 'storeProductPricingCalculatorPdfMeasurement'])->name('store_product_pricing_calculator_pdf_measurement');
    Route::post('store_progress_board', [LeadController::class, 'storeProgressBoard'])->name('store_progress_board');
    Route::post('store_progress_task', [LeadController::class, 'storeProgressBoardTask'])->name('store_progress_task');
    Route::get('edit_progress_task_modal', [ProgressBoardController::class, 'editProgressTaskModal'])->name('edit_progress_task_modal');
    Route::post('update_progress_task', [ProgressBoardController::class, 'updateProgressTask'])->name('update_progress_task');
    Route::post('update_progress_board_color', [LeadController::class, 'updateProgressBoardColor'])->name('update_progress_board_color');
    Route::resource('roofEstimateCalculator/roof-estimate-calculator', RoofEstimateCalculatorController::class);
    Route::resource('roofEstimateCalculatorLabel/roof-estimate-calculator-label', RoofEstimateCalculatorLabelController::class);
    // Route::resource('roofEstimateCalculatorEaveRake/roof-estimate-calculator-eave-rake', RoofEstimateCalculatorEaveRake\RoofEstimateCalculatorEaveRakeController::class);
    // Route::resource('roofEstimateCalculatorFlatArea/roof-estimate-calculator-flat-area', RoofEstimateCalculatorFlatArea\RoofEstimateCalculatorFlatAreaController::class);
    // Route::resource('roofEstimateCalculatorDownspout/roof-estimate-calculator-downspout', RoofEstimateCalculatorDownspout\RoofEstimateCalculatorDownspoutController::class);
    // Route::resource('roofestimatecalculatorpreferd/roofestimatecalculatorpreferd', Roofestimatecalculatorpreferd\RoofestimatecalculatorpreferdController::class);
    // Route::resource('roofEstimateCalculatorSystem/roof-estimate-calculator-system', RoofEstimateCalculatorSystem\RoofEstimateCalculatorSystemController::class);
    // Route::resource('storeRoofEstimateCalculatorUnderfifteenSQ/store-roof-estimate-calculator-underfifteen-s-q', StoreRoofEstimateCalculatorUnderfifteenSQ\StoreRoofEstimateCalculatorUnderfifteenSQController::class);
    // Route::resource('roofEstimateCalculatorFlatRoof/roof-estimate-calculator-flat-roof', RoofEstimateCalculatorFlatRoof\RoofEstimateCalculatorFlatRoofController::class);
    // Route::resource('storeRoofEstimateCalculatorGutter/store-roof-estimate-calculator-gutter', StoreRoofEstimateCalculatorGutter\StoreRoofEstimateCalculatorGutterController::class);
    Route::resource('holiday/holiday', HolidayController::class);
    Route::resource('holidayDate/holiday-date', HolidayDateController::class);
    Route::get('/getCampaignEmailTemplate/{id}', [WebsiteController::class, 'getCampaignEmailTemplate'])->name('get_campaign_email_template');
    Route::get('update_status_change_order/{id?}/{status?}', [WebsiteController::class, 'updateStatusChangeOrder'])->name('update_status_change_order');
    Route::get('progress_board', [WebsiteController::class, 'progressBoard'])->name('progress_board')->middleware('auth');

    Route::resource('sidingEstimateCalculator/siding-estimate-calculator', SidingEstimateCalculatorController::class);
    Route::resource('sidingEstimateCalculatorLabel/siding-estimate-calculator-label', SidingEstimateCalculatorLabelController::class);
    //Route::resource('sidingEstimateCalculatorFlatArea/siding-estimate-calculator-flat-area', SidingEstimateCalculatorFlatArea\SidingEstimateCalculatorFlatAreaController::class);
    //Route::resource('sidingEstimateCalculatorDownspout/siding-estimate-calculator-downspout', SidingEstimateCalculatorDownspout\SidingEstimateCalculatorDownspoutController::class);
    //Route::resource('storeSideEstimateCalculatorGutter/store-side-estimate-calculator-gutter', StoreSideEstimateCalculatorGutter\StoreSideEstimateCalculatorGutterController::class);
    Route::get('product_pricing_calculator/{lead_id?}', [WebsiteController::class, 'productPricingEstimationCalculator'])->name('product_pricing_calculator')->middleware('auth');
    Route::get('product_pricing_calculator_screen/{lead_id?}/{product_pricing_calculator_id?}/{slug?}', [WebsiteController::class, 'productPricingEstimationCalculatorScreen'])->name('product_pricing_calculator_screen');

    Route::get('side_base', [SidingEstimateCalculatorController::class, 'sideBase'])->name('side_base');
    Route::get('roof_base', [RoofEstimateCalculatorController::class, 'roofBase'])->name('roof_base');
    Route::get('chimney_base', [ChimneyEstimateCalculatorController::class, 'chimneyBase'])->name('chimney_base');
    Route::resource('chimneyEstimateCalculator/chimney-estimate-calculator', ChimneyEstimateCalculatorController::class);
    //Route::resource('chimneyEstimateCalculatorLabel/chimney-estimate-calculator-label', ChimneyEstimateCalculatorLabel\ChimneyEstimateCalculatorLabelController::class);
    //Route::resource('chimneyEstimateBricksRow/chimney-estimate-bricks-row', ChimneyEstimateBricksRow\ChimneyEstimateBricksRowController::class);
    //Route::resource('storeChimneyEstimateCalculatorChimney/store-chimney-estimate-calculator-chimney', StoreChimneyEstimateCalculatorChimney\StoreChimneyEstimateCalculatorChimneyController::class);
    //Route::resource('storeChimneyEstimateCalculatorLiner/store-chimney-estimate-calculator-liner', StoreChimneyEstimateCalculatorLiner\StoreChimneyEstimateCalculatorLinerController::class);

    Route::resource('productPricingEstimateCalculator/product-pricing-estimate-calculator', ProductPricingEstimateCalculatorController::class, [
        'parameters' => [
            'product-pricing-estimate-calculator' => 'ppe_calculator'
        ]
    ]);

    //Route::resource('productPricingEstimateCalculatorLabels/product-pricing-estimate-calculator-labels', ProductPricingEstimateCalculatorLabels\ProductPricingEstimateCalculatorLabelsController::class);
    //Route::resource('productPricingEstimateCalculatorEaveRakes/product-pricing-estimate-calculator-eave-rakes', ProductPricingEstimateCalculatorEaveRakes\ProductPricingEstimateCalculatorEaveRakesController::class);
    //Route::resource('productPricingEstimateCalculatorFlatArea/product-pricing-estimate-calculator-flat-area', ProductPricingEstimateCalculatorFlatArea\ProductPricingEstimateCalculatorFlatAreaController::class);
    //Route::resource('productPricingEstimateCalculatorDownspouts/product-pricing-estimate-calculator-downspouts', ProductPricingEstimateCalculatorDownspouts\ProductPricingEstimateCalculatorDownspoutsController::class);
    //Route::resource('storeProductPricingMaterialList/store-product-pricing-material-list', StoreProductPricingMaterialList\StoreProductPricingMaterialListController::class);
    Route::resource('storeProductPricingPriceList/store-product-pricing-price-list', StoreProductPricingPriceListController::class);

    Route::resource('productPricingPriceList/product-pricing-price-list', ProductPricingPriceListController::class);
    Route::resource('productPricePdfMeasurement/product-price-pdf-measurement', ProductPricePdfMeasurementController::class);
    Route::resource('productPricePdfTotal/product-price-pdf-total', ProductPricePdfTotalController::class);
    Route::resource('productPricePdfAreaPitch/product-price-pdf-area-pitch', ProductPricePdfAreaPitchController::class);
    Route::post('update_lead_progress_status/{lead_id?}', [WebsiteController::class, 'UpdateLeadProgressStatus'])->name('update_lead_progress_status');

    Route::resource('emailTemplateVariable/email-template-variable', EmailTemplateVariableController::class);
    Route::resource('storeSideEstimateReplacement/store-side-estimate-replacement', StoreSideEstimateReplacementController::class);
    Route::resource('storeSideEstimateOverExist/store-side-estimate-over-exist', StoreSideEstimateOverExistController::class);
    Route::resource('calculatorSize/calculator-size', CalculatorSizeController::class);
    Route::resource('emailVariableType/email-variable-type', EmailVariableTypeController::class);
    Route::resource('productPriceSkylight/product-price-skylight', ProductPriceSkylightController::class);
    Route::resource('product/product', ProductController::class);
    Route::resource('productCategory/product-category', ProductCategoryController::class);

    Route::resource('productMaterialSection/product-material-section', ProductMaterialSectionController::class);
    Route::get('get_photo_company_camp', [WebsiteController::class, 'getPhotoCompanyCamp'])->name('get_photo_company_camp');

    Route::post('folder/create', [FolderManagementController::class, 'createFolder'])->name('folder_create');
    Route::post('file/upload', [FolderManagementController::class, 'uploadFolder'])->name('file_upload');
    Route::get('folder/contents/{lead_id}', [FolderManagementController::class, 'contents'])->name('folder_contents');
    Route::post('delete_file', [WebsiteController::class, 'deleteFile'])->name('delete_file');
    Route::post('delete_folder', [WebsiteController::class, 'deleteFolder'])->name('delete_folder');
    Route::post('delete_permit', [FolderManagementController::class, 'deletePermit'])->name('delete_permit');
    Route::post('store_proposal', [FolderManagementController::class, 'storeProposal'])->name('store_proposal');
    Route::post('store_warranties', [FolderManagementController::class, 'storeWarranty'])->name('store_warranties');
    Route::post('delete_warranty', [FolderManagementController::class, 'deleteWarranty'])->name('delete_warranty');
    Route::post('delete_proposal', [FolderManagementController::class, 'deleteProposal'])->name('delete_proposal');
    Route::resource('folderManagement/folder-management', FolderManagementController::class);
    Route::resource('folderManagementAttachment/folder-management-attachment', FolderManagementAttachmentController::class);
    Route::get('lead_custom_proposal/{lead_id}', [ProposalController::class, 'leadCustomProposal'])->name('lead_custom_proposal');
    Route::get('sub_contractor_proposal_send/{id}', [SubContractorProposalController::class, 'subContractorProposalEdit'])->name('sub_contractor_proposal_send');
    Route::post('store_lead_proposal', [WebsiteController::class, 'storeLeadCustomProposalScreen'])->name('store_lead_proposal');
    Route::post('store_leads_custom_proposal', [ProposalController::class, 'storeLeadsCustomProposal'])->name('store_leads_custom_proposal');
    Route::delete('customize_proposals_delete/{id?}', [ProposalController::class, 'customizeProposalsDelete'])->name('customize_proposals_delete');
    Route::get('customer_proposal_view/{id}', [WebsiteController::class, 'customerViewProposal'])->name('customer_proposal_view')->middleware('auth');
    Route::post('update_proposal_order/{id}', [ProposalController::class, 'updateProposalOrder'])->name('update_proposal_order');
    Route::get('subcontractor_proposal_view/{id}/{lead_id}', [WebsiteController::class, 'subContractorViewProposal'])->name('customer_proposal_view')->middleware('auth');
    Route::post('store_customer_proposal_signature', [WebsiteController::class, 'storeCustomerProposalSignature'])->name('store_customer_proposal_signature')->middleware('auth');
    Route::post('store_contractor_proposal_signature', [WebsiteController::class, 'storesubContractorProposalSignature'])->name('store_contractor_proposal_signature');
    Route::get('holiday_status_change/{id?}/{status?}', [WebsiteController::class, 'changeHolidayStatus'])->name('change_holiday_status');
    Route::get('change_mark_status/{id?}/{status?}', [WebsiteController::class, 'changeMarkStatus'])->name('change_mark_status');
    Route::get('change_calculator_status/{id?}/{status?}', [WebsiteController::class, 'changeCalculatorStatus'])->name('change_calculator_status');
    Route::get('change_company_contact_status/{id?}/{insurance_status?}', [WebsiteController::class, 'changeCompanyContactStatus'])->name('change_company_contact_status');
    Route::get('change_staff_status/{id?}/{insurance_status?}', [WebsiteController::class, 'changeStaffStatus'])->name('change_staff_status');
    Route::resource('financeSheet/finance-sheet', FinanceSheetController::class);
    Route::resource('financeGrossIncome/finance-gross-income', FinanceGrossIncomeController::class);
    Route::resource('financeCogs/finance-cogs', FinanceCogsController::class);
    Route::resource('financeGrossExpense/finance-gross-expense', FinanceGrossExpenseController::class);
    Route::resource('financeOhExpense/finance-oh-expense', FinanceOhExpenseController::class);
    Route::post('store_finance_oh', [WebsiteController::class, 'storeFinanceOh'])->name('store_finance_oh');
    Route::get('change_invoice_status/{id}/{status}', [WebsiteController::class, 'changeInvoiceStatus'])->name('change_invoice_status');
    Route::resource('campaignAttachment/campaign-attachment', CampaignAttachmentController::class);
    Route::resource('calculatorBaseValue/calculator-base-value', CalculatorBaseValueController::class);
    Route::post('store_siding', [CalculatorBaseValueController::class, 'storeSideBaseValue'])->name('store_siding');
    Route::post('store_roofing', [CalculatorBaseValueController::class, 'storeRoofBaseValue'])->name('store_roofing');
    //Route::post('store_roofing_preferred', [CalculatorBaseValue\CalculatorBaseValueController::class, 'storeRoofPreferredBaseValue'])->name('store_roofing_preferred');
    Route::post('store_roof_base_prefer', [CalculatorBaseValueController::class, 'storeRoofBasePrefer'])->name('store_roof_base_prefer');
    Route::post('store_roof_base_system', [CalculatorBaseValueController::class, 'storeRoofBaseSystem'])->name('store_roof_base_system');
    Route::post('store_roof_base_under_sq', [CalculatorBaseValueController::class, 'storeRoofBaseUnderSq'])->name('store_roof_base_under_sq');
    Route::post('store_roof_base_gutter', [CalculatorBaseValueController::class, 'storeRoofBaseGutter'])->name('store_roof_base_gutter');
    Route::post('store_roof_base_flat_roof', [CalculatorBaseValueController::class, 'storeRoofBaseFlatRoof'])->name('store_roof_base_flat_roof');
    Route::post('store_side_base_replacement', [CalculatorBaseValueController::class, 'storeSideBaseReplacement'])->name('store_side_base_replacement');
    Route::post('store_side_base_over_existing', [CalculatorBaseValueController::class, 'storeSideBaseOverExisting'])->name('store_side_base_over_existing');
    Route::post('store_side_base_gutter', [CalculatorBaseValueController::class, 'storeSideBaseGutter'])->name('store_side_base_gutter');
    Route::post('store_roof_margin_profit', [CalculatorBaseValueController::class, 'storeRoofMarginProfit'])->name('store_roof_margin_profit');
    Route::post('store_siding_margin_profit', [CalculatorBaseValueController::class, 'storeSideMarginProfit'])->name('store_siding_margin_profit');
    Route::post('store_chimney_base_chimney', [CalculatorBaseValueController::class, 'storeChimneyBaseChimney'])->name('store_chimney_base_chimney');
    Route::post('store_chimney_margin_profit', [CalculatorBaseValueController::class, 'storeChimneyMarginProfit'])->name('store_chimney_margin_profit');
    Route::get('get_roof_base_value', [RoofEstimateCalculatorController::class, 'getRoofBaseValue'])->name('get_roof_base_value');
    Route::get('get_siding_base_value', [SidingEstimateCalculatorController::class, 'getSidingBaseValue'])->name('get_siding_base_value');
    Route::get('get_chimney_base_value', [ChimneyEstimateCalculatorController::class, 'getChimneyBaseValue'])->name('get_chimney_base_value');
    Route::resource('userCheckIn/user-check-in', UserCheckInController::class);
    Route::post('start_session', [UserCheckInController::class, 'storeCheckIn'])->name('store_check_in');
    Route::post('stop_session', [UserCheckInController::class, 'storeCheckOut'])->name('store_check_out');
    Route::get('get_active_session', [UserCheckInController::class, 'getActiveSession'])->name('get_active_session');
    Route::post('pause_session', [UserCheckInController::class, 'pauseSession'])->name('pause_session');
    Route::get('staff_time_clock/{id?}', [StaffController::class, 'staffTimeClock'])->name('staff_time_clock');
    Route::get('edit_checkin_modal', [StaffController::class, 'editCheckInModal'])->name('edit_checkin_modal');
    Route::post('update_checkin', [StaffController::class, 'updateCheckin'])->name('update_checkin');

    Route::get('staff_salary_block', [StaffController::class, 'staffSalaryBlock'])->name('staff_salary_block')->middleware('auth');
    Route::get('staff_benefits_block', [StaffController::class, 'staffBenefitsBlock'])->name('staff_benefits_block')->middleware('auth');
    Route::get('staff_positions_block', [StaffController::class, 'staffPositionsBlock'])->name('staff_positions_block')->middleware('auth');
    Route::get('admin-listing', [WebsiteController::class, 'adminCheckInListing'])->name('admin_check_in_listing')->middleware('auth');

    Route::resource('positionBlock/position-block', PositionBlockController::class);
    Route::post('update-positions', [PositionBlockController::class, 'updatePositions'])->name('positions.update');
    Route::post('update-salary-block', [PositionBlockController::class, 'updateSalaryBlock'])->name('salaryBlock.update');
    Route::get('get_position_record', [PositionBlockController::class, 'getPositionRecord']);
    Route::get('get_compensation_record', [PositionBlockController::class, 'getcompensationRecord']);
    Route::resource('staffFinance/staff-finance', StaffFinanceController::class);
    Route::resource('call/call', CallController::class);
    Route::get('edit_call_modal', [CallController::class, 'editCallModal'])->name('edit_call_modal');
    Route::post('update_call_modal', [CallController::class, 'updateCallModal'])->name('update_call');
    Route::post('delete_call', [CallController::class, 'deleteCall'])->name('delete_call');
    Route::post('upload_large_files', [CallController::class, 'uploadLargeFiles'])->name('upload_large_files');
    Route::get('get_calculator_price', [WebsiteController::class, 'getCalculatorPrice'])->name('get_calculator_price');
    Route::get('calendar_types', [WebsiteController::class, 'getCalendarTypes'])->name('calendar_types');
    Route::post('store_calendar_types', [WebsiteController::class, 'storeCalendarTypes'])->name('store_calendar_types');
    Route::get('verify_stage_finance', [WebsiteController::class, 'validateFinanceStageBeforeAdd'])->name('verify_stage_finance');
    Route::resource('emailTemplateFolder/email-template-folder', EmailTemplateFolderController::class);
    Route::resource('customerOwnerType/customer-owner-type', CustomerOwnerTypeController::class);
    Route::resource('credit/credit', CreditController::class);
    Route::post('edit_credit_modal', [CreditController::class, 'editCreditModal'])->name('edit_credit_modal');
    Route::get('view_credit_modal', [CreditController::class, 'showCreditModal'])->name('view_credit_modal');
    Route::post('delete_credit', [CreditController::class, 'deleteCredit'])->name('delete_credit');
    Route::resource('refund/refund', RefundController::class);
    Route::post('edit_refund_modal', [RefundController::class, 'editRefundModal'])->name('edit_refund_modal');
    Route::get('view_refund_modal', [RefundController::class, 'showRefundModal'])->name('view_refund_modal');
    Route::post('delete_refund', [RefundController::class, 'deleteRefund'])->name('delete_refund');
    Route::get('cumulative_invoice', [InvoiceController::class, 'invoiceCumulativeInvoice'])->name('cumulative_invoice');
    Route::get('/view-proposal-pdf/{filename}', [WebsiteController::class, 'viewProposalPdf'])->name('viewProposalPdf');
    Route::get('/view-job-pdf/{filename}', [WebsiteController::class, 'viewJoblPdf'])->name('viewJoblPdf');
    Route::get('/subcontractor/pdf/{id}/{lead_id}', [WebsiteController::class, 'viewSubContractorPdf'])->name('viewSubContractorPdf');
    Route::get('/duplicate_material_name', [WebsiteController::class, 'duplicateMaterialName'])->name('duplicate_material_name');

    Route::resource('trade/trade', TradeController::class);
    Route::post('store_subcontractor', [WebsiteController::class, 'storeSubContractor']);
    Route::resource('subContractorCompanyDetail/sub-contractor-company-detail', SubContractorCompanyDetailController::class);

    Route::resource('materialListing/material-listing', MaterialListingController::class);
    Route::get('delete_material_list', [MaterialListingController::class, 'deleteMaterialList'])->name('delete_material_list');
    Route::post('update_material_list', [MaterialListingController::class, 'updateMaterialList'])->name('update_material_list');
    Route::resource('subContractorInsuranceInfo/sub-contractor-insurance-info', SubContractorInsuranceInfoController::class);

    Route::post('subcontractors/update-insurance', [WebsiteController::class, 'updateSubContractorInsuranceInfo']);
    Route::post('upload_insurance_attachment', [WebsiteController::class, 'uploadInsuranceAttachment']);
    Route::resource('subContractorRecurringEmail/sub-contractor-recurring-email', SubContractorRecurringEmailController::class);
    Route::post('update_insurance_agency_status', [WebsiteController::class, 'updateInsuranceAgencyStatus']);
    Route::resource('subContractorProposal/sub-contractor-proposal', SubContractorProposalController::class);
    Route::get('recurring_email', [WebsiteController::class, 'sendExpirationReminders']);
    Route::get('get_recurring_email_schedule', [WebsiteController::class, 'getRecurringEmail']);
    Route::get('delete_recurring_email_schedule', [WebsiteController::class, 'deleteRecurringEmail']);
    //Edit Modals Route
    Route::post('edit_product_modal', [ProductController::class, 'editProductModal'])->name('edit_product_modal');
    Route::post('edit_material_modal', [MaterialController::class, 'editMaterialModal'])->name('edit_material_modal');
    Route::post('edit_payment_type_modal', [PaymentTypeController::class, 'editPaymentTypeModal'])->name('edit_payment_type_modal');
    Route::post('edit_product_category_modal', [ProductCategoryController::class, 'editProductCategoryModal'])->name('edit_product_category_modal');
    Route::post('edit_customer_owner_type_modal', [CustomerOwnerTypeController::class, 'editCustomerOwnerTypeModal'])->name('edit_customer_owner_type_modal');

    Route::post('edit_mark_modal', [MarkController::class, 'editMarkModal'])->name('edit_mark_modal');
    Route::post('edit_team_modal', [TeamController::class, 'editTeamModal'])->name('edit_team_modal');
    Route::post('edit_stage_modal', [StageController::class, 'editStageModal'])->name('edit_stage_modal');
    Route::post('edit_priority_modal', [PriorityController::class, 'editPriorityModal'])->name('edit_priority_modal');
    Route::post('edit_category_modal', [CategoryController::class, 'editCategoryModal'])->name('edit_category_modal');
    Route::post('edit_announcement_modal', [AnnouncementController::class, 'editAnnouncementModal'])->name('edit_announcement_modal');
    Route::post('edit_cogs_material_modal', [CogsMaterialController::class, 'editCogsMaterialModal'])->name('edit_cogs_material_modal');
    Route::post('edit_email_template_folder_modal', [EmailTemplateFolderController::class, 'editEmailTemplateFolderModal'])->name('edit_email_template_folder_modal');

    //View Modals Route
    Route::get('view_stage_modal', [StageController::class, 'viewStageModal'])->name('view_stage_modal');
    Route::get('view_holiday_modal', [HolidayController::class, 'viewHolidayModal'])->name('view_holiday_modal');
    Route::get('view_category_modal', [CategoryController::class, 'viewCategoryModal'])->name('view_category_modal');
    Route::get('view_email_template_folder_modal', [EmailTemplateFolderController::class, 'viewEmailTemplateFolderModal'])->name('view_email_template_folder_modal');

    Route::get('default_product', [ProductController::class, 'defaultProduct'])->name('default_product');
    Route::get('/get-product-categories/{product}', [ProductController::class, 'getCategories']);
    //Route::get('email_branding',[EmailTemplateFolder\EmailTemplateFolderController::class, 'emailBranding'])->name('email_branding');


    Route::resource('roofEstimateSkylight/roof-estimate-skylight', RoofEstimateSkylightController::class);
    Route::get('get_chimney_content_chimney', [WebsiteController::class, 'getChimneyContentChimney']);
    Route::get('get_chimney_content_liner', [WebsiteController::class, 'getChimneyContentLiner']);
    Route::get('get_siding_content_replacement', [WebsiteController::class, 'getSidingContentReplacement']);
    Route::get('get_siding_content_over_existing', [WebsiteController::class, 'getSidingContentOverExisting']);
    Route::get('get_siding_content_gutter', [WebsiteController::class, 'getSidingContentGutter']);

    Route::get('get_roof_content_preferred', [WebsiteController::class, 'getRoofContentPreferred']);
    Route::get('get_roof_content_system', [WebsiteController::class, 'getRoofContentSystem']);
    Route::get('get_roof_content_under_15_sq', [WebsiteController::class, 'getRoofContentunderSq']);
    Route::get('get_roof_content_gutter', [WebsiteController::class, 'getRoofContentGutter']);
    Route::get('get_roof_content_flat_roof', [WebsiteController::class, 'getRoofContentFlatRoof']);

    Route::post('store_default_setting_product', [WebsiteController::class, 'storeDefaultSettingProduct'])->name('store_default_setting_product');
    Route::resource('emailBranding/email-branding', EmailBrandingController::class);
    Route::post('store_email_branding', [EmailBrandingController::class, 'storeEmailBranding']);

    Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'subcontractor'], function () {
        Route::get('sub_contractor_dashboard', [SubContractorController::class, 'dashboard'])->name('sub_contractor_dashboard');
        Route::get('sub_contractor_insurance_info', [SubContractorController::class, 'insuranceInfo'])->name('sub_contractor_insurance_info');
        Route::get('work_orders/{status}', [SubContractorController::class, 'workOrders'])->name('work_orders');
        Route::get('job/{status}', [SubContractorController::class, 'job'])->name('job');
        Route::get('sub_contractor_work_orders_upcoming', [SubContractorController::class, 'workOrdersUpcoming'])->name('sub_contractor_work_orders_upcoming');
        Route::get('sub_contractor_work_orders_signed', [SubContractorController::class, 'workOrdersSigned'])->name('sub_contractor_work_orders_signed');
        Route::get('sub_contractor_jobs', [SubContractorController::class, 'jobs'])->name('sub_contractor_jobs');
        Route::get('sub_contractor_jobs_details/{id}', [SubContractorController::class, 'jobsDetails'])->name('sub_contractor_jobs_details');
        Route::get('sub_contractor_finance', [SubContractorController::class, 'finance'])->name('sub_contractor_finance');
        Route::get('sub_contractor_profile', [SubContractorController::class, 'profile'])->name('sub_contractor_profile');
        Route::post('update_subcontractor_profile', [SubContractorController::class, 'updateProfile']);
    });
    // Customer Role Routes - Laravel 11 Style
    Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'customer'], function () {
        Route::get('index-new', [CustomerController::class, 'indexNew'])->name('index-new');
        Route::get('lead_measurement/{id}', [CustomerController::class, 'roofMeasurement'])->name('roof_measurement');
        Route::get('customer-index', [CustomerController::class, 'customerIndex'])->name('customer-index');
        Route::get('customer-chat', [CustomerController::class, 'customerChat'])->name('customer-chat');
        Route::get('customer-management/{id?}', [CustomerController::class, 'customerManagement'])->name('customer-management');
    });

    Route::get('/import-leads', [WebsiteController::class, 'importLeadsPage']);
    Route::post('/import-leads', [WebsiteController::class, 'importLeads'])->name('import.leads');
    Route::get('lead-analysis', [WebsiteController::class, 'leadAnalysis']);
    Route::get('/export-analytics', [WebsiteController::class, 'exportLeadAnalyticsToCsv']);
    Route::get('historical_analysis', [YearEstimationController::class, 'historicalAnalysis']);
    Route::get('goal_analysis', [YearEstimationController::class, 'goalAnalysis']);
    Route::get('get-lead-details', [SchedulingTaskController::class, 'getLeadDetails']);
    Route::post('appointment_delete', [AppointmentController::class, 'deleteAppointment'])->name('appointment_delete');
    Route::get('get_invoice_amount', [ReceivePaymentController::class, 'getInvoiceAmount']);
    Route::resource('subContractorInvoice/sub-contractor-invoice', SubContractorInvoiceController::class);
    //Route::resource('subContractorInvoiceAttachment/sub-contractor-invoice-attachment', SubContractorInvoiceAttachment\SubContractorInvoiceAttachmentController::class);
    Route::get('get_lead_job', [SubContractorInvoiceController::class, 'getLeadJobs']);
    Route::get('get_subcontractor_invoice', [SubContractorInvoiceController::class, 'getSubcontractorInvoice']);
    Route::get('mark_job_complete', [SubContractorController::class, 'markJobComplete']);
    Route::resource('subContractorReceiveable/sub-contractor-receiveable', SubContractorReceiveableController::class);
    Route::post('create_receive', [SubContractorReceiveableController::class, 'createReceive']);
    Route::get('get_job_invoices', [SubContractorReceiveableController::class, 'getJobInvoices']);
    Route::get('get_job_receive', [SubContractorReceiveableController::class, 'getJobReceive']);

    Route::post('appointment_reminder_email', [AppointmentController::class, 'appointmentReminderEmail']);
    Route::post('appointment_complete', [AppointmentController::class, 'appointmentComplete']);
    Route::post('appointment_sms', [AppointmentController::class, 'appointmentSms']);

    Route::get('appointment_address/{id?}', [WebsiteController::class, 'appointmentAddress'])->name('appointment_address');
    Route::resource('chatMessage/chat-message', ChatMessageController::class);
    Route::get('get_lead_chat', [ChatMessageController::class, 'getLeadChat']);
    Route::post('send_chat_message', [ChatMessageController::class, 'sendMessage']);
    //Route::post('send_chat_message', [ChatMessage\ChatMessageController::class, 'sendMessage']);
    Route::get('template_index', [WebsiteController::class, 'templateIndex'])->name('template_index');

    Route::resource('productTemplate/product-template', ProductTemplateController::class);
    Route::resource('productListTemplate/product-list-template', ProductListTemplateController::class);

    Route::get('select_template', [MaterialController::class, 'selectTemplate']);
    Route::post('update_lead_template', [MaterialController::class, 'updateLeadTemplate']);
    Route::resource('proposalType/proposal-type', ProposalTypeController::class);

    Route::post('staff_password_reset', [StaffController::class, 'staffPasswordReset']);
    Route::get('view_payment_type_modal', [PaymentTypeController::class, 'viewPaymentTypeModal']);
    Route::get('view_product_category_modal', [ProductCategoryController::class, 'viewProductCategoryModal']);
    Route::get('view_owner_type_modal', [CustomerOwnerTypeController::class, 'viewCustomerOwnerTypeModal']);
    Route::get('view_priority_modal', [PriorityController::class, 'viewPriorityModal']);
    Route::get('view_announcement_modal', [AnnouncementController::class, 'viewAnnouncementModal']);
    Route::get('view_mark_modal', [MarkController::class, 'viewMarkModal']);
    Route::get('view_cogs_modal', [CogsMaterialController::class, 'viewCogsModal']);
    Route::get('view_team_modal', [TeamController::class, 'viewTeamModal']);

    Route::get('marketing-spend-optimization', [WebsiteController::class, 'marketingSpendOptimization'])->name('marketing-spend-optimization');
    Route::get('marketing-analysis', [ApiController::class, 'marketingAnalysis']);

    Route::get('expense-prediction-leads', [WebsiteController::class, 'expensePredictionLeads'])->name('expense-prediction-leads')->middleware('auth');
    Route::get('dashboard-insights', [WebsiteController::class, 'dashboardInsights'])->name('dashboard-insights')->middleware('auth');
    Route::post('update-user-status/{id}', [WebsiteController::class, 'updateUserStatus']);
    Route::get('customer_match', [CustomerController::class, 'matchCustomer']);

    // AI Tools Routes
    Route::get('ai_year_estimation', [WebsiteController::class, 'aiYearEstimation'])->name('ai_year_estimation')->middleware('auth');
    Route::post('ai_year_estimation_goal_analysis', [WebsiteController::class, 'aiYearEstimationGoalAnalysis'])->name('ai_year_estimation_goal_analysis');
    Route::get('ai_job_type_earnings_analysis', [WebsiteController::class, 'aiJobTypeEarningsAnalysis'])->name('ai_job_type_earnings_analysis')->middleware('auth');
    Route::get('earning-forecast', [ApiController::class, 'earningPerJobWithForecast']);
    Route::get('get_calculator_data', [WebsiteController::class, 'getCalculatorData']);
    Route::get('get_sales_report', [ApiController::class, 'yearlyReportAnalysis']);
    Route::get('get_seasonal_prediction', [ApiController::class, 'seasonalPrediction']);
    Route::get('get_category_prediction', [ApiController::class, 'categoryPrediction']);
    Route::get('get_job_cost_prediction', [ApiController::class, 'jobCostPrediction']);
    Route::get('get_job_margin_prediction', [ApiController::class, 'jobMarginPrediction']);
    Route::get('chatbot-assistant', function () {
        $chatRoom = \App\ChatBotRoom::create(['name' => 'New Chat Created ' . now()]);
        return redirect()->route('chatbot', ['roomId' => $chatRoom]);
    });
    Route::get('chatbot/{roomId}', [WebsiteController::class, 'chatBot'])->name('chatbot');
    Route::post('store_user_message', [WebsiteController::class, 'storeUserMessage']);
    Route::post('store_ai_message', [WebsiteController::class, 'storeAiMessage']);

    Route::get('customer_onboarding', [CustomerController::class, 'customerOnboarding'])->name('customerOnboarding');
    Route::post('send_welcome_email_to_customers', [CustomerController::class, 'sendWelcomeEmailToCustomers'])->name('send_welcome_email_to_customers');

    Route::resource('chatBotRoom/chat-bot-room', ChatBotRoomController::class);
    Route::resource('chatBotMessage/chat-bot-message', ChatBotMessageController::class);
    Route::resource('controlPanel/control-panel', ControlPanelController::class);
    Route::post('update_control', [ControlPanelController::class, 'updateControl']);
    Route::get('send_invoices', [WebsiteController::class, 'sendInvoices']);
    Route::post('send_invoice_single', [WebsiteController::class, 'sendInvoiceSingle']);
    Route::get('send_cumulative_invoice', [WebsiteController::class, 'sendCumulativeInvoice']);
    Route::get('send_balance_sheet', [WebsiteController::class, 'sendBalanceSheet']);
    Route::get('send_cogs_detail', [WebsiteController::class, 'sendCogsDetail']);
    Route::resource('customerReferral/customer-referral', CustomerReferralController::class);
    Route::get('get_cam_photos', [CustomerController::class, 'getCamPhotos']);
    Route::post('send_support_message', [CustomerController::class, 'sendSupportMessage']);
    Route::get('get_support_messages', [CustomerController::class, 'getSupportMessage']);
    Route::resource('workForceHour/work-force-hour', WorkForceHourController::class);

    Route::get('support_chat', [WebsiteController::class, 'supportChat'])->name('support_chat')->middleware('auth');
    Route::get('lead_chat', [WebsiteController::class, 'leadChat'])->name('lead_chat')->middleware('auth');
    Route::get('referrals', [WebsiteController::class, 'referrals'])->name('referrals')->middleware('auth');
    Route::get('view_all_invoice_detail', [WebsiteController::class, 'viewAllInvoiceDetail'])->name('view_all_invoice_detail')->middleware('auth');

    /*
|--------------------------------------------------------------------------
| Central/Owner Routes (Tenant Management)
|--------------------------------------------------------------------------
| These routes are for super admin to manage tenants
*/



    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
        Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
        Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
        Route::get('/tenants/{id}', [TenantController::class, 'show'])->name('tenants.show');
        Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
        Route::put('/tenants/{id}', [TenantController::class, 'update'])->name('tenants.update');
        Route::delete('/tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
    });
});
