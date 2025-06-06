{{-- resources\views\mail\instructor-request-approved-mail.blade.php --}}
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
</head>

<body>

    <div class="content">

        <p>Hi there,</p>
        <p>Your instructor request has been approved. From now, you will be able to palish in our site.</p>
        <p>Please visit your dashboard, from here: <a href="{{ url('/instructor/dashboard') }}">Instructor Dashboard</a></p>
        <p>Good luck!</p>

    </div>

</body>

</html>
