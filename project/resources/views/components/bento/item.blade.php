@props(['span' => 1, 'rowSpan' => 1])
<div {{ $attributes->merge([
    'class' => 'relative bg-white dark:bg-slate-800 rounded-3xl p-6 md:p-8 border border-gray-100 dark:border-white/5 shadow-sm hover:shadow-md transition-all flex flex-col overflow-hidden ' .
    ($span == 2 ? 'md:col-span-2' : ($span == 3 ? 'md:col-span-3' : 'md:col-span-1')) . ' ' .
    ($rowSpan == 2 ? 'md:row-span-2' : '')
]) }}>
    {{ $slot }}
</div>
