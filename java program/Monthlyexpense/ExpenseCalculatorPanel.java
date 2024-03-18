
package Monthlyexpense;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ExpenseCalculatorPanel extends JPanel {

    private JTextField salaryField;
    private JTextField rentField;
    private JTextField utilitiesField;
    private JTextField groceriesField;
    private JTextField transportationField;
    private JTextField entertainmentField;

    private JButton themeButton;

    private ThemeSettingsDialog themeSettingsDialog;

    public ExpenseCalculatorPanel() {
        setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5, 5, 5, 5);
        gbc.anchor = GridBagConstraints.WEST;

        // Initialize UI components...
        gbc.gridx = 0;
        gbc.gridy = 0;
        add(new JLabel("Salary: $"), gbc);
        salaryField = new JTextField(10);
        gbc.gridx = 1;
        add(salaryField, gbc);

        gbc.gridx = 0;
        gbc.gridy++;
        add(new JLabel("Rent: $"), gbc);
        rentField = new JTextField(10);
        gbc.gridx = 1;
        add(rentField, gbc);

        gbc.gridy++;
        add(new JLabel("Utilities: $"), gbc);
        utilitiesField = new JTextField(10);
        gbc.gridx = 1;
        add(utilitiesField, gbc);

        gbc.gridy++;
        add(new JLabel("Groceries: $"), gbc);
        groceriesField = new JTextField(10);
        gbc.gridx = 1;
        add(groceriesField, gbc);

        gbc.gridy++;
        add(new JLabel("Transportation: $"), gbc);
        transportationField = new JTextField(10);
        gbc.gridx = 1;
        add(transportationField, gbc);

        gbc.gridy++;
        add(new JLabel("Entertainment: $"), gbc);
        entertainmentField = new JTextField(10);
        gbc.gridx = 1;
        add(entertainmentField, gbc);

        gbc.gridx = 0;
        gbc.gridy++;
        themeButton = new JButton("Theme Settings");
        themeButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                openThemeSettings();
            }
        });
        add(themeButton, gbc);
    }

    public void setThemeSettingsDialog(ThemeSettingsDialog themeSettingsDialog) {
        this.themeSettingsDialog = themeSettingsDialog;
    }

    private void openThemeSettings() {
        if (themeSettingsDialog != null) {
            themeSettingsDialog.setVisible(true);
        }
    }

    private void validateField(JTextField field) {
        String fieldValue = field.getText();
        if (fieldValue.isEmpty()) {
            JOptionPane.showMessageDialog(this, field.getName() + " cannot be empty.", "Validation Error", JOptionPane.ERROR_MESSAGE);
            // Clear the field if empty
            field.setText("");
        }
    }
}
