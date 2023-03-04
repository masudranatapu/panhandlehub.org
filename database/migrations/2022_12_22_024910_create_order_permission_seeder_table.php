<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Database\Seeders\OrderPermissionSeeder;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPermissionSeederTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('order_permission_seeder', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });


        // Counting super admin role table rows
        $role_count = DB::table('roles')->count();
        if ($role_count == 0) {
            $this->callPermissionSeeder();
        };

        $this->createOrderPermission();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('order_permission_seeder');
    }

    public function callPermissionSeeder()
    {
        Artisan::call('db:seed', [
            '--class' => RolePermissionSeeder::class,
        ]);
    }
    
    public function createOrderPermission()
    {
        Artisan::call('db:seed', [
            '--class' => OrderPermissionSeeder::class,
        ]);
    }
}
