<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_files_table.php

// database/migrations/xxxx_xx_xx_xxxxxx_create_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filepath');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lesson_id'); // Aggiunta della colonna lesson_id
            $table->timestamps();

            // Definizione delle chiavi esterne
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
