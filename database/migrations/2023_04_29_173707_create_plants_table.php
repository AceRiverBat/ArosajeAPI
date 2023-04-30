<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('plants', function (Blueprint $table) {
        $table->uuid('id')->primary()->default(Str::uuid());
        $table->string('title');
        $table->string('image');
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->foreignUuid('owner_id')->references('id')->on('users');
        $table->foreignUuid('guardian_id')->nullable()->references('id')->on('users');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
