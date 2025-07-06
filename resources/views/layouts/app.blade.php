@props(['title'=> '', 'className'=> ''])

<x-base-layout  :$title :$className>
   <x-layout.header />
   {{ $slot }}
   <x-layout.footer />
</x-base-layout>