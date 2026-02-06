<?php

use App\Models\Supplies;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplies::class)->constrained()->cascadeOnUpdate();
            $table->integer('quantity_in')->nullable();
            $table->string('operator', 60);
            $table->date('entry_date')->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate();
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
        Schema::dropIfExists('incoming_goods');
    }
};
