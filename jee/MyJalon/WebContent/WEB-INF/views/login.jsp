<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>    
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>MyJalon | Connection</title>
<link type="text/css" rel="stylesheet" href="/MyJalon/css/bootstrapM.css" />
</head>
<body>
	<%@ include file="/WEB-INF/views/manavbar.jsp" %>
	<%@ include file="/WEB-INF/views/footer.jsp" %>
	
	
	<div class="container">
		<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">Connexion</div>
				</div>

				<div style="padding-top: 30px" class="panel-body">
					<form method="post" action="/MyJalon/login/">
						<div style="margin-bottom: 25px">
							Login :<br> <input type="text" class="form-control" name="login"
								placeholder="Entrez le login" value="${login}">
							 <span style="color: red;">${loginFieldMessage}</span>
						</div>
						<div style="margin-bottom: 25px">
							Password :<br> <input type="password" class="form-control" name="password"
								placeholder="Entrez le mot de passe" value="${password}">
							 <span style="color: red;">${passwordFieldMessage}</span>
						</div>
					
						<div style="margin-top: 10px" class="form-group">
							<div class="col-sm-12 controls">
								<input style="margin-top: 10px;" type="submit" class="btn btn-success" value="Connexion">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	
</body>
</html>