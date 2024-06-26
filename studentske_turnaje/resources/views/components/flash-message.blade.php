{{-- * FILENAME : flash-message.blade.php
*
* DESCRIPTION : Flash message
*
* AUTHOR : Dávid Kán - xkanda01 --}}

@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 left-0 transform-translate-x-1/2 bg-yellowish text-white px-44 py-3">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif