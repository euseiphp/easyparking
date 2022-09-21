<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('status');
            $table->string('name')->index();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->unsignedInteger('number');
            $table->string('city')->nullable();
            $table->string('state');
            $table->string('postcode');
            $table->unsignedInteger('spaces');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
