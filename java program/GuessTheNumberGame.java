import java.util.Random;
import java.util.Scanner;

public class GuessTheNumberGame {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        Random random = new Random();

        int secretNumber = random.nextInt(100) + 1;
        int attempts = 0;
        boolean guessedCorrectly = false;

        System.out.println("Welcome to Guess the Number Game!");
        System.out.println("I have chosen a number between 1 and 100. Try to guess it.");

        while (attempts < 5) {
            System.out.print("Enter your guess: ");
            int userGuess = scanner.nextInt();

            if (userGuess < secretNumber) {
                System.out.println("Too low! Try again.");
            } else if (userGuess > secretNumber) {
                System.out.println("Too high! Try again.");
            } else {
                guessedCorrectly = true;
                break;
            }

            attempts++;
        }

        if (guessedCorrectly) {
            System.out.println("Congratulations! You guessed the number in " + (attempts + 1) + " attempts.");
        } else {
            System.out.println("Sorry, you've used all your attempts. The number was " + secretNumber + ".");
        }

        scanner.close(); // Close the scanner when done.
    }
}
