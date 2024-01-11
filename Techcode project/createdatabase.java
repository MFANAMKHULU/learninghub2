import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;

public class CreateDatabase {

    public static void main(String[] args) {
        String jdbcUrl = "localhost";
        String username = "root";
        String password = "";
        String databaseName = "employee_database";

        try (Connection connection = DriverManager.getConnection(jdbcUrl, username, password)) {
            Statement statement = connection.createStatement();
            String sql = "CREATE DATABASE " + databaseName;
            statement.executeUpdate(sql);
            System.out.println("Database created successfully.");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
