package models;

public class Utilisateur {
	private int id;
	private String login;
	private String password;
	private String name;
	private UserType UserType;
	
	
	@SuppressWarnings("unused")
	private Utilisateur() {		
	}
	
	public Utilisateur(int id, String login, String password, String name, String userType) {
		this.id = id;
		this.login = login;
		this.password = password;
		this.name = name;
		this.UserType = models.UserType.valueOf(userType);
	}
	
	public Utilisateur(int id, String login, String password, String name, UserType userType) {
		this.id = id;
		this.login = login;
		this.password = password;
		this.name = name;
		this.UserType = userType;
	}
	
	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}
	
	public String getLogin() {
		return login;
	}
	
	public void setLogin(String login) {
		this.login = login;
	}
	
	public String getPassword() {
		return password;
	}
	
	public void setPassword(String password) {
		this.password = password;
	}
	
	public String getName() {
		return name;
	}
	
	public void setName(String name) {
		this.name = name;
	}
	
	public UserType getUserType() {
		return this.UserType;
	}
	
	public void setUserType(UserType userType) {
		this.UserType = userType;
	}
	
	public void setUserType(String userType) {
		this.UserType = models.UserType.valueOf(userType);
	}
}
