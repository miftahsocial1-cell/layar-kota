@php($studioPoster = str_starts_with($film->poster, 'studio/'))
<div @class(['poster', 'poster--artwork' => !$studioPoster]) aria-hidden="true">
    <img src="{{ asset('posters/'.$film->poster.'.webp') }}" width="640" height="960" alt="" loading="lazy" decoding="async">
    @unless ($studioPoster)
        <span class="poster-title">{{ $film->title }}</span>
    @endunless
</div>
