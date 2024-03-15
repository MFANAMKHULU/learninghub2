import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.*;

public class MonthlyExpensesGUI extends JFrame {

    private JTextField salaryField;
    private JTextField rentField;
    private JTextField utilitiesField;
    private JTextField groceriesField;
    private JTextField transportationField;
    private JTextField entertainmentField;

    private JButton themeButton;

    public MonthlyExpensesGUI() {
        setTitle("Monthly Expenses Calculator");
        setSize(600, 400); // Adjusted size
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        initUI();

        // Add a button to open theme settings
        themeButton = new JButton("Theme Settings");
        themeButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                openThemeSettings();
            }
        });
        add(themeButton, BorderLayout.SOUTH); // Add button to the bottom of the frame
    }

    private void initUI() {
        JPanel panel = new JPanel(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5, 5, 5, 5);
        gbc.anchor = GridBagConstraints.WEST;

        // Add components to the panel
        gbc.gridx = 0;
        gbc.gridy = 0;
        panel.add(new JLabel("Salary: $"), gbc);
        salaryField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(salaryField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 1;
        panel.add(new JLabel("Rent: $"), gbc);
        rentField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(rentField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 2;
        panel.add(new JLabel("Utilities: $"), gbc);
        utilitiesField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(utilitiesField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 3;
        panel.add(new JLabel("Groceries: $"), gbc);
        groceriesField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(groceriesField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 4;
        panel.add(new JLabel("Transportation: $"), gbc);
        transportationField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(transportationField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 5;
        panel.add(new JLabel("Entertainment: $"), gbc);
        entertainmentField = new JTextField(10);
        gbc.gridx = 1;
        panel.add(entertainmentField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 6;
        gbc.gridwidth = 2;
        JButton calculateButton = new JButton("Calculate");
        calculateButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                calculateExpenses();
            }
        });
        panel.add(calculateButton, gbc);

        gbc.gridx = 0;
        gbc.gridy = 7;
        JButton clearButton = new JButton("Clear");
        clearButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                clearFields();
            }
        });
        panel.add(clearButton, gbc);

        gbc.gridx = 0;
        gbc.gridy = 8;
        JButton saveButton = new JButton("Save");
        saveButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                saveData();
            }
        });
        panel.add(saveButton, gbc);

        gbc.gridx = 0;
        gbc.gridy = 9;
        JButton loadButton = new JButton("Load");
        loadButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                loadSavedData();
            }
        });
        panel.add(loadButton, gbc);

        // Add panel to the frame
        add(panel);
    }

    private void calculateExpenses() {
        try {
            double salary = validateInput(salaryField, 0, Double.MAX_VALUE);
            double rent = validateInput(rentField, 0, salary);
            double utilities = validateInput(utilitiesField, 0, salary);
            double groceries = validateInput(groceriesField, 0, salary);
            double transportation = validateInput(transportationField, 0, salary);
            double entertainment = validateInput(entertainmentField, 0, salary);

            double totalExpenses = rent + utilities + groceries + transportation + entertainment;
            double remainingAmount = salary - totalExpenses;

            JOptionPane.showMessageDialog(this, "Total Expenses: $" + totalExpenses + "\nRemaining Amount: $" + remainingAmount, "Expense Calculation", JOptionPane.INFORMATION_MESSAGE);
        } catch (NumberFormatException ex) {
            JOptionPane.showMessageDialog(this, "Invalid input. Please enter valid numbers.", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }

    private double validateInput(JTextField field, double minValue, double maxValue) throws NumberFormatException {
        String input = field.getText().trim();
        if (!input.matches("^\\d*\\.?\\d+$")) {
            throw new NumberFormatException();
        }
        double value = Double.parseDouble(input);
        if (value < minValue || value > maxValue) {
            throw new NumberFormatException();
        }
        return value;
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
        } catch (FileNotFoundException e) {
            JOptionPane.showMessageDialog(this, "Data file not found.", "Load Data", JOptionPane.WARNING_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(this, "Error loading data.", "Load Data", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
        }
    }

    private void openThemeSettings() {
        // Create a dialog for theme settings
        JDialog dialog = new JDialog(this, "Theme Settings", true);
        dialog.setSize(300, 200);
        dialog.setResizable(false);
        dialog.setLocationRelativeTo(this);

        JPanel panel = new JPanel(new GridLayout(3, 1));
        JLabel label = new JLabel("Choose Theme:");
        panel.add(label);

        // Create radio buttons for different themes
        JRadioButton theme1Button = new JRadioButton("Theme 1");
        JRadioButton theme2Button = new JRadioButton("Theme 2");
        JRadioButton theme3Button = new JRadioButton("Theme 3");

        // Add action listeners to radio buttons
        theme1Button.addActionListener(new ThemeChangeListener("Theme 1"));
        theme2Button.addActionListener(new ThemeChangeListener("Theme 2"));
        theme3Button.addActionListener(new ThemeChangeListener("Theme 3"));

        // Add radio buttons to a button group
        ButtonGroup group = new ButtonGroup();
        group.add(theme1Button);
        group.add(theme2Button);
        group.add(theme3Button);

        panel.add(theme1Button);
        panel.add(theme2Button);
        panel.add(theme3Button);

        dialog.add(panel);
        dialog.setVisible(true);
    }

    private class ThemeChangeListener implements ActionListener {
        private String themeName;

        public ThemeChangeListener(String themeName) {
            this.themeName = themeName;
        }

        @Override
        public void actionPerformed(ActionEvent e) {
            // Implement theme change logic here
            // For example, update the color scheme based on the selected theme
            if (themeName.equals("Theme 1")) {
                UIManager.put("Panel.background", Color.WHITE);
                UIManager.put("Button.background", Color.BLUE);
                UIManager.put("Button.foreground", Color.WHITE);
                // Add more UI properties to customize
            } else if (themeName.equals("Theme 2")) {
                UIManager.put("Panel.background", Color.BLACK);
                UIManager.put("Button.background", Color.RED);
                UIManager.put("Button.foreground", Color.WHITE);
                // Add more UI properties to customize
            } else if (themeName.equals("Theme 3")) {
                UIManager.put("Panel.background", Color.GRAY);
                UIManager.put("Button.background", Color.GREEN);
                UIManager.put("Button.foreground", Color.BLACK);
                // Add more UI properties to customize
            }

            // Update UI components to reflect the changes
            SwingUtilities.updateComponentTreeUI(MonthlyExpensesGUI.this);
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
