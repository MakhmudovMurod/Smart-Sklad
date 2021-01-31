<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'ingredient_create',
            ],
            [
                'id'    => 18,
                'title' => 'ingredient_edit',
            ],
            [
                'id'    => 19,
                'title' => 'ingredient_show',
            ],
            [
                'id'    => 20,
                'title' => 'ingredient_delete',
            ],
            [
                'id'    => 21,
                'title' => 'ingredient_access',
            ],
            [
                'id'    => 22,
                'title' => 'profile_password_edit',
            ],

            [
                'id'    => 23,
                'title' => 'formula_create',
            ],
            [
                'id'    => 24,
                'title' => 'formula_edit',
            ],
            [
                'id'    => 25,
                'title' => 'formula_show',
            ],
            [
                'id'    => 26,
                'title' => 'formula_delete',
            ],
            [
                'id'    => 27,
                'title' => 'formula_access',
            ],

            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 34,
                'title' => 'ingredient_replenish',
            ],

            [
                'id'    => 35,
                'title' => 'unit_access',
            ],

            [
                'id'    => 36,
                'title' => 'unit_create',
            ],

            [
                'id'    => 37,
                'title' => 'report_access',
            ],

            [
                'id'    => 38,
                'title' => 'unit_delete',
            ],

            [
                'id'    => 39,
                'title' => 'income_access',
            ],

            [
                'id'    => 40,
                'title' => 'outcome_access',
            ],

            [
                'id'    => 41,
                'title' => 'income_delete',
            ],
            [
                'id'    => 42,
                'title' => 'outcome_delete',
            ],
        ];

        Permission::insert($permissions);
    }
}
