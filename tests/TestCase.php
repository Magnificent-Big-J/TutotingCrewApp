<?php

namespace Tests;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function postUserData()
    {
        return [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'phone' => '+27867854129',
            'location' => '6874 Nokukwane Street'
        ];
    }
    private function createRoles()
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
    }
    public function authenticateAdmin()
    {
        $user = factory(User::class)->create();
        $this->createRoles();
        $role = Role::where('name', 'Admin')->first();
        $user->roles()->attach($role);
        $this->actingAs($user);
    }
    public function authenticateTutor()
    {
        $user = factory(User::class)->create();
        $this->createRoles();
        $role = Role::where('name', 'Junior')->first();
        $user->roles()->attach($role);
        $this->actingAs($user);
    }
}
