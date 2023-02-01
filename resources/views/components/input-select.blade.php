@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-300 focus:ring-opacity-25 placeholder-gray-500']) !!}>
{{$slot}}
</select>
