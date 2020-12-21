<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $contract->name }}: Sign and return</title>
</head>
<body>

    <p>Greetings!</p>

    <p>Please find the attached <strong>{{ $contract->name }}</strong>.</p>

    <p>Please <a href="{{ $signingURL }}">sign it</a> and send it back at your earliest convenience.</p>

    <br />
    <p>Thanks &amp; Regards</p>

    {{ $emailSender }}
</body>
</html>
