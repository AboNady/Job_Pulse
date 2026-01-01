<?php

use App\Models\Employer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employer::class)
                  ->constrained('employers')
                  ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('salary');
            $table->string('type'); // e.g., Full-time, Part-time, Contract
            $table->date('posted_date');
            $table->date('closing_date');
            $table->string('url');
            $table->string('logo');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
