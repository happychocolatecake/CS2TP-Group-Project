<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmed</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; }
        .success-card { border: 1px solid #ddd; padding: 40px; border-radius: 8px; display: inline-block; background: #f9f9f9; }
        h1 { color: #4CAF50; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 4px;}
    </style>
</head>
<body>
    <div class="success-card">
        <h1>✅ Order Placed Successfully!</h1>
        <p>Thank you for shopping with us.</p>
        
        @if(session('order_total'))
            <p><strong>Total Paid:</strong> £{{ number_format(session('order_total'), 2) }}</p>
        @endif

        <p>A confirmation email has been sent to your inbox.</p>
        
        <a href="/" class="btn">Continue Shopping</a>
    </div>
</body>
</html>