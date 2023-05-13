@props(['tags'])

@php
    $tags = explode(',', $tags);
@endphp

<ul class="grid grid-cols-3">
    @foreach ($tags as $tag)
    <li class="bg-black text-xs text-white rounded-xl px-3 py-1 m-2 border-2 border-black hover:border-red-500 hover:bg-gray-50 hover:text-red-500 hover:shadow-slate-800 duration-200 flex items-center justify-center capitalize">
        <a href="/?tag={{$tag}}">{{ $tag }}</a>
    </li>
    @endforeach
</ul>
