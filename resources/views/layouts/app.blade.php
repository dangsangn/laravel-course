@props(['title'=> ''])

<x-base-layout  :$title>
   <x-layout.header />
   {{ $slot }}
   <x-layout.footer />
</x-base-layout>

4:08