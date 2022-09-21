<?php

use App\Models\Parking;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Parking::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('status');
            $table->string('name', 100);
            $table->string('description', 100);
            $table->decimal('price', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
