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
					<div class="panel-title">Créer un utilisateur</div>
				</div>     

				<div class="panel-body" >
					<form method="post" action="/MyJalon/createuser/">
						<div style="margin-bottom: 25px">
							Login :<br> <input type="text" class="form-control" name="login"
								placeholder="Entrez le login" value="${login}">
							 <span style="color: red;">${loginFieldMessage}</span>
						</div>
						<div style="margin-bottom: 25px">
							Mot de passe :<br> <input type="password" class="form-control" name="password"
								placeholder="Entrez le mot de passe" value="${password}">
							 <span style="color: red;">${passwordFieldMessage}</span>
						</div>
						<div style="margin-bottom: 25px">
							Prenom NOM :<br> <input type="text" class="form-control" name="name"
								placeholder="Entrez un Prenom et un NOM" value="${name}">
							 <span style="color: red;">${nameFieldMessage}</span>
						</div>
						
						<div style="margin-bottom: 25px">
							Droits :<br>
							<select class="form-control" name="usertype">
					            <c:forEach items="${usertypes}" var="utype">
					          		<option value="${utype}"${utype == usertype ? 'selected' : ''}>${utype}</option>
					        	</c:forEach>
					        </select>
							 <span style="color: red;">${userTypeFieldMessage}</span>
						</div>
					
						<div style="margin-top: 10px" class="form-group">
							<div class="col-sm-12 controls">
								<input style="margin-top: 10px;" type="submit" class="btn btn-success" value="Créer l'utilisateur">
							</div>
						</div>
					</form>			
				</div>                     
			</div>
		</div>
	</div>
	
	

</body>
</html>