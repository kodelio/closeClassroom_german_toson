package controllers;

import java.io.IOException;
import java.sql.SQLException;
import java.util.Date;

import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import dao.UtilisateurDao;
import models.Utilisateur;


public class LoginController extends HttpServlet {
	private static final long serialVersionUID = 1L;
       

    public LoginController() {
        super();
    }


	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession();
		Cookie[] cookies = request.getCookies();
		if(request.getParameter("logout") != null)
		{	
			Cookie c = new Cookie("user", "");
			c.setMaxAge(0);
			response.addCookie(c);
			session.invalidate();
		}
		else if(session.getAttribute("user") != null)
		{			
			this.getServletContext().getRequestDispatcher("/WEB-INF/views/accueil.jsp").forward(request, response);
		}
		else if(cookies.length!=0)
		{
			for(Cookie c : cookies)
			{
				if(c.getName().equals("user") && !c.getValue().isEmpty() && (c.getMaxAge()==-1 || c.getMaxAge()>0))
				{
					Utilisateur user;					
					try {
						user = UtilisateurDao.loginByCookie(c.getValue());
						
						if(user == null)
						{
							request.setAttribute("errorMessage", "Erreur d'authentification par cookie");
							c.setMaxAge(0);
							c.setValue("");
							response.addCookie(c);
						} else {
							session = request.getSession();
							session.setAttribute("user", user);
							request.setAttribute("typeConnection", "Connecté par cookie");
							request.getServletContext().getRequestDispatcher("/WEB-INF/views/accueil.jsp").forward(request, response);
						}
					} catch (NumberFormatException | ClassNotFoundException | SQLException e) {
						request.setAttribute("errorMessage", e.getMessage());
					}
				}
			}
		}
		
		this.getServletContext().getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);
	}


	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession();
		if(session.getAttribute("user") != null)
		{
			this.getServletContext().getRequestDispatcher("/").forward(request, response);
		}
		
		String login = request.getParameter("login");
		String password = request.getParameter("password");
				
		if(login.isEmpty())
		{
			request.setAttribute("loginFieldMessage", "Veuillez saisir un login");
			request.setAttribute("errorMessage", "Formulaire incomplet");
		}
		if(password.isEmpty())
		{
			request.setAttribute("passwordFieldMessage", "Veuillez saisir un mot de passe");
			request.setAttribute("errorMessage", "Formulaire incomplet");
		}
		
		if(!login.isEmpty() && ! password.isEmpty())
		{
			
			Utilisateur user;
			try {
				user = UtilisateurDao.login(login, password);
				
				
				if(user == null)
				{
					request.setAttribute("errorMessage", "Utilisateur ou mot de passe incorrect");
				} else {
					session = request.getSession();
					session.setAttribute("user", user);
					Cookie c = new Cookie("user", login + "&" + password);
					c.setPath("/MyJalon/");
					c.setMaxAge(3600*24);
					response.addCookie(c);				
					request.setAttribute("typeConnection", "Connecté par login");
					request.getServletContext().getRequestDispatcher("/WEB-INF/views/accueil.jsp").forward(request, response);
				}
			} catch (NumberFormatException | ClassNotFoundException | SQLException e) {
				request.setAttribute("errorMessage", e.getMessage());
			}
		}
		
		request.setAttribute("login", login);
		request.setAttribute("password", password);		
		this.getServletContext().getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);
	}

}
