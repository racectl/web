@if($showLeaveTeam)
<div class="col-xl-6">
    <button onclick="confirmLeaveTeam()" class="btn btn-warning btn-block">Leave Team (NP)</button>
</div>
@endif

<div class="col-xl-{{ $width }}">
    <button onclick="confirmWithdrawTeam()" class="btn btn-danger btn-block">Withdraw Team (NP)</button>
</div>
