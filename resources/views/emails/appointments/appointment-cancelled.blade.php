<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Cancelled</title>
</head>
<body>
<h1>Dear {{ $patientName }},</h1>
<p>Your appointment scheduled for {{ $appointmentDate }} at {{ $appointmentTime }} has been cancelled.</p>
<p>If you have any questions, please contact us.</p>
<p>Best regards,</p>
<p>Your Healthcare Team</p>
</body>
</html>
