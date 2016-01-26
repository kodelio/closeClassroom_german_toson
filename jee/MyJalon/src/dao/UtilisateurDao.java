package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import org.omg.IOP.ExceptionDetailMessage;

import models.UserType;
import models.Utilisateur;

public class UtilisateurDao {

	public static Utilisateur login(String login, String password) throws NumberFormatException, SQLException, ClassNotFoundException {
		
		Connection connection = BddDao.connect();
		Statement statement = connection.createStatement();
		ResultSet result = statement.executeQuery("select * from utilisateur where login = '" + login + "' and password = '" + password + "'");
		if(result.next()) {
			int userId = Integer.parseInt(result.getString("id"));
			String userLogin = result.getString("login");
			String userPassword = result.getString("password");
			String userName = result.getString("name");
			String userUserType = result.getString("usertype");
			Utilisateur user = new Utilisateur(userId, userLogin, userPassword, userName, userUserType);
			
			result.close();
			statement.close();
			connection.close();
			
			return user;
		}	
		result.close();
		statement.close();
		connection.close();
		
		return null;
	}

	public static Utilisateur loginByCookie(String value) throws NumberFormatException, ClassNotFoundException, SQLException {
		String login = value.substring(0,value.indexOf("&"));
		String password = value.substring(value.indexOf("&")+1,value.length());
		return UtilisateurDao.login(login,password);
	}

	public static void createUser(String login, String password, String name, UserType usertype) throws Exception {
		Connection connection = BddDao.connect();
		Statement statement = connection.createStatement();
		ResultSet result = statement.executeQuery("select * from utilisateur where login = '" + login + "'");
		if(result.next()) {
			Exception e = new Exception("Ce login existe déjà");
			result.close();
			statement.close();
			connection.close();
			throw e;			
		}
		else
		{
			result.close();
			statement.close();
			statement = connection.createStatement();
			int update = statement.executeUpdate("INSERT INTO utilisateur (login, password, name, usertype) VALUES ('" + login + "', '" + password + "', '" + name + "', '" + usertype.toString() + "');");
			statement.close();
			connection.close();
		}
	}
	
}
