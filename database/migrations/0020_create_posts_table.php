<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestampsTz();
            $table->foreignIdFor(User::class)->index()->constrained()->cascadeOnDelete();
            $table->text('subject');
            $table->text('content');
            $table->dateTimeTz('published_at')->nullable();
        });
    }
};
