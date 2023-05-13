@if (session()->has('message'))
    <div class="bg-red-500 text-white text-sm py-3 px-20 fixed top-0 left-1/2 transform -translate-x-1/2" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        <p class="capitalize">{{ session('message') }}</p>
    </div>
@endif

@if (session()->has('error'))

    <div class="bg-red-500 text-white text-sm py-3 px-20 fixed top-0 left-1/2 transform -translate-x-1/2" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        <p class="capitalize">{{ session('error') }}</p>
    </div>

@endif

