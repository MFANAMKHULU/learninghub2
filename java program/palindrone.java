import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class palindrone {
    private static List<String> history = new ArrayList<>();

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Enter a word or number: ");
        String input = scanner.nextLine();

        boolean isPalindrome = isPalindrome(input);
        history.add(input + " is " + (isPalindrome ? "a palindrome" : "not a palindrome"));

        System.out.println(history.get(history.size() - 1));

        scanner.close();
    }

    // Function to check if a string is a palindrome
    public static boolean isPalindrome(String str) {
        String normalized = normalize(str);
        int length = normalized.length();
        for (int i = 0; i < length / 2; i++) {
            if (normalized.charAt(i) != normalized.charAt(length - i - 1)) {
                return false;
            }
        }
        return true;
    }

    // Function to check if a number is a palindrome
    public static boolean isNumberPalindrome(int num) {
        String numStr = String.valueOf(num);
        return isPalindrome(numStr);
    }

    // Function to remove spaces and convert to lowercase for comparison
    public static String normalize(String str) {
        return str.replaceAll("\\s+", "").toLowerCase();
    }

    // Function to count palindromic words
    public static int countPalindromesInInput(String input) {
        String[] words = input.split("\\s+");
        int count = 0;

        for (String word : words) {
            if (isPalindrome(word)) {
                count++;
            }
        }
        return count;
    }
}
