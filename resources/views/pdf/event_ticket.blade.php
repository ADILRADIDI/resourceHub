<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E0E0E0; /* Light grey background */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .ticket {
            background-color: #FFFFFF; /* White background */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            text-align: center;
        }
        .event-title {
            font-size: 26px;
            font-weight: bold;
            color: #444444;
            margin-bottom: 15px;
        }
        .user-name {
            font-size: 18px;
            color: #333333;
            margin: 10px 0;
        }
        .event-date-time {
            font-size: 18px;
            color: #666666;
            margin: 8px 0;
        }
        .event-location {
            font-size: 18px;
            color: #666666;
            margin: 8px 0;
        }
        .badge {
            background-color: #28A745; /* Green color */
            color: #FFFFFF;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="event-title">{{ $event->title }}</div>
        <div class="user-name">
            <strong>Your Name: {{ $user->name }}</strong>
        </div>
        <div class="event-date-time">
            {!! $formattedDateTime !!}
        </div>
        <div class="event-location">
            <strong>City:</strong> {{ $event->city }}<br>
            <strong>Location:</strong> {{ $event->location }}
        </div>
        <div class="badge">
            Registered
        </div>
    </div>
</body>
</html>
