import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;

public class MonthlyExpensesGUI extends JFrame {
    private JTextField descriptionField;
    private JTextField amountField;
    private JTextArea expensesTextArea;
    private JLabel totalExpensesLabel;

    private ArrayList<String> descriptions;
    private ArrayList<Double> amounts;

    public MonthlyExpensesGUI() {
        descriptions = new ArrayList<>();
        amounts = new ArrayList<>();

        setTitle("Monthly Expenses");
        setSize(400, 300);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(5, 2));

        JLabel descriptionLabel = new JLabel("Description:");
        descriptionField = new JTextField();
        JLabel amountLabel = new JLabel("Amount:");
        amountField = new JTextField();

        JButton addButton = new JButton("Add Expense");
        addButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                addExpense();
            }
        });

        JButton clearButton = new JButton("Clear");
        clearButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                clearFields();
            }
        });

        expensesTextArea = new JTextArea();
        expensesTextArea.setEditable(false);

        totalExpensesLabel = new JLabel("Total Expenses: $0.00");

        panel.add(descriptionLabel);
        panel.add(descriptionField);
        panel.add(amountLabel);
        panel.add(amountField);
        panel.add(addButton);
        panel.add(clearButton);
        panel.add(totalExpensesLabel);

        JScrollPane scrollPane = new JScrollPane(expensesTextArea);
        panel.add(scrollPane);
        add(panel);

        setVisible(true);
    }

    private void addExpense() {
        String description = descriptionField.getText();
        double amount = Double.parseDouble(amountField.getText());

        descriptions.add(description);
        amounts.add(amount);

        updateExpensesTextArea();
        updateTotalExpenses();

        descriptionField.setText("");
        amountField.setText("");
    }

    private void clearFields() {
        descriptionField.setText("");
        amountField.setText("");
    }

    private void updateExpensesTextArea() {
        StringBuilder sb = new StringBuilder();
        for (int i = 0; i < descriptions.size(); i++) {
            sb.append(descriptions.get(i)).append(": $").append(amounts.get(i)).append("\n");
        }
        expensesTextArea.setText(sb.toString());
    }

    private void updateTotalExpenses() {
        double total = 0.0;
        for (Double amount : amounts) {
            total += amount;
        }
        totalExpensesLabel.setText("Total Expenses: $" + String.format("%.2f", total));
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                new MonthlyExpensesGUI();
            }
        });
    }
}
