@php
$method = $attributes->get('method', 'GET');
@endphp
<form  method="{{ in_array($method, ['GET', 'POST']) ? $method : 'POST' }}" 
        {{ $attributes->except('method')->merge(["class" => "max-w-2xl mx-auto space-y-6"]) }}> <!-- method defaults to get-->
        
        
        @if ($attributes->get('method', 'GET') !== 'GET') 
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>
