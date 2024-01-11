import java.util.Scanner;

public class Calculator {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (true) {
            System.out.println("1. Addition");
            System.out.println("2. Subtraction");
            System.out.println("3. Multiplication");
            System.out.println("4. Division");
            System.out.println("5. Quit");
            System.out.println("6. Exponentiation");
            System.out.println("7. Square Root");
            System.out.println("8. Modulus");
            System.out.println("9. Sine");
            System.out.println("10. Cosine");
            System.out.println("11. Tangent");

            System.out.print("Enter your choice (1/2/3/4/5/6/7/8/9/10/11): ");
            int choice = scanner.nextInt();

            if (choice == 5) {
                System.out.println("Exiting the calculator.");
                break;
            }

            System.out.print("Enter number: ");
            double num1 = scanner.nextDouble();

            double num2 = 0; // Initialize num2

            if (choice != 7 && choice != 9 && choice != 10 && choice != 11) {
                System.out.print("Enter number: ");
                num2 = scanner.nextDouble();
            }

            double result = performOperation(choice, num1, num2);

            if (result != Double.MIN_VALUE) {
                System.out.println("Result: " + result);
            }

            System.out.println();
        }

        scanner.close();
    }

    public static double performOperation(int choice, double num1, double num2) {
        switch (choice) {
            case 1:
                return num1 + num2;
            case 2:
                return num1 - num2;
            case 3:
                return num1 * num2;
            case 4:
                if (num2 != 0) {
                    return num1 / num2;
                } else {
                    System.out.println("Error: Division by zero");
                    return Double.MIN_VALUE;
                }
            case 6:
                return Math.pow(num1, num2);
            case 7:
                if (num1 >= 0) {
                    return Math.sqrt(num1);
                } else {
                    System.out.println("Error: Cannot calculate square root of a negative number");
                    return Double.MIN_VALUE;
                }
            case 8:
                return num1 % num2;
            case 9:
                return Math.sin(num1);
            case 10:
                return Math.cos(num1);
            case 11:
                return Math.tan(num1);
            default:
                System.out.println("Invalid choice");
                return Double.MIN_VALUE;
        }
    }
}
