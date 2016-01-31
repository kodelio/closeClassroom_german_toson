package dao;

import java.sql.DriverManager;
import java.sql.SQLException;


public class BddDao {

	public static java.sql.Connection connect() throws SQLException, ClassNotFoundException {		
		Class.forName( "com.mysql.jdbc.Driver" );	
		return DriverManager.getConnection("jdbc:mysql://localhost:3306/german_toson_webserv","root","");
	}
}