<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script>
  d=document;w=window;c=console;

  // COOKIES HANDLING
  function createCookie(name,value,days){
    if(days){
      var date=new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires="; expires="+date.toUTCString();
    } else var expires="";
    d.cookie=name+"="+value+expires+"; path=/";
  }
  function readCookie  (n){var m=n+"=",a=d.cookie.split(';');for(var i=0;i<a.length;i++){var c=a[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.indexOf(m)==0)return c.substring(m.length,c.length);}}
  function eraseCookie (n){createCookie(n,"",-1)}
  </script>

</head>
<body>


<?php

$url = 'https://test.salesforce.com/your-salesforce-url';
$myvars = $_SESSION["vars"];

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch ); ?>


<div>
<?php var_dump($response); ?>
</div>

<script>




    
  const newLead = (info)=>{
		let first_name = info.fname;
		let last_name  = info.lname;
		let email      = info.email;
		let phone      = info.phone;
		let company    = info.company;
		let country    = info.country;
		let city       = info.city;
		let product    = info.code;
		let type       = info.type;
		let size       = info.size;
		let quantity   = info.quantity;
		let message    = info.message;

		let vars = '?first_name='+first_name+'&last_name='+last_name+'&email='+email+'&phone='+phone+'&company='+company+'&country='+country+'&city='+city+'&product='+product+'&type='+type+'&size='+size+'&quantity='+quantity+'&message='+message;

		let baseURL= 'https://silverseacontainers.com/testLead.php';
		
    let url = baseURL + vars;
    
    window.location.href = url;
	}





    if(readCookie('lastLead') == 'sent'){
      createCookie('allLeads', 'success');

    }else {
      let info        = JSON.parse(readCookie('info'))
      cartToLeads = JSON.parse(readCookie('cartToLeads'))
      
      let product = cartToLeads.shift();
      info.code     = product.code;
      info.type     = product.tipo_2;
      info.size     = product.size;
      info.quantity = product.qty;
      
      if(cartToLeads.length!=0){
        createCookie('cartToLeads', JSON.stringify(cartToLeads).split(';').join(':'));
        createCookie('lastLead', 'waiting');
      } else {
        createCookie('lastLead', 'sent');
      }
      console.log(info)
      createCookie('leadsSent', parseInt(readCookie('leadsSent')) + 1)
      newLead(info);
    }
</script>
</body>
</html>