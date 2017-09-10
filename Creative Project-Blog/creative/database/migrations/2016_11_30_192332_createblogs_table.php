<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateblogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('heading');
            $table->text('content');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->dateTime('published_at');
            $table->integer('is_published')->unsigned()->default(1);
            $table->integer('hit_count')->unsigned()->default(0);
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('vote')->unsigned()->default(0);
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->timestamps();
        });

        $faker = Faker\Factory::create();
        $limit = 33;
       for ($i = 0; $i < $limit; $i++) {
            DB::table('blogs')->insert([ //,
                'heading' => $faker->sentence,
                'content' => $faker->paragraph,
                'user_id' => 1,
                 'published_at' => new \DateTime(),
                 'category_id' => $faker->numberBetween(1, 5),
                
            ]);
        }
    }
            /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}


