<?php

use App\Models\Category;
use App\Models\Departement;
use App\Models\Location;
use App\Models\Priority;
use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //creator information
            $table->foreignIdFor(User::class, 'requested_by')
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            //ticket information
            $table->foreignIdFor(Category::class)
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();
            $table->string('no');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->date('periode');

            $table->foreignIdFor(TicketStatus::class)
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();

            $table->foreignIdFor(Priority::class)
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();

            $table->foreignIdFor(Departement::class)
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();

            $table->foreignIdFor(Location::class)
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();

            $table->foreignIdFor(User::class, 'assigned_to')
                ->nullable()
                ->constrained()
                ->noActionOnUpdate()
                ->restrictOnDelete();

            $table->json('attachments')->nullable();
            $table->json('proof_attachments')->nullable();

            $table->index(['periode']);
            $table->unique(['no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
