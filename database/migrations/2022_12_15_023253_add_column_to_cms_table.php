<?php

use App\Models\Cms;
use Database\Seeders\CmsSeeder;
use Database\Seeders\FooterTextSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->string('footer_text')->nullable();
        });

        // Counting cms tables rows
        $cms_count = DB::table('cms')->count();
        if ($cms_count == 0) {
            $this->createCmsData();
        };

        // update this table data 
        $this->updateCmsData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms', function (Blueprint $table) {
            //
        });
    }

    public function createCmsData()
    {
        Artisan::call('db:seed', [
            '--class' => CmsSeeder::class,
        ]);
    }

    public function updateCmsData()
    {
        Artisan::call('db:seed', [
            '--class' => FooterTextSeeder::class,
        ]);
    }
}
