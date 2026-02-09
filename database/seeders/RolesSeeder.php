<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemConfigurations\Authorizations\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Tenant',
                'role_description' => 'Rent properties, make payments, and manage your rental agreements with ease.',
                'is_role_active' => true,
            ],
            [
                'name' => 'Landlord',
                'role_description' => 'Manage your rental units, track tenants, and monitor payments effortlessly.',
                'is_role_active' => true,
            ],
            [
                'name' => 'Property Manager',
                'role_description' => 'Handle multiple landlords, tenants, and maintenance operations under one system.',
                'is_role_active' => true,
            ],
            [
                'name' => 'Caretaker',
                'role_description' => 'Oversee property maintenance, handle tenant requests, and report issues in real-time.',
                'is_role_active' => true,
            ],
            [
                'name' => 'Real Estate Agency',
                'role_description' => 'List, market, and manage multiple properties and clients efficiently.',
                'is_role_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Roles::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
