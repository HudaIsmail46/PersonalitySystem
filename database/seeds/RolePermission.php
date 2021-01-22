<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create bookings',
            'list bookings',
            'edit bookings',
            'delete bookings',
            'create customers',
            'list customers',
            'edit customers',
            'delete customers',
            'create users',
            'list users',
            'edit users',
            'delete users',
            'list orders',
            'create orders',
            'list runnerSchedules',
            'create runnerSchedules',
            'list assignedRunnerSchedule',
            'list vendorCollected orders',
            'list inhouseCleaning orders',
            'reOpen order',
            'import bookingProduct',
            'list members',
            'create members',
            'list teams',
            'create teams',
            'list teamMembers',
            'create teamMembers',
            'list vehicles',
            'create vehicles',
            'create roles'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }


    }
}
