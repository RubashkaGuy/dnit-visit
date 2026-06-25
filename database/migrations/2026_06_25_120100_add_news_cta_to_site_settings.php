<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('news_cta_enabled')->default(true)->after('show_news');
            $table->string('news_cta_label')->default('Оставить заявку')->after('news_cta_enabled');
            $table->string('news_cta_href')->default('/#zayavka')->after('news_cta_label');
            $table->boolean('news_cta_new_tab')->default(false)->after('news_cta_href');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['news_cta_enabled', 'news_cta_label', 'news_cta_href', 'news_cta_new_tab']);
        });
    }
};
