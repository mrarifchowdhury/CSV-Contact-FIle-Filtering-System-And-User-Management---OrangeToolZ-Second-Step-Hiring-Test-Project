<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
                'is_admin'=>'1',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
            [
               'name'=>'Mahmud',
               'email'=>'mahmud@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
            [
               'name'=>'Arif',
               'email'=>'caara09bd@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
            [
               'name'=>'Porosh',
               'email'=>'midtajik07@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'Mahi',
               'email'=>'mahi@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'kamal',
               'email'=>'kamal@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'shamim',
               'email'=>'shamim@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'raton',
               'email'=>'raton@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'dipto',
               'email'=>'dipto@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'nahid',
               'email'=>'nahid@gmail.com',
                'is_admin'=>'0',
                'status'=>'1',
               'password'=> bcrypt('123456789'),
            ],

             [
               'name'=>'rishad',
               'email'=>'rishad@gmail.com',
                'is_admin'=>'0',
                'status'=>'0',
               'password'=> bcrypt('123456789'),
            ],
             [
               'name'=>'amit',
               'email'=>'amit@gmail.com',
                'is_admin'=>'0',
                'status'=>'0',
               'password'=> bcrypt('123456789'),
            ],
              [
               'name'=>'towhid',
               'email'=>'towhid@gmail.com',
                'is_admin'=>'0',
                'status'=>'0',
               'password'=> bcrypt('123456789'),
            ],
                [
               'name'=>'shanu',
               'email'=>'shanu@gmail.com',
                'is_admin'=>'0',
                'status'=>'0',
               'password'=> bcrypt('123456789'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}