
@props(['employer', 'width' => 90])

<img class="rounded-xl" width="{{ $width }}" alt="" src="{{ asset($employer->logo) }}">

