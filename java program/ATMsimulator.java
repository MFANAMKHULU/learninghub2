import java.util.Scanner;

public class ATMsimulator {
    private static double balance = 1000; // Initial balance
    private static int pin = 1234; // Default PIN

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Enter your PIN: ");
        int enteredPin = scanner.nextInt();

        if (enteredPin == pin) {

            while (true) {
                System.out.println("Welcome to the ATM");
                System.out.println("1. Check Balance");
                System.out.println("2. Deposit");
                System.out.println("3. Withdraw");
                System.out.println("4. Quit");
                System.out.println("5. Change PIN ");
                System.out.println("6. Transfer funds");

                System.out.print("Enter your choice: ");

                int choice = scanner.nextInt();

                switch (choice) {
                    case 1:
                        checkBalance();
                        break;
                    case 2:
                        deposit(scanner);
                        break;
                    case 3:
                        withdraw(scanner);
                        break;
                    case 4:
                        System.out.println("Thank you for using the ATM. Goodbye!");
                        System.exit(0);
                        break;
                    case 5:
                        changePIN(scanner);
                        break;
                    case 6:
                         transferFunds(scanner);
                         break;    
                    default:
                        System.out.println("Invalid choice. Please try again.");
                }
            }
        } else {
            // Incorrect PIN
            System.out.println("Incorrect PIN. Please try again.");
        }
        scanner.close();
    }

    public static void checkBalance() {
        System.out.println("Your balance is $" + balance);
    }

    public static void deposit(Scanner scanner) {
        System.out.print("Enter amount to deposit: ");
        double amount = scanner.nextDouble();
        if (amount <= 0) {
            System.out.println("Invalid amount. Please enter a positive value.");
            return;
        }
        balance += amount;
        System.out.println("$" + amount + " deposited successfully. Your new balance is $" + balance);
    }

    public static void withdraw(Scanner scanner) {
        System.out.print("Enter amount to withdraw: ");
        double amount = scanner.nextDouble();
        if (amount <= 0 || amount > balance) {
            System.out.println("Invalid amount. Please enter a positive value and ensure you have sufficient balance.");
            return;
        }
        balance -= amount;
        System.out.println("$" + amount + " withdrawn successfully. Your new balance is $" + balance);
    }

    public static void changePIN(Scanner scanner) {
        System.out.print("Enter your new PIN: ");
        int newPIN = scanner.nextInt();
        // In a real application, you would store the new PIN securely, not just print it.
        pin = newPIN;
        System.out.println("PIN changed successfully.");
    }

    public static void transferFunds(Scanner scanner) {
        System.out.print("Enter recipient's account number: ");
        String recipientAccount = scanner.next();
        System.out.print("Enter amount to transfer: ");
        double amount = scanner.nextDouble();
        if (amount <= 0 || amount > balance) {
            System.out.println("Invalid amount. Please enter a positive value and ensure you have sufficient balance.");
            return;
        }
        balance -= amount;
        System.out.println("$" + amount + " transferred to account " + recipientAccount + " successfully.");
    }
    
}
