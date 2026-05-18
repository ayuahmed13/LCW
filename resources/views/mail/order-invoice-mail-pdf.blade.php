<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tax Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; background-color: #fff;">

  <div style="width: 100%; max-width: 800px; margin: 0 auto; padding: 30px;">
    <p>
      Thank you for your recent order with {{ !empty($data['client_name']) ? $data['client_name'] : '' }},
      Please find your invoice details below:
    </p>
    <h2 style="margin-bottom: 10px;">Tax Invoice</h2>

    <!-- Order Summary -->
    <div style="background: #fff; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd;">
      <h3 style="margin-top: 0;">Order Summary</h3>
      <table style="width: 100%; border-collapse: collapse;">
        <tr>
          <th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Total Order Price Excl. GST ($)</th>
          <th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Delivery Charge ($)</th>
          <th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Total Payable ($)</th>
          <th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Net Paid ($)</th>
        </tr>
        <tr>
          <td style="padding: 8px; border: 1px solid #ddd;">${{ !empty($data['total_order_price_excluded_gst']) ? number_format($data['total_order_price_excluded_gst'], 2, '.', ',') : '-' }}</td>
          <td style="padding: 8px; border: 1px solid #ddd;">${{ !empty($data['delivery_charge']) ? number_format($data['delivery_charge'], 2, '.', ',') : '0.00' }}</td>
          <td style="padding: 8px; border: 1px solid #ddd;">${{ !empty($data['total_payable']) ? number_format($data['total_payable'], 2, '.', ',') : '-' }}</td>
          <td style="padding: 8px; border: 1px solid #ddd;">${{ !empty($data['net_paid']) ? number_format($data['net_paid'], 2, '.', ',') : '-' }}</td>
        </tr>
      </table>
    </div>

    <!-- Tax Invoice Details -->
    <div style="background: #fff; padding: 20px; border: 1px solid #ddd;">
      <h2 style="text-align: center;">Tax Invoice</h2>

      <table style="width: 100%; margin-bottom: 20px;">
        <tr>
          <td style="width: 50%; vertical-align: top;">
            @php
                $logoImagePath = App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path;
                $logoPath = asset('front/images/logo/LCW_logo.png');
                if (!empty($logoImagePath) && Storage::exists($logoImagePath)) {
                    $logoPath = url(Storage::url($logoImagePath));
                
                  } 
            @endphp

            <img src="{{ $logoPath }}" alt="" style="height: 100px; width: 150px;"><br>
            <strong>Sold By:</strong><br>
            {{ !empty($data['client_name'])?$data['client_name']:'' }}<br>
            {{ !empty($data['client_address'])?$data['client_address']:'' }}<br>
            Email: {{ !empty($data['client_email'])?$data['client_email']:'' }}<br>
            Customer Care: {{ !empty($data['client_helpline'])?$data['client_helpline']:'' }}<br><br>
            <strong>Order No:</strong> #{{ !empty($data['order_id'])?$data['order_id']:'' }}<br>
            <strong>Order Date:</strong> {{ !empty($data['order_date'])?$data['order_date']:'' }}
          </td>
          <td style="width: 50%; vertical-align: top;">
            <strong>Billing Address</strong><br>
            {{ $data['billing_address']['billing_address_first_name'].' '.$data['billing_address']['billing_address_last_name'] }}<br>
            {{ $data['billing_address']['billing_address_email'] }}<br>
            {{ $data['billing_address']['billing_address_street'] }}<br>

            {{ $data['billing_address']['billing_address_town_city'] }},
            {{ $data['billing_address']['billing_address_state'] }} - {{ $data['billing_address']['billing_address_postal_code'] }},<br>
            {{ $data['billing_address']['billing_address_country_region'] }}<br>
            
            {{ $data['billing_address']['billing_address_phone'] }}<br><br>

            @if(!empty($data['shipping_same_as_billing']) && $data['shipping_same_as_billing']=='yes')
            <span style="color: green;">Shipping address is same as billing address</span>
            @else
            <strong>Shipping Address</strong><br>
            {{ $data['shipping_address']['shipping_address_first_name'].' '.$data['shipping_address']['shipping_address_last_name'] }}<br>
            {{ $data['shipping_address']['shipping_address_email'] }}<br>
            {{ $data['shipping_address']['shipping_address_street'] }}<br>

            {{ $data['shipping_address']['shipping_address_town_city'] }},
            {{ $data['shipping_address']['shipping_address_state'] }} - {{ $data['shipping_address']['shipping_address_postal_code'] }},<br>
            {{ $data['shipping_address']['shipping_address_country_region'] }}<br>
            
            {{ $data['shipping_address']['shipping_address_phone'] }}
            @endif
          </td>
        </tr>
      </table>

      <h3>Product Details</h3>
      <table style="width: 100%; border-collapse: collapse;" border="1">
        <tr>
          <th style="padding: 5px;">Sr No.</th>
          <!-- <th style="padding: 5px;">Product Code</th> -->
          <th style="padding: 5px;">Name</th>
          <th style="padding: 5px;">HSN Code</th>
          <th style="padding: 5px;">Price</th>
          <th style="padding: 5px;">GST (%)</th>
          <th style="padding: 5px;">GST Amt ($)</th>
          <th style="padding: 5px;">Qty</th>
          <th style="padding: 5px;">Subtotal ($)</th>
        </tr>
        @if(!empty($data['ordered_products']))
        @foreach($data['ordered_products'] as $k => $value)
        <tr>
          <td style="padding: 5px;">{{ $k + 1 }}</td>
          <!-- <td style="padding: 5px;">{{ $value['product_id'] }}</td> -->
          <td style="padding: 5px;">{{ $value['product_name'] }}</td>
          <td style="padding: 5px;">-</td>
          <td style="padding: 5px;">${{ !empty($value['product_offer_price']) ? number_format($value['product_offer_price'], 2, '.', ',') : '0.00' }}</td>
          <td style="padding: 5px;">{{ !empty($value['product_tax_per']) ? $value['product_tax_per'] : '0' }}%</td>
          <td style="padding: 5px;">${{ !empty($value['product_tax_amount']) ? number_format($value['product_tax_amount'], 2, '.', ',') : '0.00' }}</td>
          <td style="padding: 5px;">{{ !empty($value['product_qty']) ? $value['product_qty'] : '0' }}</td>
          <td style="padding: 5px;">${{ !empty($value['product_total_amount']) ? number_format($value['product_total_amount'], 2, '.', ',') : '0.00' }}</td>
        </tr>
        @endforeach
        @endif
        <tr>
          <td colspan="7" style="text-align: right; padding: 5px;"><strong>Total</strong></td>
          <td style="padding: 5px;"><strong>${{ !empty($data['net_paid']) ? number_format($data['net_paid'], 2, '.', ',') : '-' }}</strong></td>
        </tr>
      </table>

      <br>

      <table style="width: 100%; margin-top: 20px;">
        <tr>
          <td style="width: 50%; vertical-align: top;">
            <p><strong>Payment Method:</strong> {{ !empty($data['payment_method']) ? $data['payment_method'] : '' }}</p>
            <p><strong>Beneficiary:</strong> {{ !empty($data['beneficiary']) ? $data['beneficiary'] : '' }}</p>
            <p><strong>Bank Name:</strong> {{ !empty($data['bank_name']) ? $data['bank_name'] : '' }}</p>
            <p><strong>BSB:</strong> {{ !empty($data['bsb']) ? $data['bsb'] : '' }}</p>
            <p><strong>Account No:</strong> {{ !empty($data['bank_account_number']) ? $data['bank_account_number'] : '' }}</p>
          </td>
          <td style="width: 50%; vertical-align: top;">
            <p><strong>Order Price Excl. GST:</strong> ${{ !empty($data['total_order_price_excluded_gst']) ? number_format($data['total_order_price_excluded_gst'], 2, '.', ',') : '-' }}</p>
            <p><strong>GST:</strong> ${{ !empty($data['tax_amount']) ? number_format($data['tax_amount'], 2, '.', ',') : '-' }}</p>
            <p><strong>Delivery Charge:</strong> ${{ !empty($data['delivery_charge']) ? number_format($data['delivery_charge'], 2, '.', ',') : '0.00' }}</p>
            <p><strong>Net Pay:</strong> ${{ !empty($data['net_paid']) ? number_format($data['net_paid'], 2, '.', ',') : '-' }}</p>
          </td>
        </tr>
      </table>

      <br><br>

      <table style="width: 100%;">
        <tr>
          <td style="width: 70%; vertical-align: top;">
            <h4 style="margin-bottom: 5px;"></h4>
            <ul style="padding-left: 20px; margin-top: 5px;">
             
            </ul>
          </td>
          <td style="width: 30%; text-align: right; vertical-align: top;">
            <p><strong>For {{ !empty($data['client_name']) ? $data['client_name'] : '' }}</strong></p>
            <img src="{{ $logoPath }}" alt="" style="height: 60px; width: 100px;"><br>
            <p><strong>Authorized Signatory</strong></p>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <p>
    If you have any questions about your order or need further assistance, feel free to reply to this email or contact us.
  </p>
  <p>
    Thanks again for choosing {{ !empty($data['client_name']) ? $data['client_name'] : '' }}!
  </p>

  <div style="text-align: center; padding: 10px; font-size: 12px; color: #666;">
    © 2024–2025 <span style="color: #0d6efd;">{{ !empty($data['client_name'])?$data['client_name']:'' }}</span>. All rights reserved.
  </div>          
</body>
</html>
