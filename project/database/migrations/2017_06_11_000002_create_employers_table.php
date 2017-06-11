<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     * @table employers
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('fio', 60)->nullable();
            $table->string('position', 30)->nullable();
            $table->date('date')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('chief')->unsigned()->index();

        });
        Schema::table('employers', function (Blueprint $table) {
            $table->foreign('chief')->references('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('employers');
     }
}
