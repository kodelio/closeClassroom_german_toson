package controllers;

import java.io.IOException;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import dao.UtilisateurDao;
import models.UserType;
import models.Utilisateur;


public class CreateUserController extends HttpServlet {
	private static final long serialVersionUID = 1L;
       

    public CreateUserController() {
        super();
    }

	
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession();
		Utilisateur user = (Utilisateur) session.getAttribute("user");
		if (user == null) {
			this.getServletContext().getRequestDispatcher("/login/").forward(request, response);
		} else {
			if(user.getUserType().equals(UserType.ADMIN))
			{
				request.setAttribute("usertypes", UserType.values());
				this.getServletContext().getRequestDispatcher("/WEB-INF/views/createUser.jsp").forward(request, response);
			}
			else 
			{
				request.setAttribute("errorMessage", "Vous devez être ADMIN pour créer un utilisateur");
				this.getServletContext().getRequestDispatcher("/").forward(request, response);
			}			
		}
	}


	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession();
		Utilisateur user = (Utilisateur) session.getAttribute("user");
		if(user == null)
		{
			this.getServletContext().getRequestDispatcher("/login/").forward(request, response);
		}
		else 
		{			
			if(user.getUserType().equals(UserType.ADMIN))
			{
				//TODO
				String login = request.getParameter("login");
				String password = request.getParameter("password");
				String name = request.getParameter("name");				
				String usertypeStr = request.getParameter("usertype");
				
								
				
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
				if(name.isEmpty())
				{
					request.setAttribute("nameFieldMessage", "Veuillez saisir un prenom et un nom");
					request.setAttribute("errorMessage", "Formulaire incomplet");
				}
				if(usertypeStr.isEmpty())
				{
					request.setAttribute("userTypeFieldMessage", "Veuillez saisir un droit utilisateur");
					request.setAttribute("errorMessage", "Formulaire incomplet");
				}
				
				if(!login.isEmpty() && !password.isEmpty() && !name.isEmpty() && !usertypeStr.isEmpty())
				{
					try {
						UserType usertype = UserType.valueOf(usertypeStr);
						UtilisateurDao.createUser(login, password, name, usertype);
						
						request.setAttribute("successMessage", "Utilisateur " + name + " créé avec succès");						
						this.getServletContext().getRequestDispatcher("/").forward(request, response);
											
					} catch (Exception e) {
						request.setAttribute("errorMessage", e.getMessage());
						request.setAttribute("login", login);
						request.setAttribute("password", password);
						request.setAttribute("name", name);
						request.setAttribute("usertypes", UserType.values());
						this.getServletContext().getRequestDispatcher("/WEB-INF/views/createUser.jsp").forward(request, response);
					}
				}
				else
				{
					request.setAttribute("login", login);
					request.setAttribute("password", password);
					request.setAttribute("name", name);
					request.setAttribute("usertypes", UserType.values());
					request.setAttribute("errorMessage", "Formulaire incomplet");
					this.getServletContext().getRequestDispatcher("/WEB-INF/views/createUser.jsp").forward(request, response);
				}
			}
			else 
			{
				request.setAttribute("errorMessage", "Vous devez être ADMIN pour créer un utilisateur");
				this.getServletContext().getRequestDispatcher("/").forward(request, response);
			}
		}		
	}

}
