package Monthlyexpense;

import javax.swing.*;

public class MonthlyExpensesApp {

    public static void main(String[] args) {
        SwingUtilities.invokeLater(MonthlyExpensesApp::runApp);
    }

    private static void runApp() {
        MonthlyExpensesGUI gui = new MonthlyExpensesGUI();
        gui.setVisible(true);
    }
}
