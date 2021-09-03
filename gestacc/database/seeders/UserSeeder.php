<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Isavo Castro',
            'email' => 'isavocastro@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Jose Fuentes',
            'email' => 'jfuentes@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Miembro');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpena@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpendfa@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenfa@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenwa@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenqa@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenda@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpefna@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpfena@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenga@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Maria Peña',
            'email' => 'mpenadsds@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');
    }
}
