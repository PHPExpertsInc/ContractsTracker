<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of Available Contracts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <style>
body {
    padding: 30px;
}
h1 {
    margin-bottom: 40px;
}
.contract-actions {
    font-weight: bold;
}
    </style>
<script>
$(document).ready(function() {
});

</script>
</head>
<body>
    <h1>List of Available Contracts</h1>
@if (count($contracts) == 0 && count($activeContracts) == 0)
    <div class="alert alert-danger">
        <h3>No contracts are available</h3>
        <p>Please <a href="/contracts-tracker/admin/contract"><strong>upload</strong></a> and then prepare a contract first.</p>
    </div>
@else
    @if (count($activeContracts) >= 1)
        <h3>Active Contracts</h3>
        <ul>
        @foreach ($activeContracts as $contract)
            <li>
                <div>
                    <strong>{{ $contract->name }}:</strong> {{ $contract->description }}
                </div>
                <div class="contract-actions row col-md-4" style="background: #EAEAEA">
                    <div class="col-md-4"><a href="/contracts-tracker/admin/contract/{{ $contract->id }}">Edit</a></div>
                    <div class="col-md-4"><a href="/contracts-tracker/admin/available-contracts/{{ $contract->id }}">Deliver</a></div>
                    <div class="col-md-4"><a href="/contracts-tracker/admin/contract/{{ $contract->id }}">Track</a></div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif

    @if (count($contracts) >= 1)
        <h3>Inactive Contracts</h3>
        <ul>
        @foreach ($contracts as $contract)
            <li>
                <div>
                    <strong>{{ $contract->name }}:</strong> {{ $contract->description }}
                </div>
                <div class="contract-actions row col-md-4" style="background: #EAEAEA">
                    <div class="col-md-4"><a href="/contracts-tracker/admin/contract/{{ $contract->id }}">Edit</a></div>
                </div>
            </li>
        @endforeach
        </ul>
    @endif
@endif
</body>
</html>
