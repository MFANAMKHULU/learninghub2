import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MonthlyExpensesGUI extends JFrame {

    private MonthlyExpensesCalculator calculator;

    private JTextField salaryField;
    private JTextField rentField;
    private JTextField utilitiesField;
    private JTextField groceriesField;
    private JTextField transportationField;
    private JTextField entertainmentField;

    public MonthlyExpensesGUI() {
        setTitle("Monthly Expenses Calculator");
        setSize(400, 300);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        calculator = new MonthlyExpensesCalculator();

        initUI();
    }

    private void initUI() {
        JPanel panel = new JPanel();
        panel.setLayout(new SpringLayout());

        // Add components to the panel
        panel.add(new JLabel("Salary: $"));
        salaryField = new JTextField(10);
        panel.add(salaryField);

        panel.add(new JLabel("Rent: $"));
        rentField = new JTextField(10);
        panel.add(rentField);

        panel.add(new JLabel("Utilities: $"));
        utilitiesField = new JTextField(10);
        panel.add(utilitiesField);

        panel.add(new JLabel("Groceries: $"));
        groceriesField = new JTextField(10);
        panel.add(groceriesField);

        panel.add(new JLabel("Transportation: $"));
        transportationField = new JTextField(10);
        panel.add(transportationField);

        panel.add(new JLabel("Entertainment: $"));
        entertainmentField = new JTextField(10);
        panel.add(entertainmentField);

        JButton calculateButton = new JButton("Calculate");
        calculateButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                calculateExpenses();
            }
        });
        panel.add(calculateButton);

        // Adjust layout
        SpringUtilities.makeCompactGrid(panel, 7, 2, 10, 10, 10, 10);

        // Add panel to the frame
        add(panel);
    }

    private void calculateExpenses() {
        try {
            // Validate input for empty fields
            if (isEmptyField(salaryField) || isEmptyField(rentField) || isEmptyField(utilitiesField) ||
                    isEmptyField(groceriesField) || isEmptyField(transportationField) || isEmptyField(entertainmentField)) {
                throw new NumberFormatException();
            }

            double salary = validateInput(salaryField);
            double rent = validateInput(rentField);
            double utilities = validateInput(utilitiesField);
            double groceries = validateInput(groceriesField);
            double transportation = validateInput(transportationField);
            double entertainment = validateInput(entertainmentField);

            // Set values in the calculator
            calculator.setSalary(salary);
            calculator.setRent(rent);
            calculator.setUtilities(utilities);
            calculator.setGroceries(groceries);
            calculator.setTransportation(transportation);
            calculator.setEntertainment(entertainment);

            // Calculate total expenses and remaining amount
            double totalExpenses = calculator.calculateTotalExpenses();
            double remainingAmount = calculator.calculateRemainingAmount();

            // Display the result
            JOptionPane.showMessageDialog(this, "Total Expenses: $" + totalExpenses +
                    "\nRemaining Amount: $" + remainingAmount, "Calculation Result", JOptionPane.INFORMATION_MESSAGE);
        } catch (NumberFormatException ex) {
            JOptionPane.showMessageDialog(this, "Invalid input. Please enter valid numbers.", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }

    // Helper method to check if a JTextField is empty
    private boolean isEmptyField(JTextField field) {
        return field.getText().trim().isEmpty();
    }

    // Helper method to validate and parse input from a JTextField
    private double validateInput(JTextField field) throws NumberFormatException {
        String input = field.getText().trim();
        if (!input.matches("^\\d*\\.?\\d+$")) {
            throw new NumberFormatException();
        }
        return Double.parseDouble(input);
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                new MonthlyExpensesGUI().setVisible(true);
            }
        });
    }
}

class MonthlyExpensesCalculator {
    private double salary;
    private double rent;
    private double utilities;
    private double groceries;
    private double transportation;
    private double entertainment;

    public void setSalary(double salary) {
        this.salary = salary;
    }

    public void setRent(double rent) {
        this.rent = rent;
    }

    public void setUtilities(double utilities) {
        this.utilities = utilities;
    }

    public void setGroceries(double groceries) {
        this.groceries = groceries;
    }

    public void setTransportation(double transportation) {
        this.transportation = transportation;
    }

    public void setEntertainment(double entertainment) {
        this.entertainment = entertainment;
    }

    public double calculateTotalExpenses() {
        return rent + utilities + groceries + transportation + entertainment;
    }

    public double calculateRemainingAmount() {
        return salary - calculateTotalExpenses();
    }
}
