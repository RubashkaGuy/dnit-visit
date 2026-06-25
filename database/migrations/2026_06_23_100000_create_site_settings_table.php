<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('phone_hours')->nullable();
            $table->string('email')->nullable();
            $table->string('address_office')->nullable();
            $table->string('address_lab')->nullable();
            $table->string('inn')->nullable();
            $table->string('ogrn')->nullable();
            $table->string('company_name')->default('Дом науки и техники');
            $table->string('company_short')->default('ЧОУ ДПО «ДНИТ» · Волгоград');
            $table->string('logo_text_left')->default('ДН');
            $table->string('logo_text_right')->default('иТ');
            $table->string('hero_variant', 1)->default('a');
            $table->string('accent_color', 7)->default('#2f6db0');
            $table->boolean('show_news')->default(true);
            $table->string('footer_copyright')->default('© 2007–2026 ЧОУ ДПО «ДНИТ». Все права защищены.');
            $table->string('footer_about')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
