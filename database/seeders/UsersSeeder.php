<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // ---------------- KAPRODI ----------------
            [
                'username' => 'Vikasari Cahya',
                'email' => 'vika@gmail.com',
                'password' => Hash::make('vika12345'),
                'role' => 'kaprodi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ---------------- DOSEN ----------------
            [
                'username' => 'Wachid Nur',
                'email' => 'wachid@gmail.com',
                'password' => Hash::make('wachid12345'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Agus Susanto',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('agus12345'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Lutfi Syafirullah',
                'email' => 'lutfi@gmail.com',
                'password' => Hash::make('lutfi12345'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Novi Prasetyanti',
                'email' => 'novi@gmail.com',
                'password' => Hash::make('novi12345'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Rostika Listyaningrum',
                'email' => 'rostika@gmail.com',
                'password' => Hash::make('rostika12345'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ---------------- MAHASISWA ----------------
            [		    
                'username'      => 'Andi Pratama', 
                'email'      	  => 'andi@gmail.com', 
                'password'      => Hash::make('andi12345'),
                'role'          => 'mahasiswa', 
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      => 'Budi Setiawan', 
                'email'      	=> 'budi@gmail.com', 
                'password'      => Hash::make('budi12345'),
                'role'          => 'mahasiswa', 
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                
                'username'      =>'Citra Dewi', 
                'email'      	  => 'citra@gmail.com', 
                'password'      => Hash::make('citra12345'),
                'role'          => 'mahasiswa', 
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'username'      =>'Dian Wulandari', 
                'email'      	  => 'dian@gmail.com', 
                'password'      => Hash::make('dian12345'),
                'role'          => 'mahasiswa', 
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                    'username'      =>'Eko Prabowo', 
                    'email'      	  => 'eko@gmail.com', 
                    'password'      => Hash::make('eko12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
                    'username'      =>'Fina Kusuma', 
                    'email'      	  => 'fina@gmail.com', 
                    'password'      => Hash::make('fina12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
                    'username'      =>'Gilang Nugroho', 
                    'email'      	  => 'gilang@gmail.com', 
                    'password'      => Hash::make('gilang12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
                
                    'username'      =>'Hani Sari', 
                    'email'      	  => 'hani@gmail.com', 
                    'password'      => Hash::make('hani12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
    
                    'username'      =>'Iwan Kurniawan', 
                    'email'      	  => 'iwan@gmail.com', 
                    'password'      => Hash::make('iwan12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Joko Widodo', 
                    'email'      	  => 'joko@gmail.com', 
                    'password'      => Hash::make('joko12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Krisna Putra', 
                    'email'      	  => 'krisna@gmail.com', 
                    'password'      => Hash::make('krisna12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
    
                    'username'      =>'Lina Marlina', 
                    'email'      	  => 'lina@gmail.com', 
                    'password'      => Hash::make('lina12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Maya Puspita', 
                    'email'         => 'maya@gmail.com', 
                    'password'      => Hash::make('maya12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
                
            ],
            [
    
                    'username'      =>'Nanda Pratiwi', 
                    'email'         => 'nanda@gmail.com', 
                    'password'      => Hash::make('maya12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
                    
                    'username'      =>'Oka Setiawan', 
                    'email'         => 'oka@gmail.com', 
                    'password'      => Hash::make('oka12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Putri Ayu', 
                    'email'      	  => 'putri@gmail.com', 
                    'password'      => Hash::make('putri12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Rudi Hartono', 
                    'email'      	  => 'rudi@gmail.com', 
                    'password'      => Hash::make('rudi12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
               
                    'username'      =>'Sari Melati', 
                    'email'      	=> 'sari@gmail.com', 
                    'password'      => Hash::make('sari12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
    
            [
                    'username'      =>'Teguh Santoso', 
                    'email'      	=> 'teguh@gmail.com', 
                    'password'      => Hash::make('teguh12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
            [
    
                    'username'      =>'Uli Sari', 
                    'email'      	=> 'uli@gmail.com', 
                    'password'      => Hash::make('uli12345'),
                    'role'          => 'mahasiswa', 
                    'created_at'    => now(),
                    'updated_at'    => now()
            ],
        ]);
    }
}
