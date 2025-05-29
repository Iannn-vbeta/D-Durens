@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full sm:w-64 md:w-80 lg:w-[30rem]' .
            ($disabled ? ' bg-gray-100 cursor-not-allowed' : ''),
    ]) }}>
