<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants.
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->latest()->paginate(20);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $tenants
            ]);
        }

        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Show the form for editing the specified tenant.
     */
    public function edit($id)
    {
        $tenant = Tenant::with('domains')->find($id);

        if (!$tenant) {
            return redirect()->route('tenants.index')
                ->with('error', 'Tenant not found');
        }

        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Store a newly created tenant.
     */
    public function store(Request $request)
    {
        Log::info('=== TENANT CREATION STARTED ===');
        Log::info('Request Data:', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tenants,name',
            'email' => 'required|email|unique:tenants,email',
            'domain' => 'required|string|unique:domains,domain',
            'phone' => 'nullable|string|max:20|unique:tenants,phone',
            'address' => 'nullable|string|unique:tenants,address',
            'subscription_plan' => 'nullable|string',
        ]);

        Log::info('Validation passed:', $validated);

        try {
            Log::info('Creating tenant record...');

            // Create tenant
            $tenant = Tenant::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'subscription_plan' => $request->subscription_plan ?? 'basic',
                'is_active' => true,
                'trial_ends_at' => now()->addDays(30), // 30 days trial
            ]);

            Log::info('Tenant created successfully:', ['tenant_id' => $tenant->id]);

            // Create domain for tenant
            $domainName = $validated['domain'];
            Log::info('Creating domain:', ['domain' => $domainName]);

            $tenant->domains()->create([
                'domain' => $domainName,
            ]);

            Log::info('Domain created successfully');

            // Setup tenant database with admin role, user and permissions
            $this->setupTenantDatabase($tenant);

            Log::info('=== TENANT CREATION COMPLETED ===');

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tenant created successfully!',
                    'data' => $tenant->load('domains')
                ], 201);
            }

            return redirect()->route('tenants.index')
                ->with('success', 'Tenant created successfully!');
        } catch (\Exception $e) {
            Log::error('=== TENANT CREATION FAILED ===');
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Error Trace: ' . $e->getTraceAsString());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create tenant',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to create tenant: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified tenant.
     */
    public function show($id)
    {
        $tenant = Tenant::with('domains')->find($id);

        if (!$tenant) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tenant
        ]);
    }

    /**
     * Update the specified tenant.
     */
    public function update(Request $request, $id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:tenants,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'subscription_plan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $tenant->update($request->only([
                'name',
                'email',
                'phone',
                'address',
                'is_active',
                'subscription_plan'
            ]));

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tenant updated successfully!',
                    'data' => $tenant->load('domains')
                ]);
            }

            return redirect()->route('tenants.index')
                ->with('success', 'Tenant updated successfully!');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update tenant',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to update tenant: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified tenant.
     */
    public function destroy($id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tenant not found'
                ], 404);
            }

            return redirect()->route('tenants.index')
                ->with('error', 'Tenant not found');
        }

        try {
            $tenant->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tenant deleted successfully!'
                ]);
            }

            return redirect()->route('tenants.index')
                ->with('success', 'Tenant deleted successfully!');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete tenant',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to delete tenant: ' . $e->getMessage());
        }
    }

    /**
     * Setup tenant database with admin role, user and permissions
     */
    private function setupTenantDatabase($tenant)
    {
        try {
            Log::info('=== SETTING UP TENANT DATABASE ===');
            Log::info('Tenant ID: ' . $tenant->id);

            // Run tenant context
            $tenant->run(function () use ($tenant) {
                Log::info('Running in tenant context...');

                // Step 1: Get admin role from central database
                $centralAdminRole = DB::connection('central')->table('roles')
                    ->where('name', 'admin')
                    ->first();

                if (!$centralAdminRole) {
                    Log::error('Admin role not found in central database!');
                    throw new \Exception('Admin role not found in central database');
                }

                Log::info('Central admin role found:', (array)$centralAdminRole);

                // Step 2: Insert admin role into tenant database
                $tenantRoleId = DB::table('roles')->insertGetId([
                    'name' => $centralAdminRole->name,
                    'label' => $centralAdminRole->label,
                    // 'created_at' => now(),
                    // 'updated_at' => now(),
                ]);

                Log::info('Admin role created in tenant DB with ID: ' . $tenantRoleId);

                // Step 3: Create admin user in tenant database
                $tenantUserId = DB::table('users')->insertGetId([
                    'name' => $tenant->name,
                    'email' => $tenant->email,
                    'password' => Hash::make('nmdp7788'),
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Log::info('Admin user created in tenant DB with ID: ' . $tenantUserId);

                // Step 4: Assign admin role to user
                DB::table('role_user')->insert([
                    'role_id' => $tenantRoleId,
                    'user_id' => $tenantUserId,
                    // 'created_at' => now(),
                    // 'updated_at' => now(),
                ]);

                Log::info('Admin role assigned to user');

                // Step 5: Copy all permissions from central database to tenant database
                $centralPermissions = DB::connection('central')->table('permissions')->get();
                Log::info('Found ' . $centralPermissions->count() . ' permissions in central DB');

                $permissionIdMapping = [];
                foreach ($centralPermissions as $centralPermission) {
                    $tenantPermissionId = DB::table('permissions')->insertGetId([
                        'name' => $centralPermission->name,
                        'label' => $centralPermission->label,
                        // 'created_at' => now(),
                        // 'updated_at' => now(),
                    ]);
                    $permissionIdMapping[$centralPermission->id] = $tenantPermissionId;
                }
                Log::info('Inserted ' . count($permissionIdMapping) . ' permissions into tenant DB');

                // Step 6: Get permission-role relationships for admin role from central database
                $centralPermissionRoles = DB::connection('central')->table('permission_role')
                    ->where('role_id', $centralAdminRole->id)
                    ->get();

                Log::info('Found ' . $centralPermissionRoles->count() . ' permission-role relationships in central DB');

                // Step 7: Insert permission-role relationships into tenant database
                $permissionRoleData = [];
                foreach ($centralPermissionRoles as $permissionRole) {
                    if (isset($permissionIdMapping[$permissionRole->permission_id])) {
                        $permissionRoleData[] = [
                            'permission_id' => $permissionIdMapping[$permissionRole->permission_id],
                            'role_id' => $tenantRoleId,
                            // 'created_at' => now(),
                            // 'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($permissionRoleData)) {
                    DB::table('permission_role')->insert($permissionRoleData);
                    Log::info('Inserted ' . count($permissionRoleData) . ' permission-role relationships into tenant DB');
                }

                // Step 8: Copy common_settings from central database to tenant database
                $centralCommonSettings = DB::connection('central')->table('common_settings')->first();
                if ($centralCommonSettings) {
                    DB::table('common_settings')->insert([
                        'title' => $centralCommonSettings->title,
                        'description' => $centralCommonSettings->description,
                        'favicon' => $centralCommonSettings->favicon,
                        'dashboard_logo' => $centralCommonSettings->dashboard_logo,
                        'dashboard_logo_text' => $centralCommonSettings->dashboard_logo_text,
                        'footer_text' => $centralCommonSettings->footer_text,
                        'calendar' => $centralCommonSettings->calendar,
                        // 'created_at' => now(),
                        // 'updated_at' => now(),
                    ]);
                    Log::info('Common settings copied to tenant DB');
                }

                Log::info('=== TENANT DATABASE SETUP COMPLETED ===');
            });
        } catch (\Exception $e) {
            Log::error('=== TENANT DATABASE SETUP FAILED ===');
            Log::error('Error: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }
}
