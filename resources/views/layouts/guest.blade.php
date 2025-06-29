@props(['title', 'className'])

<x-base-layout :$title :$className>
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="/">
                            <img src="/img/logoipsum-265.svg" alt="" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">{{ $title }}</h1>

                    {{ $slot }}

                    <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                        <x-google-button />
                        <x-fb-button />
                    </div>
                    {{ $footerLinks }}
                </div>
                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
    </main>
</x-base-layout>
