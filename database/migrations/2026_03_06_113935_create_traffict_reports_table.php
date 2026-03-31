<?php

use App\Enums\TrafficReportStatus;
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
        Schema::create('traffic_reports', function (Blueprint $table) {
            $table->id();

            // user fields
            $table->foreignId('violation_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('reported_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('occurred_at')->nullable();
            $table->text('description')->nullable();

            // administrative fields
            $table->string('status')->default(TrafficReportStatus::Pending->value);
            $table->foreignId('classification_id')->nullable()->constrained()->onDelete('set null'); // minor | major | critical
            $table->string('administrative_action')->nullable(); // warning | observation | derived

            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffict_reports');
    }
};
