<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Notifications\NuevoUsuario;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randString = Str::random(10);
        User::create([
            'name' => 'Isavo Castro',
            'email' => 'isavocastro@gmail.com',
            'password' => Hash::make($randString)
        ])->assignRole('Admin')->notify(new NuevoUsuario($randString));

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
            'name' => 'Marcelo Perez',
            'email' => 'mperez@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Miembro');

        User::create([
            'name' => 'Josefa Salas',
            'email' => 'jsalas@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Ester López',
            'email' => 'elopez@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Invitado');

        User::create([
            'name' => 'Javier Cortez',
            'email' => 'jcortez@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Miembro');
    }
}
