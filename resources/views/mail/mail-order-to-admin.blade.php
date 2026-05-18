<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Details</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 40px; background-color: #f9f9f9;">

  <div style="max-width: 800px; margin: auto; background-color: #fff; border: 1px solid #ccc; padding: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    
    <h1 style="text-align: center;">New Order Received</h1>

    <div style="margin-bottom: 30px;">
      <h2>Order Summary</h2>
      <p><strong>Order ID:</strong> #{{ !empty($data['order_id'])?$data['order_id']:'' }}</p>
      <p><strong>Date:</strong> {{ !empty($data['order_date'])?$data['order_date']:'' }}</p>
      <p><strong>Status:</strong> {{ !empty($data['order_status'])?$data['order_status']:'' }}</p>
    </div>

  </div>
  
</body>
</html>
