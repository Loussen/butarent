@extends('layouts.myapp')

@section('title', $page->title() . ' | ' . config('seo.site_name', config('app.name')))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($page->body()), 160))
@section('canonical', url()->current())

@section('content')
    <div class="mx-auto my-8 flex max-w-screen-xl flex-col items-center justify-center gap-12 px-4">
        <img src="/images/logos/LOGO.png" alt="{{ config('app.name') }}" class="w-[150px]">
        <h1 class="text-center text-4xl font-medium md:text-5xl">{{ $page->title() }}</h1>
        <div class="prose prose-gray w-full max-w-3xl text-start [&_h3]:mb-2 [&_h3]:mt-6 [&_h3]:text-xl [&_h3]:font-medium [&_p]:mb-4 [&_p]:leading-relaxed">
            {!! $page->body() !!}
        </div>
    </div>
@endsection
