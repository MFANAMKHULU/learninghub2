import java.util.Scanner;  // Java code to read input from various sources, including the console.

public class DataValidation {   // must be the same as the header
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in); // type of data entered and assigning to scanner

        int age = getValidAge(scanner); // assign age to function 

        System.out.println("Valid age entered: " + age);

        scanner.close();
    }

   public static int getValidAge(Scanner scanner) {
    int age;

    while (true) {
        System.out.print("Enter your age: ");

        if (scanner.hasNextInt()) {
            age = scanner.nextInt();
            if (age > 0 && age <= 120) { // Adding a maximum age limit
                break;
            } else if (age <= 0) {
                System.out.println("Age can't be less than 0.");  
            } else {
                System.out.println("Age must be between 0 and 120.");
            }
        } else {
            System.out.println("Invalid Input.");
            scanner.next();  // clears invalid input
        }
    }

    return age;
   }
}