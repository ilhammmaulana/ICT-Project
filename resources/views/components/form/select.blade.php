@props([
    'options' => [], // Array data untuk loop
    'valueKey' => 'id', // Key untuk nilai (value) dari opsi
    'displayKey' => 'name', // Key untuk menampilkan label
    'disabled' => false,
    'withicon' => false,
    'value' => '',
])

@php
    $withiconClasses = $withicon
        ? 'pl-11 pr-4 select select-bordered w-full py-2'
        : 'px-4 select select-bordered w-full py-2';
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        $withiconClasses .
        ' border-gray-400 rounded-md focus:border-gray-400 focus:ring 
        focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 
        dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1',
]) !!}>
    <option selected disabled>Pilih opsi</option>
    @foreach ($options as $option)
        <option value="{{ $option[$valueKey] }}" @if ($option[$valueKey] === $value) selected @endif>
            {{ $option[$displayKey] }}</option>
    @endforeach
</select>
