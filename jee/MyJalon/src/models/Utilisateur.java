package models;

public class Utilisateur {
	private int id;
	private UserType UserType;
	private String login;
	private String password;
	private String email;
	private String name;
	private String first_name;
	
	
	
	@SuppressWarnings("unused")
	private Utilisateur() {		
	}
	
	public Utilisateur(int id, String userType, String login, String password, String email, String name, String first_name) {
		this.id = id;
		this.UserType = models.UserType.valueOf(userType);
		this.login = login;
		this.password = password;
		this.email = email;
		this.name = name;
		this.first_name = first_name;		
	}
	
	public Utilisateur(int id, UserType userType, String login, String password, String email, String name, String first_name) {
		this.id = id;
		this.UserType = userType;
		this.login = login;
		this.password = password;
		this.email = email;
		this.name = name;
		this.first_name = first_name;		
	}
	
	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
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
	
	public String getEmail() {
		return email;
	}
	
	public void setEmail(String email) {
		this.email = email;
	}
	
	public String getName() {
		return name;
	}
	
	public void setName(String name) {
		this.name = name;
	}
	
	public String getFirst_name() {
		return first_name;
	}
	
	public void setFirst_name(String first_name) {
		this.first_name = first_name;
	}
}
