<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[minmax(180px,auto)]']) }}>
    {{ $slot }}
</div>
