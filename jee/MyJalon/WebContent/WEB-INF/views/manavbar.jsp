<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="/MyJalon/">TP3 - WebServ</a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">	  
	  <ul class="nav navbar-nav navbar-right" style="display:${sessionScope.user==null?'none':''}">
		<li><a href="#">Connecté en tant que : ${sessionScope.user.getName()}</a></li>
		<li><a href="/MyJalon/login/?logout=">Se déconnecter</a></li>
	  </ul>
	</div>
  </div>
</nav>
<div class="container" style="display:${errorMessage==null?'none':''}">
	<div id="alert" class="alert alert-danger col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<b>Oups !</b> ${errorMessage}
	</div>
</div>
<div class="container" style="display:${successMessage==null?'none':''}">
	<div id="alert" class="alert alert-success col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<b>Bravo !</b> ${successMessage}
	</div>
</div>
