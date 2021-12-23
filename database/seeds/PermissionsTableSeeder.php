<?php

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
            [
                'id'    => '1',
                'name' => 'user_management_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '2',
                'name' => 'permission_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '3',
                'name' => 'permission_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '4',
                'name' => 'permission_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '5',
                'name' => 'permission_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '6',
                'name' => 'permission_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '7',
                'name' => 'role_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '8',
                'name' => 'role_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '9',
                'name' => 'role_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '10',
                'name' => 'role_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '11',
                'name' => 'role_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '12',
                'name' => 'user_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '13',
                'name' => 'user_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '14',
                'name' => 'user_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '15',
                'name' => 'user_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '16',
                'name' => 'user_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '17',
                'name' => 'category_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '18',
                'name' => 'category_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '19',
                'name' => 'category_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '20',
                'name' => 'category_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '21',
                'name' => 'category_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '22',
                'name' => 'question_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '23',
                'name' => 'question_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '24',
                'name' => 'question_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '25',
                'name' => 'question_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '26',
                'name' => 'question_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '27',
                'name' => 'option_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '28',
                'name' => 'option_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '29',
                'name' => 'option_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '30',
                'name' => 'option_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '31',
                'name' => 'option_access',
                'guard_name' => 'web',
            ],
            [
                'id'    => '32',
                'name' => 'result_create',
                'guard_name' => 'web',
            ],
            [
                'id'    => '33',
                'name' => 'result_edit',
                'guard_name' => 'web',
            ],
            [
                'id'    => '34',
                'name' => 'result_show',
                'guard_name' => 'web',
            ],
            [
                'id'    => '35',
                'name' => 'result_delete',
                'guard_name' => 'web',
            ],
            [
                'id'    => '36',
                'name' => 'result_access',
            
            ],
        ];

        Permission::insert($permissions);
    }
}
