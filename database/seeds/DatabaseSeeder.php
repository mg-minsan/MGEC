<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       /* factory(App\User::class, 10)->create();*/
        //factory(App\Attendance\Attendance::class, 10)->create();
        //factory(App\Attendance\Trip::class, 10)->create();
        /*factory(App\Attendance\RollCall::class, 10)->create();*/
        $users = ['Min San', 'Kyaw Kyar', 'Soe Yan Naung', 
            'Thet Oo Zin', 'Banyar', 'Hsu Way Phyo', 'Yan Lin Aung',
            'Sein Khat Soe', 'Kaung Htet Thu', 'Phyow Nya',
            'Lily Phyo', 'Aung Pyae Sone'];

        DB::table('trips')->insert([
            'name' => 'Shan Yoma 2017',
            'duration' => '22',
            'created_at' => date('Y-m-d h:i:s', time()),
            'updated_at' => date('Y-m-d  h:i:s', time()),

        ]);

        foreach($users as $user){

            DB::table('attendances')->insert([
                'name' => $user,
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time()),
            ]);
        }


    }
}
