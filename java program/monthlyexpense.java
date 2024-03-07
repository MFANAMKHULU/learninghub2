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
            double salary = Double.parseDouble(salaryField.getText());
            double rent = Double.parseDouble(rentField.getText());
            double utilities = Double.parseDouble(utilitiesField.getText());
            double groceries = Double.parseDouble(groceriesField.getText());
            double transportation = Double.parseDouble(transportationField.getText());
            double entertainment = Double.parseDouble(entertainmentField.getText());

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

    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                new MonthlyExpensesGUI().setVisible(true);
            }
        });
    }
}

public class MonthlyExpensesCalculator {
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
