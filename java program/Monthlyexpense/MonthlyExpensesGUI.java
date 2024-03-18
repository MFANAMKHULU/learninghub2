package Monthlyexpense;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MonthlyExpensesGUI extends JFrame {

    public MonthlyExpensesGUI() {
        setTitle("Monthly Expenses Calculator");
        setSize(600, 400);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);

        ExpenseCalculatorPanel panel = new ExpenseCalculatorPanel();
        add(panel);

        ThemeSettingsDialog themeDialog = new ThemeSettingsDialog(this);
        panel.setThemeSettingsDialog(themeDialog);
    }
}
