<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'logo',
        'is_active',
        'trial_ends_at',
        'subscription_plan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    /**
     * Get custom data for the tenant.
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'logo',
            'is_active',
            'trial_ends_at',
            'subscription_plan',
        ];
    }

    /**
     * Get all users for this tenant.
     */
    public function users()
    {
        return $this->hasMany(\App\User::class, 'tenant_id');
    }

    /**
     * Check if tenant is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Check if tenant trial has expired.
     */
    public function trialExpired(): bool
    {
        if (!$this->trial_ends_at) {
            return false;
        }

        return $this->trial_ends_at->isPast();
    }
}

