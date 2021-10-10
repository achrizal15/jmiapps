@if ($sts=="error"||$sts=="reject"||$sts=="broken")
<div class="flex items-center">
    <i class="fas fa-circle text-red-500 mr-2"></i>
    {{ $sts}}
</div>
@elseif($sts=="pending")
<div class="flex items-center">
    <i class="fas fa-circle text-yellow-500 mr-2"></i>
    {{$sts}}
</div>
@else
<div class="flex items-center">
    <i class="fas fa-circle text-green-500 mr-2"></i>
    {{$sts}}
</div>
@endif
