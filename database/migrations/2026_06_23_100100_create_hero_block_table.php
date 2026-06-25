<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('variant', 1)->default('a');
            $table->string('badge_text')->nullable();
            $table->text('headline')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('cta_primary_label')->default('Получить консультацию');
            $table->string('cta_primary_href')->default('#zayavka');
            $table->string('cta_secondary_label')->default('Наши услуги');
            $table->string('cta_secondary_href')->default('#uslugi');
            $table->string('stat1_value')->nullable();
            $table->string('stat1_label')->nullable();
            $table->string('stat2_value')->nullable();
            $table->string('stat2_label')->nullable();
            $table->string('stat3_value')->nullable();
            $table->string('stat3_label')->nullable();
            $table->string('stat4_value')->nullable();
            $table->string('stat4_label')->nullable();
            $table->string('stats_caption')->nullable();
            $table->string('stats_footer_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_blocks');
    }
};
