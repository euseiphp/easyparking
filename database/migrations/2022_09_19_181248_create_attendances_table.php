<?php

use App\Models\Car;
use App\Models\Parking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Car::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Parking::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->decimal('price', 10)->nullable();
            $table->unsignedInteger('status');
            $table->timestamps();
            $table->timestamp('finished_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
