<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PDF</title>
    <link rel="stylesheet" type="text/css" href="css\pdf.css">
</head>
<body>     
            <div><center><img src="1.png" width="340" height="330"></center></div>
            <div><p>Диплома</p></div>
            <h3>за успешно положени финални квиз, полазнику</h3>
            <h1>{{$user_name}}</h1>
           <div><h5> Дана: {{\Carbon\Carbon::parse($date)->format('d.m.Y')}}</h5></div>            
</body>
</html>