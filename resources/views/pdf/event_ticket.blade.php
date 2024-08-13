<!DOCTYPE html>
<html>
<head>
    <title>Event Ticket</title>
    <style>
        /* Add any custom styles for the PDF */
    </style>
</head>
<body>
    <h1>Event Ticket</h1>
    <p>Event: {{ $event->title }}</p>
    <p>Date: {{ $event->start_date }} to {{ $event->end_date }}</p>
    <p>Location: {{ $event->location }}</p>
    <p>User: {{ $user }}</p>
    <p>Status: Registered</p>
</body>
</html>
