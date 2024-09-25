<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Registering</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F8F9FA;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #007BFF; /* Main color */
            color: #FFFFFF;
            border-radius: 8px 8px 0 0; /* Rounded corners */
        }
        .header .logo {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .content {
            padding: 20px 0;
            line-height: 1.6;
        }
        .content p {
            font-size: 16px;
            margin: 10px 0;
        }
        .content .highlight {
            font-weight: bold;
            color: #007BFF; /* Highlight color */
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            color: #666666;
            border-top: 1px solid #EEEEEE;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #007BFF; /* Link color */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                RDEV
            </div>
        </div>
        <div class="content">
            <p>Dear <span class="highlight">{{ $user->name }}</span>,</p>
            <p>Thank you for registering for the <span class="highlight">{{ $event->title }}</span>. We're thrilled to have you with us!</p>
            <p>Your event ticket is attached to this email. Please bring it with you on the day of the event.</p>
            <p>If you have any questions or need further assistance, feel free to reach out to us at any time.</p>
            <p>We look forward to welcoming you!</p>
        </div>
        <div class="footer">
            <p>Best regards,</p>
            <p>Your Event Team</p>
            <p><a href="mailto:support@event.com">support@event.com</a> | <a href="#">Visit our Website</a></p>
        </div>
    </div>
</body>
</html>
