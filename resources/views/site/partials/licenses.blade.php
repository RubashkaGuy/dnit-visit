<section id="litsenzii" style="background:var(--tint);border-top:1px solid var(--line);border-bottom:1px solid var(--line);">
    <div style="max-width:1200px;margin:0 auto;padding:80px 32px;">
        <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">04 — Документы</div>
        <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0 0 12px;color:var(--navy);">Лицензии и аккредитации</h2>
        <p style="font-size:16px;color:var(--muted);margin:0 0 42px;max-width:560px;">Деятельность ЧОУ ДПО «{{ $settings->logo_text_left }}{{ $settings->logo_text_right }}» подтверждена государственными лицензиями и аттестатами аккредитации.</p>
        <div class="grid-4" data-gallery="licenses" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;">
            @foreach($licenses as $i => $license)
                <div class="lic-card" style="background:#fff;border:1px solid var(--line);border-radius:13px;padding:22px;transition:box-shadow .2s,transform .2s,border-color .2s;">
                    @if($license->image_path)
                        <button type="button"
                                data-lightbox
                                data-gallery-name="licenses"
                                data-src="{{ asset('storage/'.$license->image_path) }}"
                                data-caption="{{ $license->title }} — {{ $license->subtitle }}"
                                data-index="{{ $i }}"
                                aria-label="Открыть скан: {{ $license->title }}"
                                style="display:block;width:100%;padding:0;border:0;background:transparent;cursor:zoom-in;">
                            <span style="display:flex;aspect-ratio:3/4;border-radius:8px;border:1px solid var(--line);margin-bottom:16px;overflow:hidden;background:#fff;align-items:center;justify-content:center;position:relative;">
                                <img src="{{ asset('storage/'.$license->image_path) }}" alt="{{ $license->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                                <span class="lic-zoom" aria-hidden="true" style="position:absolute;right:10px;bottom:10px;width:36px;height:36px;border-radius:50%;background:rgba(22,48,78,0.86);color:#fff;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .15s;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                </span>
                            </span>
                        </button>
                    @else
                        <div style="aspect-ratio:3/4;border-radius:8px;border:1px solid var(--line);margin-bottom:16px;background:repeating-linear-gradient(135deg,#eef2f7,#eef2f7 9px,#f7fafc 9px,#f7fafc 18px);display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:10.5px;letter-spacing:0.1em;color:#9aa7b5;text-align:center;">
                            <span style="padding:10px;">скан<br>документа</span>
                        </div>
                    @endif
                    <h3 style="font-size:15px;font-weight:600;margin:0 0 5px;color:var(--navy);">{{ $license->title }}</h3>
                    <p style="font-size:13px;color:var(--muted);margin:0;">{{ $license->subtitle }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .lic-card:hover{border-color:var(--accent);box-shadow:0 14px 30px -20px rgba(22,48,78,0.35);transform:translateY(-2px);}
    .lic-card button[data-lightbox]:hover .lic-zoom{opacity:1;}
    .lic-card button[data-lightbox]:focus-visible{outline:2px solid var(--accent);outline-offset:3px;border-radius:8px;}
    .lbx{position:fixed;inset:0;background:rgba(11,22,38,0.92);z-index:1000;display:none;align-items:center;justify-content:center;padding:48px;animation:lbxIn .18s ease-out;}
    .lbx.is-open{display:flex;}
    @keyframes lbxIn{from{opacity:0;}to{opacity:1;}}
    .lbx-img{max-width:100%;max-height:100%;object-fit:contain;border-radius:6px;box-shadow:0 30px 60px -20px rgba(0,0,0,0.6);background:#fff;}
    .lbx-btn{position:absolute;background:rgba(255,255,255,0.08);color:#fff;border:1px solid rgba(255,255,255,0.18);width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .15s,border-color .15s;}
    .lbx-btn:hover{background:rgba(255,255,255,0.16);border-color:rgba(255,255,255,0.3);}
    .lbx-close{top:24px;right:24px;}
    .lbx-prev{left:24px;top:50%;transform:translateY(-50%);}
    .lbx-next{right:24px;top:50%;transform:translateY(-50%);}
    .lbx-caption{position:absolute;bottom:24px;left:50%;transform:translateX(-50%);color:#fff;font-size:14px;padding:10px 16px;background:rgba(0,0,0,0.4);border-radius:8px;max-width:80%;text-align:center;}
    .lbx-counter{position:absolute;top:24px;left:24px;color:rgba(255,255,255,0.7);font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.1em;}
    @media (max-width:700px){
        .lbx{padding:16px;}
        .lbx-close{top:12px;right:12px;}
        .lbx-prev{left:8px;}
        .lbx-next{right:8px;}
    }
</style>

<div class="lbx" data-lbx role="dialog" aria-modal="true" aria-label="Просмотр документа">
    <div class="lbx-counter" data-lbx-counter></div>
    <button type="button" class="lbx-btn lbx-close" data-lbx-close aria-label="Закрыть">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    <button type="button" class="lbx-btn lbx-prev" data-lbx-prev aria-label="Предыдущий">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </button>
    <button type="button" class="lbx-btn lbx-next" data-lbx-next aria-label="Следующий">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
    </button>
    <img class="lbx-img" data-lbx-img alt="">
    <div class="lbx-caption" data-lbx-caption></div>
</div>

<script>
    (function(){
        var lbx=document.querySelector('[data-lbx]');
        if(!lbx)return;
        var img=lbx.querySelector('[data-lbx-img]');
        var caption=lbx.querySelector('[data-lbx-caption]');
        var counter=lbx.querySelector('[data-lbx-counter]');
        var prevBtn=lbx.querySelector('[data-lbx-prev]');
        var nextBtn=lbx.querySelector('[data-lbx-next]');
        var closeBtn=lbx.querySelector('[data-lbx-close]');
        var items=[];
        var currentIndex=0;
        var triggers=document.querySelectorAll('[data-lightbox]');

        triggers.forEach(function(t){
            items.push({src:t.dataset.src, caption:t.dataset.caption||''});
        });

        function setNav(){
            var multi=items.length>1;
            prevBtn.style.display = multi ? 'flex' : 'none';
            nextBtn.style.display = multi ? 'flex' : 'none';
            counter.textContent = multi ? ((currentIndex+1)+' / '+items.length) : '';
        }
        function open(i){
            currentIndex=i;
            var item=items[i];
            img.src=item.src;
            img.alt=item.caption;
            caption.textContent=item.caption;
            setNav();
            lbx.classList.add('is-open');
            document.body.style.overflow='hidden';
        }
        function close(){
            lbx.classList.remove('is-open');
            document.body.style.overflow='';
            img.src='';
        }
        function step(d){
            currentIndex=(currentIndex+d+items.length)%items.length;
            open(currentIndex);
        }
        triggers.forEach(function(t,i){
            t.addEventListener('click',function(e){e.preventDefault();open(i);});
        });
        closeBtn.addEventListener('click',close);
        prevBtn.addEventListener('click',function(){step(-1);});
        nextBtn.addEventListener('click',function(){step(1);});
        lbx.addEventListener('click',function(e){if(e.target===lbx)close();});
        document.addEventListener('keydown',function(e){
            if(!lbx.classList.contains('is-open'))return;
            if(e.key==='Escape')close();
            else if(e.key==='ArrowLeft'&&items.length>1)step(-1);
            else if(e.key==='ArrowRight'&&items.length>1)step(1);
        });
    })();
</script>
