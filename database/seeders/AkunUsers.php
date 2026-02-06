<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData =[
            [
                'name'=>'Mbak Dewi',
                'email'=>'dewi@gmail.com',
                'role'=>'operator',
                'password'=>bcrypt('kopte098')
            ],
            [
                'name'=>'Mas Admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('adminkopte')
            ],
            [
                'name'=>'Mbak Wanda',
                'email'=>'wanda@gmail.com',
                'role'=>'operator',
                'password'=>bcrypt('kopte098')
            ],
            [
                'name'=>'Mas Bowo',
                'email'=>'bowo@gmail.com',
                'role'=>'operator',
                'password'=>bcrypt('kopte098')
            ],
            [
                'name'=>'Mas Helky',
                'email'=>'helky@gmail.com',
                'role'=>'operator',
                'password'=>bcrypt('kopte098')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
        
    }
}
