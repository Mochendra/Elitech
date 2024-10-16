<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_archives_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Relasi ke postingan
            $table->timestamps(); // Ini akan membuat created_at dan updated_at
            $table->text('caption'); // Caption
        });
    }

    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
