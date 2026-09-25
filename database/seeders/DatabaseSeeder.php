<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use App\Models\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $factory = Factory::firstOrCreate(
            ['code' => 'FCT-001'],
            ['name' => 'Demo Garments Ltd.', 'address' => 'Ashulia, Dhaka', 'is_active' => true]
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@garments-erp.test'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'factory_id' => $factory->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('Super Admin');
    }
}
