<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refresh_sessions', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('refresh_token')->unique();
            $table->string('ua', 200);
            $table->string('ip', 15);
            $table->bigInteger('expires_in');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('refresh_sessions');
    }
};
