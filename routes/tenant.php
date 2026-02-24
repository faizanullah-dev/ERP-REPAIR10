<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// All routes moved to routes/web.php with 'universal' middleware
// This allows routes to work in both central and tenant contexts

// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
//     Auth::routes();
//     Route::get('/', function () {
//         if (auth()->check()) {
//             return redirect('/dashboard');
//         }
//         return redirect('/login');
//     });
// });
