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
    private ArrayList<JButton> deleteButtons; // List to store delete buttons

    public MonthlyExpensesGUI() {
        descriptions = new ArrayList<>();
        amounts = new ArrayList<>();
        deleteButtons = new ArrayList<>();

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

        JButton deleteButton = new JButton("Delete");
        deleteButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                int index = deleteButtons.indexOf(deleteButton); // Get index of the delete button clicked
                if (index != -1) {
                    descriptions.remove(index);
                    amounts.remove(index);
                    deleteButtons.remove(index); // Remove the delete button from the list
                    updateExpensesTextArea();
                    updateTotalExpenses();
                }
            }
        });
        deleteButtons.add(deleteButton); // Add the delete button to the list

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
            sb.append(descriptions.get(i)).append(": $").append(amounts.get(i));
            sb.append("    "); // Add some space for better formatting
            sb.append(deleteButtons.get(i).getText()); // Append delete button text
            sb.append("\n");
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
