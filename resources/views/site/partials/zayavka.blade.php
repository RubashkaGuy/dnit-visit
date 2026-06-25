@php
    $phoneDigits = preg_replace('/\D+/', '', $settings->phone ?? '');
@endphp
<section id="zayavka" style="background:var(--navy);color:#fff;">
    <div class="two-col" style="max-width:1200px;margin:0 auto;padding:88px 32px;display:grid;grid-template-columns:0.9fr 1.1fr;gap:64px;align-items:start;">
        <div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:#8fb0d4;margin-bottom:14px;">06 — Заявка</div>
            <h2 style="font-size:38px;font-weight:700;letter-spacing:-0.025em;margin:0 0 18px;">Остались вопросы?</h2>
            <p style="font-size:16.5px;line-height:1.7;color:#c5d4e6;margin:0 0 28px;">Оставьте заявку — специалисты {{ $settings->company_name }} свяжутся с вами, подберут программу и рассчитают стоимость услуг.</p>
            <div style="display:flex;flex-direction:column;gap:18px;">
                @if($settings->phone)
                    <a href="tel:+{{ $phoneDigits }}" style="display:flex;align-items:center;gap:14px;">
                        <span style="width:42px;height:42px;border-radius:10px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.16);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;">☎</span>
                        <span>
                            <span style="display:block;font-size:17px;font-weight:600;">{{ $settings->phone }}</span>
                            <span style="font-size:13px;color:#aebfd2;">{{ $settings->phone_hours }}</span>
                        </span>
                    </a>
                @endif
                @if($settings->email)
                    <a href="mailto:{{ $settings->email }}" style="display:flex;align-items:center;gap:14px;">
                        <span style="width:42px;height:42px;border-radius:10px;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.16);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;">@</span>
                        <span>
                            <span style="display:block;font-size:17px;font-weight:600;">{{ $settings->email }}</span>
                            <span style="font-size:13px;color:#aebfd2;">Электронная почта</span>
                        </span>
                    </a>
                @endif
            </div>
        </div>

        <div style="background:#fff;border-radius:18px;padding:38px;">
            @if($sent)
                <div style="text-align:center;padding:40px 10px;">
                    <div style="width:64px;height:64px;border-radius:50%;background:#e8f5ee;color:#2f9e63;display:flex;align-items:center;justify-content:center;font-size:30px;margin:0 auto 22px;">✓</div>
                    <h3 style="font-size:23px;font-weight:700;color:var(--navy);margin:0 0 10px;">Заявка отправлена</h3>
                    <p style="font-size:15px;color:var(--muted);margin:0 0 24px;line-height:1.6;">Спасибо! Мы свяжемся с вами в ближайшее рабочее время.</p>
                    <a href="{{ url('/') }}#zayavka" style="display:inline-block;background:var(--tint);border:1px solid var(--line);color:var(--navy);font-weight:600;font-size:14px;padding:11px 22px;border-radius:9px;text-decoration:none;">Отправить ещё одну</a>
                </div>
            @else
                <form method="POST" action="{{ route('contact.store') }}" class="form-field">
                    @csrf
                    <h3 style="font-size:21px;font-weight:700;color:var(--navy);margin:0 0 22px;">Оставить заявку</h3>
                    @if($errors->any())
                        <div style="background:#fff1f1;border:1px solid #f3c5c5;color:#a02020;padding:10px 14px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                            @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
                        </div>
                    @endif
                    <div style="display:flex;flex-direction:column;gap:15px;">
                        <label style="display:block;">
                            <span style="display:block;font-size:13px;font-weight:500;color:#4a5764;margin-bottom:7px;">Ваше имя</span>
                            <input name="name" required value="{{ old('name') }}" placeholder="Иван Иванов" style="width:100%;border:1px solid var(--line);border-radius:9px;padding:13px 15px;font-size:15px;font-family:inherit;color:var(--ink);outline:none;">
                        </label>
                        <label style="display:block;">
                            <span style="display:block;font-size:13px;font-weight:500;color:#4a5764;margin-bottom:7px;">Телефон</span>
                            <input name="phone" required type="tel" value="{{ old('phone') }}" placeholder="+7 (___) ___-__-__" style="width:100%;border:1px solid var(--line);border-radius:9px;padding:13px 15px;font-size:15px;font-family:inherit;color:var(--ink);outline:none;">
                        </label>
                        <label style="display:block;">
                            <span style="display:block;font-size:13px;font-weight:500;color:#4a5764;margin-bottom:7px;">Интересующая услуга</span>
                            <select name="service" style="width:100%;border:1px solid var(--line);border-radius:9px;padding:13px 15px;font-size:15px;font-family:inherit;color:var(--ink);outline:none;background:#fff;">
                                @foreach($serviceOptions as $opt)
                                    <option value="{{ $opt->label }}" @selected(old('service') === $opt->label)>{{ $opt->label }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label style="display:block;">
                            <span style="display:block;font-size:13px;font-weight:500;color:#4a5764;margin-bottom:7px;">Комментарий</span>
                            <textarea name="message" rows="3" placeholder="Кратко опишите задачу" style="width:100%;border:1px solid var(--line);border-radius:9px;padding:13px 15px;font-size:15px;font-family:inherit;color:var(--ink);outline:none;resize:vertical;">{{ old('message') }}</textarea>
                        </label>
                        <button type="submit" style="width:100%;background:var(--accent);color:#fff;font-weight:600;font-size:15.5px;padding:15px;border:none;border-radius:9px;cursor:pointer;margin-top:4px;">Отправить заявку</button>
                        <p style="font-size:11.5px;color:#9aa7b5;margin:2px 0 0;line-height:1.5;text-align:center;">Нажимая кнопку, вы соглашаетесь с политикой обработки персональных данных.</p>
                    </div>
                </form>
            @endif
        </div>
    </div>
</section>
