<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pages', function (Blueprint $table) {
            $table->id();
            $table->string('main_page');
            $table->string('main_id')->nullable();
            $table->string('second_page')->nullable();
            $table->string('second_id')->nullable();
            $table->string('third_page')->nullable();
            $table->string('third_id')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('expire')->nullable();
            $table->date('expired_at')->nullable();
            $table->integer('warning')->nullable();
            $table->integer('exclusion')->nullable();
            $table->boolean('exclusion_status')->nullable();
            $table->integer('admin_id')->nullable()->default(0);
            $table->integer('super_admin_id')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_pages');
    }
}
