<section id="novosti" style="max-width:1200px;margin:0 auto;padding:88px 32px;">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;margin-bottom:42px;flex-wrap:wrap;">
        <div>
            <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;letter-spacing:0.18em;text-transform:uppercase;color:var(--accent);margin-bottom:14px;">05 — Новости</div>
            <h2 style="font-size:40px;font-weight:700;letter-spacing:-0.025em;margin:0;color:var(--navy);">Новости и события</h2>
        </div>
        <div style="display:flex;align-items:center;gap:14px;">
            <button type="button" data-news-prev aria-label="Назад" style="width:44px;height:44px;border-radius:50%;border:1px solid var(--line);background:#fff;color:var(--navy);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:border-color .15s,color .15s,box-shadow .15s;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button type="button" data-news-next aria-label="Вперёд" style="width:44px;height:44px;border-radius:50%;border:1px solid var(--line);background:#fff;color:var(--navy);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:border-color .15s,color .15s,box-shadow .15s;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
            <a href="{{ route('news.index') }}" style="display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#fff;background:var(--accent);padding:11px 18px;border:1px solid var(--accent);border-radius:8px;transition:filter .15s;" onmouseover="this.style.filter='brightness(1.08)';" onmouseout="this.style.filter='none';">
                Посмотреть всё
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>

    <div data-news-slider style="position:relative;">
        <div data-news-track style="display:flex;gap:22px;overflow-x:auto;scroll-snap-type:x mandatory;scroll-behavior:smooth;padding:6px 2px 18px;margin:-6px -2px 0;scrollbar-width:none;-ms-overflow-style:none;">
            @foreach($news as $item)
                <div style="flex:0 0 calc((100% - 44px) / 3);min-width:260px;scroll-snap-align:start;display:flex;">
                    @include('site.partials.news-card', ['item' => $item, 'cardStyle' => 'width:100%;'])
                </div>
            @endforeach
        </div>
        <div data-news-dots style="display:flex;justify-content:center;gap:8px;margin-top:18px;"></div>
    </div>
</section>

<style>
    [data-news-track]::-webkit-scrollbar{display:none;}
    [data-news-prev]:hover,[data-news-next]:hover{border-color:var(--accent);color:var(--accent);box-shadow:0 8px 22px -16px rgba(22,48,78,0.45);}
    [data-news-prev][disabled],[data-news-next][disabled]{opacity:0.35;cursor:not-allowed;pointer-events:none;}
    .news-dot{width:8px;height:8px;border-radius:50%;background:var(--line);border:0;cursor:pointer;padding:0;transition:background .15s,transform .15s;}
    .news-dot.is-active{background:var(--accent);transform:scale(1.3);}
    @media (max-width:900px){
        [data-news-track] > div{flex-basis:calc(100% - 24px) !important;}
    }
    @media (min-width:901px) and (max-width:1100px){
        [data-news-track] > div{flex-basis:calc((100% - 22px) / 2) !important;}
    }
</style>

<script>
    (function(){
        var slider=document.querySelector('[data-news-slider]');
        if(!slider)return;
        var track=slider.querySelector('[data-news-track]');
        var prev=document.querySelector('[data-news-prev]');
        var next=document.querySelector('[data-news-next]');
        var dotsBox=slider.querySelector('[data-news-dots]');
        if(!track||!prev||!next)return;

        function step(){
            var first=track.children[0];
            if(!first)return track.clientWidth;
            return first.offsetWidth + 22;
        }
        function updateNav(){
            prev.disabled = track.scrollLeft <= 4;
            next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
            renderDots();
        }
        function renderDots(){
            if(!dotsBox)return;
            var s=step();
            var pages=Math.max(1, Math.ceil((track.scrollWidth - track.clientWidth)/s)+1);
            if(pages<=1){dotsBox.innerHTML='';return;}
            var current=Math.round(track.scrollLeft/s);
            if(dotsBox.children.length!==pages){
                dotsBox.innerHTML='';
                for(var i=0;i<pages;i++){
                    var d=document.createElement('button');
                    d.type='button';
                    d.className='news-dot';
                    d.setAttribute('aria-label','Слайд '+(i+1));
                    (function(idx){d.addEventListener('click',function(){track.scrollTo({left:idx*s,behavior:'smooth'});});})(i);
                    dotsBox.appendChild(d);
                }
            }
            for(var j=0;j<dotsBox.children.length;j++){
                dotsBox.children[j].classList.toggle('is-active', j===current);
            }
        }
        prev.addEventListener('click',function(){track.scrollBy({left:-step(),behavior:'smooth'});});
        next.addEventListener('click',function(){track.scrollBy({left:step(),behavior:'smooth'});});
        track.addEventListener('scroll',updateNav,{passive:true});
        window.addEventListener('resize',updateNav);
        updateNav();
    })();
</script>
