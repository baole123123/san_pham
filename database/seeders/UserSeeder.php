<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $item = new User();
        $item->name = "Lê Chí Bảo";
        $item->email = "lechibaovlog@gmail.com";
        $item->password = Hash::make('123456789');
        $item->group_id ='1';
        $item->phone ='0123456789';
        $item->address ='Gio Linh';
        $item->gender ='Nam';

        $item->save();
    }
}
