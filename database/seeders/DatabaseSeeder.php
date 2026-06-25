<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\Advantage;
use App\Models\HeroBlock;
use App\Models\License;
use App\Models\NavLink;
use App\Models\News;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\SiteSetting;
use App\Models\TrustItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(['id' => 1], [
            'phone' => '+7 (8442) 52-70-21',
            'phone_hours' => 'Пн–Пт · 08:30–17:30',
            'email' => 'vdnit@yandex.ru',
            'address_office' => 'г. Волгоград, пр-т им. В.И. Ленина, д. 88, офис 20',
            'address_lab' => 'Красноармейский р-н, ул. Бахтурова, д. 10Б, 2 этаж',
            'inn' => '3444143729',
            'ogrn' => '1073400000497',
            'company_name' => 'Дом науки и техники',
            'company_short' => 'ЧОУ ДПО «ДНИТ» · Волгоград',
            'logo_text_left' => 'ДН',
            'logo_text_right' => 'иТ',
            'hero_variant' => 'a',
            'accent_color' => '#2f6db0',
            'show_news' => true,
            'footer_copyright' => '© 2007–2026 ЧОУ ДПО «ДНИТ». Все права защищены.',
            'footer_about' => 'Частное образовательное учреждение дополнительного профессионального образования «ДНИТ». Волгоград, с 2007 года.',
        ]);

        HeroBlock::updateOrCreate(['id' => 1], [
            'variant' => 'a',
            'badge_text' => 'Образовательная деятельность с 2007 года',
            'headline' => "Обучение, СОУТ\nи охрана труда\nв Волгограде",
            'subtitle' => 'Дом науки и техники проводит дополнительное профессиональное образование, специальную оценку условий труда и экологический контроль — с собственной аккредитованной лабораторией.',
            'cta_primary_label' => 'Получить консультацию',
            'cta_primary_href' => '#zayavka',
            'cta_secondary_label' => 'Наши услуги',
            'cta_secondary_href' => '#uslugi',
            'stats_caption' => 'Коротко о нас',
            'stat1_value' => '19 лет',
            'stat1_label' => 'на рынке услуг',
            'stat2_value' => '200+',
            'stat2_label' => 'программ обучения',
            'stat3_value' => 'РФ',
            'stat3_label' => 'СОУТ по всей стране',
            'stat4_value' => '1 лаб.',
            'stat4_label' => 'химико-аналитическая',
            'stats_footer_text' => 'Лицензия на образовательную деятельность · аккредитация лаборатории',
        ]);

        TrustItem::query()->delete();
        foreach ([
            'Лицензия на образовательную деятельность',
            'Аккредитованная испытательная лаборатория',
            'В реестре организаций, проводящих СОУТ',
            'Рассрочка и отсрочка платежа',
        ] as $i => $text) {
            TrustItem::create(['text' => $text, 'sort' => $i + 1]);
        }

        NavLink::query()->delete();
        foreach ([
            ['Услуги', '#uslugi'],
            ['Преимущества', '#preimushchestva'],
            ['О компании', '#o-kompanii'],
            ['Лицензии', '#litsenzii'],
            ['Контакты', '#kontakty'],
        ] as $i => [$label, $href]) {
            NavLink::create(['label' => $label, 'href' => $href, 'sort' => $i + 1]);
        }

        Service::query()->delete();
        $services = [
            [
                '01',
                'Дополнительное профессиональное образование',
                'Первичное обучение и переподготовка по более чем 200 программам, в том числе дистанционно.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 8 L13 3 L23 8 L13 13 Z"/><path d="M7 10.5 V16 C7 16 9.5 18 13 18 C16.5 18 19 16 19 16 V10.5"/></svg>',
            ],
            [
                '02',
                'Специальная оценка условий труда (СОУТ)',
                'Проведение СОУТ на всей территории России. Гарантированно избавит от штрафов надзорных органов.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M13 3 L21 6 V12 C21 17 17.5 21 13 23 C8.5 21 5 17 5 12 V6 Z"/><path d="M9.5 13 L12 15.5 L16.5 10"/></svg>',
            ],
            [
                '03',
                'Аутсорсинг охраны труда',
                'Ведение охраны труда под ключ силами наших специалистов — без расширения штата предприятия.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="13" cy="9" r="4"/><path d="M5 22 C5 17.5 8.5 15 13 15 C17.5 15 21 17.5 21 22"/></svg>',
            ],
            [
                '04',
                'Производственный экологический контроль',
                'Аккредитованная лаборатория проводит работы по ПЭК и экологическому проектированию.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M10 3 V10 L5 20 C4.3 21.5 5 23 6.7 23 H19.3 C21 23 21.7 21.5 21 20 L16 10 V3"/><path d="M8.5 3 H17.5"/><path d="M7.5 16 H18.5"/></svg>',
            ],
            [
                '05',
                'Оценка профессиональных рисков',
                'Выявление, анализ и снижение профессиональных рисков на рабочих местах в соответствии с ТК РФ.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 22 L13 5 L22 22 Z"/><path d="M9 17 H17"/><circle cx="13" cy="13" r="0.6" fill="currentColor"/></svg>',
            ],
            [
                '06',
                'Лабораторные исследования',
                'Исследования почвы и среды для строительства и инженерных изысканий, поверка средств измерения.',
                '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M11 3 V9 L6 19 C5.3 20.4 6 22 7.6 22 H18.4 C20 22 20.7 20.4 20 19 L15 9 V3"/><path d="M9.5 3 H16.5"/><circle cx="13" cy="17" r="1.4"/></svg>',
            ],
        ];
        foreach ($services as $i => [$number, $title, $description, $svg]) {
            Service::create([
                'number' => $number,
                'title' => $title,
                'description' => $description,
                'icon_svg' => $svg,
                'sort' => $i + 1,
            ]);
        }

        Advantage::query()->delete();
        $advantages = [
            ['01', 'С 2007 года', 'Ведём образовательную деятельность 19 лет — опыт и репутация подтверждены временем.'],
            ['02', 'Гарантия на услуги', 'Предоставляем гарантию на все виды оказываемых услуг и сопровождаем при проверках.'],
            ['03', '200+ программ', 'Более 200 программ подготовки, включая возможность полностью дистанционного обучения.'],
            ['04', 'СОУТ по всей России', 'Проводим специальную оценку условий труда и оценку рисков на всей территории страны.'],
            ['05', 'Собственная лаборатория', 'Аккредитованная химико-аналитическая лаборатория для измерений и контроля.'],
            ['06', 'Рассрочка платежа', 'Возможность рассрочки и отсрочки платежа — удобные условия для предприятий.'],
        ];
        foreach ($advantages as $i => [$number, $title, $description]) {
            Advantage::create([
                'number' => $number,
                'title' => $title,
                'description' => $description,
                'sort' => $i + 1,
            ]);
        }

        AboutSection::updateOrCreate(['id' => 1], [
            'eyebrow' => '03 — О компании',
            'headline' => "Дом науки\nи техники",
            'body' => "ЧОУ ДПО «ДНИТ» — частное образовательное учреждение дополнительного профессионального образования, основанное в Волгограде в 2007 году. Мы объединяем учебный центр, экспертизу по охране труда и аккредитованную лабораторию.\n\nЗа годы работы разработано более 200 программ подготовки, реализованы тысячи проектов по СОУТ, оценке рисков и экологическому контролю для предприятий региона и всей страны.",
            'stat1_value' => '2007',
            'stat1_label' => 'год основания',
            'stat2_value' => '200+',
            'stat2_label' => 'учебных программ',
            'stat3_value' => '19',
            'stat3_label' => 'лет опыта',
        ]);

        License::query()->delete();
        foreach ([
            ['Лицензия на образовательную деятельность', 'Министерство образования'],
            ['Аттестат аккредитации лаборатории', 'Испытательная лаборатория'],
            ['Реестр организаций СОУТ', 'Минтруд России'],
            ['Свидетельство о поверке', 'Средства измерения'],
        ] as $i => [$title, $subtitle]) {
            License::create([
                'title' => $title,
                'subtitle' => $subtitle,
                'sort' => $i + 1,
            ]);
        }

        News::query()->delete();
        foreach ([
            ['vsemirnyy-den-okhrany-truda', 'Всемирный день охраны труда', '2026-04-27'],
            ['novye-programmy-distantsionnogo-obucheniya-2026', 'Новые программы дистанционного обучения 2026', '2026-03-12'],
            ['planovye-proverki-git', 'Плановые проверки ГИТ: к чему готовиться', '2026-01-28'],
        ] as $i => [$slug, $title, $date]) {
            News::create([
                'slug' => $slug,
                'title' => $title,
                'published_at' => $date,
                'is_published' => true,
            ]);
        }

        ServiceOption::query()->delete();
        foreach ([
            'Обучение / ДПО',
            'Специальная оценка условий труда',
            'Аутсорсинг охраны труда',
            'Экологический контроль',
            'Оценка профессиональных рисков',
            'Лабораторные исследования',
            'Другое',
        ] as $i => $label) {
            ServiceOption::create(['label' => $label, 'sort' => $i + 1]);
        }
    }
}
