import java.util.Scanner;

public class Gendervalidation {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Enter your identification number: ");
        long idNumber = scanner.nextLong();  //  reads (sequence of characters) as a long value from the input stream

        String gender = identifyGender(idNumber); // It calls the identifyGender method and passes the idNumber variable 

        if (gender != null) {
            System.out.println("The identified gender is: " + gender);
        } else {
            System.out.println("Invalid identification number.");
        }

        scanner.close();
    }
    public static String identifyGender(long idNumber) {
        if (idNumber > 0) {
            if (idNumber % 2 == 0) {
                return "Female";
            } else {
                return "Male";
            }
        }
        return null;
    }
    
}
