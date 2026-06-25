# Сайт ЧОУ ДПО «ДНИТ»

Корпоративный сайт **Дома науки и техники** (Волгоград) — учебного центра дополнительного профессионального образования. Лендинг + раздел новостей + полностью редактируемая админ-панель: всё содержимое сайта правится из браузера, без правок кода.

> **Стек:** Laravel 13 · Filament 5 · SQLite · Blade · vanilla JS (без бандлеров)

---

## Возможности

### Публичная часть
- **Hero-блок** в двух вариантах (текст-слева/центрирован), переключается в настройках.
- **Услуги, преимущества, о компании, лицензии** — каждый блок управляется отдельным ресурсом в админке.
- **Новости и события:**
  - Слайдер на главной с прокруткой по карточкам и точками-индикаторами.
  - Полная страница `/novosti` с пагинацией.
  - Детальная страница `/novosti/{slug}` — заголовок, дата на русском, hero-изображение в фиксированной пропорции, форматированный текст, блок похожих материалов.
  - Настраиваемая CTA-кнопка на детальной странице (отключаемая, любая ссылка, открытие в новой вкладке).
- **Галерея лицензий** — клик по скану открывает лайтбокс с навигацией стрелками, ESC, счётчиком, подписью.
- **Форма заявки** — данные летят в админку в раздел «Заявки с сайта», у новых заявок бейдж счётчика в навигации.
- **Адаптивная вёрстка** — десктоп / планшет / мобильный.

### Админ-панель (`/admin`)
- Верхняя навигация, акцентный цвет берётся из настроек сайта.
- Логотип ДНИТ + фирменный шрифт IBM Plex Sans.
- **Глобальный поиск** по всем сущностям (⌘K / Ctrl+K) — ищет по заголовкам, описаниям, телефонам, slug'ам.
- Прямая ссылка «Открыть сайт» в верхнем меню.
- Бейдж непрочитанных заявок.

---

## Структура контента

Каждый блок сайта — отдельная Eloquent-модель с полным CRUD в Filament:

| Раздел | Назначение |
|---|---|
| `SiteSetting` | Реквизиты, контакты, акцентный цвет, тексты футера, настройки CTA новости |
| `HeroBlock` | Hero-блок (вариант A/B, заголовки, цифры) |
| `NavLink` | Пункты главного меню (с тогглом активности) |
| `TrustItem` | Логотипы доверия |
| `Service` | Карточки услуг |
| `Advantage` | Преимущества |
| `AboutSection` | Блок «О компании» (singleton) |
| `License` | Лицензии и аттестаты со сканами |
| `News` | Новости (slug, дата, изображение, excerpt, body, опубликовано/нет) |
| `ServiceOption` | Опции для селекта в форме заявки |
| `ContactRequest` | Входящие заявки с сайта |

---

## Требования

- **PHP 8.3+** (рекомендуется 8.4)
- **Composer 2**
- SQLite (встроен в PHP)
- Опционально: GD/Imagick для обработки картинок

---

## Установка

```bash
git clone https://github.com/USERNAME/dnit-visit.git
cd dnit-visit

composer install
cp .env.example .env
php artisan key:generate

# создать БД
type nul > database\database.sqlite          # PowerShell / cmd
# touch database/database.sqlite             # Linux/macOS

php artisan migrate --seed
php artisan storage:link
```

Положи логотип в `storage/app/public/images/logo.png` — он подтягивается в шапку сайта, футер, фавикон и брендинг админки.

Создай первого администратора:

```bash
php artisan tinker --execute="\App\Models\User::create(['name'=>'Admin','email'=>'admin@dnit.local','password'=>bcrypt('admin123')]);"
```

---

## Запуск

```bash
php artisan serve --port=8000 --host=127.0.0.1
```

- Сайт: <http://127.0.0.1:8000/>
- Админка: <http://127.0.0.1:8000/admin>

> **Windows / OSPanel:** в проекте используется PHP 8.4 (`C:\OSPanel\modules\PHP-8.4\php.exe`). Если порт 8000 занят зависшим процессом — `Get-NetTCPConnection -LocalPort 8000` и `Stop-Process` по PID.

---

## Структура проекта

```
app/
├── Filament/
│   ├── Pages/              # Singleton-страницы: Hero, О компании, Настройки
│   └── Resources/          # CRUD по одному на сущность контента
├── Http/Controllers/
│   └── SiteController.php  # home / news.index / news.show / contact.store
├── Models/                 # Eloquent: News, Service, License, ...
└── Providers/Filament/
    └── AdminPanelProvider.php

resources/views/
├── components/
│   └── site-layout.blade.php   # общая обёртка фронта (хедер/футер/шрифты/CSS)
├── site/
│   ├── home.blade.php          # главная
│   ├── news-index.blade.php    # /novosti
│   ├── news-show.blade.php     # /novosti/{slug}
│   └── partials/               # переиспользуемые блоки секций
└── filament/
    └── brand-logo.blade.php    # логотип админки

routes/web.php                  # 4 публичных маршрута
database/migrations/            # схема + добавочные миграции для CTA и nav toggle
```

---

## Часто настраиваемое

| Что | Где |
|---|---|
| Акцентный цвет (на сайте и в админке) | Админ → Сайт → Настройки сайта → Акцентный цвет |
| Вариант hero-блока (A/B) | Там же → Вариант hero-блока |
| Меню навигации | Админ → Сайт → Пункты меню (с порядком и тогглом «Показывать») |
| Кнопка на странице новости | Настройки сайта → секция «Кнопка на странице новости» |
| Показ блока новостей на главной | Настройки сайта → «Показывать блок новостей» |
| Логотип | `storage/app/public/images/logo.png` |

---

## Деплой

Стандартный деплой Laravel:

```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

Веб-сервер указывает в `public/` — `.htaccess` уже на месте для Apache, для nginx — стандартный `try_files $uri $uri/ /index.php?$query_string`.

---

## Лицензия

Внутренний проект ЧОУ ДПО «ДНИТ». Laravel и Filament — MIT.
