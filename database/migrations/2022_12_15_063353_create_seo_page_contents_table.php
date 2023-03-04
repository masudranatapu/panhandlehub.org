<?php

use Illuminate\Support\Carbon;
use Database\Seeders\SeoSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoPageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_page_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('language_code');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreign('page_id')->references('id')->on('seos')->onDelete('casCade');
            $table->timestamps();
        });

        // Counting seo tables rows
        $seo_count = DB::table('seos')->count();
        if ($seo_count == 0) {
            $this->createData();
        };

        // Fetching seo pages rows
        $pages = DB::table('seos')->get();
        foreach ($pages as $item) {
            DB::table('seo_page_contents')->insert([
                'page_id' => $item->id,
                'language_code' => 'en',
                'title' => $item->title,
                'description' => $item->description,
                'image' => $item->image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        //  then delete extra column 
        Schema::table('seos', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_page_contents');
    }

    public function createData()
    {
        Artisan::call('db:seed', [
            '--class' => SeoSeeder::class,
        ]);
    }
}
