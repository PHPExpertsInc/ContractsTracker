<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$contractTitle}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
section.contract {
    padding: 20px 30px;
    border: 1px black solid;
    background: #F8F8F8;
    max-width: 42.5em;
    font-family: serif !important;;
    text-align: justify !important;
}
section.contract button {
    font-family: sans-serif;
}
    </style>
</head>
<body>
@if (!$foundContract)
    <div class="alert alert-danger">
        <h1>Missing Contract</h1>

        The contract with the ID <strong>"{{$contractId}}"</strong> could not be found.
    </div>
@else
    <header>
        <p>Hello,</p>
        <p>Please read and sign this contract as soon as possible.</p>
    </header>
    <section class="contract">
{!! $contractHTML !!}
        <button class="btn btn-primary">Sign and Submit</button>
    </section>
@endif
</body>
</html>
