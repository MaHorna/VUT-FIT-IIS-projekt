{{-- * FILENAME : card.blade.php
*
* DESCRIPTION : Utility
*
* AUTHOR : Dávid Kán - xkanda01 --}}

<div {{$attributes->merge(['class' => 'bg-black border border-gray-200 rounded p-6'])}}>
    {{$slot}}
</div>