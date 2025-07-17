<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'users.add-new', 'guard_name' => 'web'],
            ['name' => 'users.viewAny', 'guard_name' => 'web'],
            ['name' => 'users.view.profile', 'guard_name' => 'web'],
            ['name' => 'users.manage-role-permissions', 'guard_name' => 'web'],
            ['name' => 'users.update', 'guard_name' => 'web'],
            ['name' => 'users.delete', 'guard_name' => 'web'],

            ['name' => 'role.create', 'guard_name' => 'web'],
            ['name' => 'role.manage', 'guard_name' => 'web'],
            ['name' => 'role.update', 'guard_name' => 'web'],
            ['name' => 'role.delete', 'guard_name' => 'web'],

            ['name' => 'permission.manage', 'guard_name' => 'web'],
            ['name' => 'permission.create', 'guard_name' => 'web'],
            ['name' => 'permission.update', 'guard_name' => 'web'],
            ['name' => 'permission.delete', 'guard_name' => 'web'],

            ['name' => 'province-district-city.manage', 'guard_name' => 'web'],
            ['name' => 'province-district-city.create', 'guard_name' => 'web'],
            ['name' => 'province-district-city.update', 'guard_name' => 'web'],
            ['name' => 'province-district-city.delete', 'guard_name' => 'web'],

            ['name' => 'service-category.create', 'guard_name' => 'web'],
            ['name' => 'service-category.update', 'guard_name' => 'web'],
            ['name' => 'service-category.manage', 'guard_name' => 'web'],
            ['name' => 'service-category.delete', 'guard_name' => 'web'],
            ['name' => 'service-category.subcategory', 'guard_name' => 'web'],
            ['name' => 'service-category.dynamic-input-field', 'guard_name' => 'web'],
            ['name' => 'service-category.static-input-field', 'guard_name' => 'web'],
            ['name' => 'service-category.arrange-input-field', 'guard_name' => 'web'],

            ['name' => 'content.manage', 'guard_name' => 'web'],

            ['name' => 'page.manage', 'guard_name' => 'web'],
            ['name' => 'page.create', 'guard_name' => 'web'],
            ['name' => 'page.update', 'guard_name' => 'web'],
            ['name' => 'page.delete', 'guard_name' => 'web'],

            ['name' => 'banner.manage', 'guard_name' => 'web'],
            ['name' => 'banner.create', 'guard_name' => 'web'],
            ['name' => 'banner.update', 'guard_name' => 'web'],
            ['name' => 'banner.delete', 'guard_name' => 'web'],

            ['name' => 'manage-doctor.manage', 'guard_name' => 'web'],
            ['name' => 'manage-doctor.approve', 'guard_name' => 'web'],
            ['name' => 'manage-doctor.reject', 'guard_name' => 'web'],

            ['name' => 'manage-doctor.view', 'guard_name' => 'web'],
            ['name' => 'manage-doctor.approve', 'guard_name' => 'web'],
            ['name' => 'manage-doctor.reject', 'guard_name' => 'web'],

            ['name' => 'all-member.view', 'guard_name' => 'web'],

            ['name' => 'inquiry.view', 'guard_name' => 'web'],
            ['name' => 'inquiry.view-details', 'guard_name' => 'web'],

            ['name' => 'reports', 'guard_name' => 'web'],
            ['name' => 'reports.payment', 'guard_name' => 'web'],

            ['name' => 'reviews.view', 'guard_name' => 'web'],

            ['name' => 'product-category.view', 'guard_name' => 'web'],

            ['name' => 'product.create', 'guard_name' => 'web'],
            ['name' => 'product.update', 'guard_name' => 'web'],
            ['name' => 'product.delete', 'guard_name' => 'web'],
            ['name' => 'product.manage', 'guard_name' => 'web'],

            ['name' => 'orders.view', 'guard_name' => 'web'],
            ['name' => 'orders.details', 'guard_name' => 'web'],
            ['name' => 'orders.approve', 'guard_name' => 'web'],
            ['name' => 'orders.reject', 'guard_name' => 'web'],

            ['name' => 'payment.approve', 'guard_name' => 'web'],
            ['name' => 'payment.reject', 'guard_name' => 'web'],

            ['name' => 'service-provider', 'guard_name' => 'web'],
            ['name' => 'service-provider.access', 'guard_name' => 'web'],

            ['name' => 'service-provider.view', 'guard_name' => 'web'],
            ['name' => 'service-provider.approve', 'guard_name' => 'web'],
            ['name' => 'service-provider.manage', 'guard_name' => 'web'],
            ['name' => 'service-provider.reject', 'guard_name' => 'web'],

            ['name' => 'business.view', 'guard_name' => 'web'],
            ['name' => 'business.details', 'guard_name' => 'web'],
            ['name' => 'business.manage', 'guard_name' => 'web'],
            ['name' => 'business.approve', 'guard_name' => 'web'],
            ['name' => 'business.reject', 'guard_name' => 'web'],

            ['name' => 'doctor', 'guard_name' => 'web'],
            ['name' => 'doctor.access', 'guard_name' => 'web'],

            ['name' => 'bank.view', 'guard_name' => 'web'],
            ['name' => 'bank.create', 'guard_name' => 'web'],
            ['name' => 'bank.update', 'guard_name' => 'web'],
            ['name' => 'bank.delete', 'guard_name' => 'web'],

            ['name' => 'manage-service.view', 'guard_name' => 'web'],

            ['name' => 'contact.view', 'guard_name' => 'web'],

            ['name' => 'deactivate.view', 'guard_name' => 'web'],

            ['name' => 'blog.view', 'guard_name' => 'web'],
        ];

        Permission::upsert($permissions, 'name');
    }
}
