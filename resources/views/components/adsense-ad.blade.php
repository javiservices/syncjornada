@props(['slot' => 'auto', 'format' => 'auto', 'responsive' => true])

{{-- 
    Componente de Anuncio de Google AdSense
    
    Uso:
    <x-adsense-ad slot="1234567890" format="auto" />
    <x-adsense-ad slot="1234567890" format="horizontal" />
    <x-adsense-ad slot="1234567890" format="rectangle" />
    
    Nota: Reemplaza 'slot' con tu código de espacio publicitario de AdSense
--}}

<div class="my-4">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7518861337365197"
         data-ad-slot="{{ $slot }}"
         @if($format === 'auto')
         data-ad-format="{{ $format }}"
         @elseif($format === 'horizontal')
         data-ad-format="horizontal"
         data-ad-layout="in-article"
         @elseif($format === 'rectangle')
         data-ad-format="rectangle"
         @endif
         @if($responsive)
         data-full-width-responsive="true"
         @endif
    ></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
