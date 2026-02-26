@props([
     'title' => null,
 ])
 
 @include('layouts.app', [
     'title' => 'FHDYO',
     'nav' => $title,
     'slot' => $slot,
 ])
