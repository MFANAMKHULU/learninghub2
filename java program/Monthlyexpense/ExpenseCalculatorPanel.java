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
        gbc.gridy = 9;
        JButton themeButton = new JButton("Theme Settings");
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
