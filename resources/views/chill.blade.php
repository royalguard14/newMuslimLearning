<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Chillax Muna</title>
  <link rel="stylesheet" href="{{asset('css/style_chill.css')}}">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="workspace">

	<!-- ===============================================/*
	/*                    Clock                         /*
	/* =============================================== -->			
	<div class="clock">
	  <div class="top"></div>
	  <div class="right"></div>
	  <div class="bottom"></div>
	  <div class="left"></div>
	  <div class="center"></div>
	  <div class="hour"></div>
	  <div class="minute"></div>
	  <div class="second"></div>
	</div>


	<!-- ===============================================/*
	/*                    Shelf                         /*
	/* =============================================== -->
	<div id="shelf">
		<ul>
			<!-- iPad -->
			<li class="ipad"></li>
			<!-- Books -->
			<li class="books">
				<span></span>
				<span><i></i></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</li>
		</ul>
		<div></div>
	</div>
		

		<div class="desk">
			<!-- ===============================================/*
			/*                    Table                         /*
			/* =============================================== -->
			<div class="table">

				<div class="right-tb">
					<span></span>
					<span></span>
					<span></span>
				</div>
				
				<!-- ===============================================/*
				/*                    Mouse                         /*
				/* =============================================== -->
				<span class="mouse"></span>

				<!-- ===============================================/*
				/*                    Cup                           /*
				/* =============================================== -->
				<span class="cup"><i></i></span>
				
				<!-- ===============================================/*
				/*                    Router                        /*
				/* =============================================== -->
				<span class="router">
					<ul>
						<li><i></i></li>
						<li></li>
					</ul>
				</span>
				
				<!-- ===============================================/*
				/*                    iMac                          /*
				/* =============================================== -->
				<div class="imac">
					
					<img src="{{asset('assets/benefits-of-website-maintenance.jpg')}}" alt="">
					<!-- Note -->
					<span class="note">Zear!</span>
				</div>

				<!-- ===============================================/*
				/*                    Black Screen                  /*
				/* =============================================== -->
				<span class="bk-screen">
					<i></i>
				</span>

				<!-- ===============================================/*
				/*                      iPhone                      /*
				/* =============================================== -->
				<span class="iphone"></span>

			</div>
			
			<!-- ===============================================/*
			/*                      Chair                       /*
			/* =============================================== -->
			<div class="chair">
				<ul>
					<li></li>
					<li></li>
					<li></li>
				</ul>
				<i class="shadows"></i>
			</div>
			
			<!-- ===============================================/*
			/*                      Trash                       /*
			/* =============================================== -->
			<div class="trash"><i class="shadows"></i></div>
		
		</div>

</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="{{asset('js/script_chill.js')}}"></script>

</body>
</html>
