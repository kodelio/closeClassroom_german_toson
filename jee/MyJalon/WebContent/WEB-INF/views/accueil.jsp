<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>MyJalon | Accueil</title>
<%@ include file="/WEB-INF/links.jsp" %>
</head>
<body>
	<%@ include file="/WEB-INF/views/manavbar.jsp" %>
	<%@ include file="/WEB-INF/views/footer.jsp" %>
	
	
	<div class="container">    
		<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
			<div class="panel panel-primary" >
				<div class="panel-heading">
					<div class="panel-title">Informations</div>
				</div>     

				<div class="panel-body" >
					Nom d'utilisateur : <b> ${sessionScope.user.getName() } </b>    
					<br>
					Type de compte : <b> ${sessionScope.user.getUserType() } </b>	
					<br>
					${typeConnection}
					<br>
					<button onclick="window.location.href='/MyJalon/createuser/'">Créer un utilisateur</button>				
				</div>                     
			</div>
		</div>
	</div>
	
	

</body>
</html>