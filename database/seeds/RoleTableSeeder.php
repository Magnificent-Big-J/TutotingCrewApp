<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array('name'=>'Admin','description'=>'Admin User'),
            array('name'=>'Junior','description'=>'Junior User'),
            array('name'=>'Senior','description'=>'Senior User'),
            array('name'=>'Core Team','description'=>'Core Team User'),
            array('name'=>'External','description'=>'External User'),
        );

        foreach ($roles as $role) {
            Role::create($role);
        }

        $faker = Factory::create();
        $user = User::create([
            'name' => 'Joel Mnisi',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phone' => $faker->phoneNumber,
            'location' => $faker->address
        ]);
        $role = Role::where('name', 'Admin')->first();
        $user->roles()->attach($role);
        \factory(\App\Student::class, 10)->create();


    }
}
