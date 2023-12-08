<!doctype html>
<html lang="en" class="light-theme">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Synrok - Mobile HTML Template</title>

    <!--CSS Files-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/style_frame_mobile.css') }}" rel="stylesheet" />

  </head>
  <body>


	<div class="smartphone mt-2">
	  <div class="content">
		<iframe src="{{route('home')}}" style="width:100%;border:none;height:100%"></iframe>
	  </div>
	</div>
	
	<div class=" rounded-3 position-fixed end-0 pt-5 top-0 me-3">
	  <div class="">
	    <img src="{{asset('assets/images/avatars/qr_code.png')}}" class="rounded-3 " width="150" alt=""/>
	  </div>
	  <p class=" m-auto py-3 bg-transparent">Scannez le qr-code pour acceder au site <br> depuis votre mobile</p>
	</div>
	
	
  </body>
</html>