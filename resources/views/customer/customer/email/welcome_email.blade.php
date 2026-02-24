<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 12px;
            color: #6c757d;
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .description {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to {{ $company_name ?? 'LeadUp Pro' }}!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $customer_name ?? 'Valued Customer' }},</p>
        
        <div class="description">
            {!! $description !!}
        </div>
         
    </div>
     
</body>
</html>
