<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>About project</title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}" />
    <script type="text/javascript" src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <style type="text/css">
    	@font-face {
    		font-family: myFont;
    		src: url(/fonts/RBNo2Light.otf);
    	}
    	.founder {
    		padding: 50px;
    		position: absolute;
    	}
    	.bg {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			background: url(/images/bg2.jpg) no-repeat;
			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			filter: blur(10px);
    	}
    	body {
    		background: #222;
    		color: #fff;
    		font-family: myFont;
    		text-shadow: 1px 1px 3px rgba(0,0,0,0.15);
    	}

    	.sec {
    		font-size: 36px;
    		cursor: pointer;
    		padding: 10px 20px;
    		margin-bottom: 1px;
    		background: rgba(255,255,255,0.1);
    		transition: all 0.2s ease;
    		-webkit-transition: all 0.2s ease;
    	}

    	.sec:hover, .sec:hover ~ p {
			background: rgba(255,255,255,0.3);
    	}

    	.sec ~ p {
    		display: none;
    		font-size: 24px;
    		padding: 10px;
    		background: rgba(255,255,255,0.1);
    		margin-top: -1px;
    	}
    </style>
</head>
<body>

<div class="bg"></div>
<article class="container founder">
	<div class="row">
		<div class="col-sm-6">
			<div class="sec">Author</div>
			<p>
				- Name: Phạm Ngọc Phú<br/>
				- Email: phumaster.dev@gmail.com
			</p>
			<div class="sec">Why do I create it?</div>
			<p>
				- Learn Laravel Framework<br/>
				- Upgrade my skill<br/>
				- Create a social network same Instagram<br/>
				- Relax
			</p>
			<div class="sec">Something not good</div>
			<p>
				- Notifications, friends request, messages not really realtime<br/>
				- Not construct infinite loading for news feed<br/>
				- feeling not good, everything need repair
			</p>
			<div class="sec">Technologies</div>
			<p>
				- PHP Laravel Framework 5.1<br/>
				- Font awesome<br/>
				- Bootstrap<br/>
				- Jquery<br/>
				- Ajax<br/>
				- Code on: Sublime text, Atom
			</p>
		</div>
	</div>
</article>
<script type="text/javascript">
	$(document).ready(function() {
		$('.sec').click(function() {
			if($(this).next().is(':hidden')) {
				$('.sec ~ p').slideUp(300);
				$(this).next().slideDown(300);
			}
		});
	});
</script>
</body>
</html>