 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,700i,800,800i&display=swap" rel="stylesheet">
<div style="max-width: 500px; border:5px solid #da5757; padding: 15px; margin: auto; border-radius: 10px; font-family: 'Open Sans', sans-serif;" >
	<p style="padding-bottom: 30px;">
		Dear Admin,
	</p>
	<p style="margin-bottom: 30px;">
		Yo have new order request from the website. <br>
		The follwoing is the order detail:
	</p>
	<p style="color: blue; font-size: 20px; font-size: 20px;">Customer Full Name: <span>{{$order_data['name']}}</span></p>
    <strong style="color: blue; font-size: 20px;">Customer email : </strong> {{$order_data['email']}}
    <p><strong> Customer Phone</strong>: {{$order_data['phone']}}</p>
    <p><strong> Ordered Location</strong>: {{$order_data['location']}}</p>
    <p><strong> Ordered product</strong>: {{$order_data['title']}}</p>
    <p><strong> Ordered product Price(After Discount)</strong>: $ {{$order_data['amount']}}</p>
	<p><strong> Ordered Discount</strong>: {{$order_data['discount']}}% </p>
	<p><strong>Order Id : </strong> {{$order_data['order_id']}}</p>
	<p style="color: blue; font-size: 20px;">Message: </p> 
	<p style="color: darkblue; font-size: 18px; text-align: justify; border: 1px solid red; padding:15px; width: auto;">
		{{$order_data['message']}} 
	</p>
	<p> Regards,</p>
	<p>System</p>
	<strong>Note:</strong> Do not reply to this email.
	
</div>