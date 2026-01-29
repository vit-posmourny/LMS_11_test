<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
</head>
<body>
    <div class="content">
        <p>Name: {{ $validateData['name'] }}</p>
        <p>Email: {{ $validateData['email'] }}</p>
        <p>Subject: {{ $validateData['subject'] }}</p>
        <p>Message: {{ $validateData['message'] }}</p>
    </div>
</body>

</html>
