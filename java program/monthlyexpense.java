import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.*;

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
        loadSavedData();
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

        JButton clearButton = new JButton("Clear");
        clearButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                clearFields();
            }
        });
        panel.add(clearButton);

        JButton saveButton = new JButton("Save");
        saveButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                saveData();
            }
        });
        panel.add(saveButton);

        JButton loadButton = new JButton("Load");
        loadButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                loadSavedData();
            }
        });
        panel.add(loadButton);

        // Adjust layout
        SpringUtilities.makeCompactGrid(panel, 8, 2, 10, 10, 10, 10);

        // Add panel to the frame
        add(panel);
    }

    private void calculateExpenses() {
        // Your calculation logic here
    }

    private void clearFields() {
        salaryField.setText("");
        rentField.setText("");
        utilitiesField.setText("");
        groceriesField.setText("");
        transportationField.setText("");
        entertainmentField.setText("");
    }

    private void saveData() {
        try (PrintWriter writer = new PrintWriter(new FileWriter("monthly_expenses.txt"))) {
            writer.println(salaryField.getText());
            writer.println(rentField.getText());
            writer.println(utilitiesField.getText());
            writer.println(groceriesField.getText());
            writer.println(transportationField.getText());
            writer.println(entertainmentField.getText());
            JOptionPane.showMessageDialog(this, "Data saved successfully.", "Save Data", JOptionPane.INFORMATION_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error saving data.", "Save Data", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
        }
    }

    private void loadSavedData() {
        try (BufferedReader reader = new BufferedReader(new FileReader("monthly_expenses.txt"))) {
            salaryField.setText(reader.readLine());
            rentField.setText(reader.readLine());
            utilitiesField.setText(reader.readLine());
            groceriesField.setText(reader.readLine());
            transportationField.setText(reader.readLine());
            entertainmentField.setText(reader.readLine());
            JOptionPane.showMessageDialog(this, "Data loaded successfully.", "Load Data", JOptionPane.INFORMATION_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error loading data.", "Load Data", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
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


