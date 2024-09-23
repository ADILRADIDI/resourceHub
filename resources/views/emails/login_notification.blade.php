<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F4F4F4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007BFF;
            padding: 20px;
            text-align: center;
            color: #FFFFFF;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .content h1 {
            font-size: 22px;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            background-color: #007BFF;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-size: 16px;
        }
        .footer {
            background-color: #F8F9FA;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666666;
            border-top: 1px solid #EEEEEE;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .text{
            color:white;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>RDEV</h1>
        </div>
        <div class="content">
            <h1>Hello, {{ $user->name }}</h1>
            <p>You have successfully logged in to your account.</p>
            <p>If this wasn't you, please contact support immediately.</p>
            <a href="#" class="button" class="text">Go to Dashboard</a>
        </div>
        <div class="footer">
            <p>Best regards,</p>
            <p>The RDEV Team</p>
            <p><a href="mailto:support@RDEV.com">support@RDEV.com</a> | <a href="#">Visit our Website</a></p>
        </div>
    </div>
</body>
</html>
