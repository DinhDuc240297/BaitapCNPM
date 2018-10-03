
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home.index') }}">Shop</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="{{ route('product.showcart') }}">
						<i class="fas fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
						<span class="badge">{{Session::has('cart') ? Session::get('cart')->totalQty:''}}</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fas fa-user"> </i> User Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ route('user.signin') }}">Sign In</a></li>
						<li><a href="{{ route('user.signup') }}">Sign Up</a></li>
						<li role="seperator" class="divider"></li>
						<li><a href="{{ route('user.logout') }}">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>