@props(['padding' => 'py-2 px-6', 'radius' => 'rounded'])

<button {{ $attributes(['class' => "bg-blue-800 $radius $padding hover:bg-blue-700 cursor-pointer"]) }}>{{ $slot }}</button>
