<?php

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
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'tutor_id')) {
                $table->foreignId('tutor_id')->constrained('users');
            }
    
            if (!Schema::hasColumn('courses', 'category_id')) {
                $table->foreignId('category_id')->constrained();
            }
    
            if (!Schema::hasColumn('courses', 'subcategory_id')) {
                $table->foreignId('subcategory_id')->constrained('categories');
            }
        });
    }
    
    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::table('courses', function (Blueprint $table) {
    //         if (!Schema::hasColumn('courses', 'tutor_id')) {
    //             $table->unsignedBigInteger('tutor_id');
    //         }
    //         //
    //     });
    // }
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'tutor_id')) {
                // $table->dropForeign(['tutor_id']);
                $table->dropColumn('tutor_id');
            }
            // if (Schema::hasColumn('courses', 'category_id')) {
            //     $table->dropForeign(['category_id']);
            //     $table->dropColumn('category_id');
            // }
            // if (Schema::hasColumn('courses', 'subcategory_id')) {
            //     $table->dropForeign(['subcategory_id']);
            //     $table->dropColumn('subcategory_id');
            // }
        });
    }

};
