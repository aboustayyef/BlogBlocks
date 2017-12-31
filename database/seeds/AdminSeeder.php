<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    
    public function run()
    {        
        $admin = new User;
        $admin->name = "Mustapha";
        $admin->email = "mustapha.hamoui@gmail.com";
        $admin->password = bcrypt(env('ADMIN_PASSWORD'));
        $admin->save();
    }
}
