<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedsRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed roles and permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $roles = config('permission.seeds.roles');
        foreach(array_keys($roles) as $roleName)
        {
            $role = Role::firstOrCreate(['name'=>$roleName]);
            foreach($roles[$roleName] as $permissionName)
            {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }

            $this->info("{$role->name} is created");
        }
        // $user = User::first();
        // $user->assignRole('SuperAdmin');
        // $this->info("{$user->email} is added with SuperAdmin role");
        return 0;
    }
}
