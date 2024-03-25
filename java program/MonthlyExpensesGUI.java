import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;

public class MonthlyExpensesGUI extends JFrame {
    private JTextField descriptionField;
    private JTextField amountField;
    private JTextArea expensesTextArea;
    private JLabel totalExpensesLabel;

    private ArrayList<String> descriptions;
    private ArrayList<Double> amounts;
    private ArrayList<JButton> deleteButtons;

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

        JButton saveButton = new JButton("Save");
        saveButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                saveExpensesToFile();
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
        panel.add(saveButton);
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
                int index = deleteButtons.indexOf(deleteButton);
                if (index != -1) {
                    descriptions.remove(index);
                    amounts.remove(index);
                    deleteButtons.remove(index);
                    updateExpensesTextArea();
                    updateTotalExpenses();
                }
            }
        });
        deleteButtons.add(deleteButton);

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
            sb.append("    ");
            sb.append(deleteButtons.get(i).getText());
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

    private void saveExpensesToFile() {
        JFileChooser fileChooser = new JFileChooser();
        int result = fileChooser.showSaveDialog(this);
        if (result == JFileChooser.APPROVE_OPTION) {
            File file = fileChooser.getSelectedFile();
            try (FileWriter writer = new FileWriter(file)) {
                for (int i = 0; i < descriptions.size(); i++) {
                    writer.write(descriptions.get(i) + "," + amounts.get(i) + "\n");
                }
                writer.write("Total Expenses," + getTotalExpenses() + "\n");
                JOptionPane.showMessageDialog(this, "Expenses saved successfully.");
            } catch (IOException e) {
                JOptionPane.showMessageDialog(this, "An error occurred while saving expenses: " + e.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
            }
        }
    }

    private double getTotalExpenses() {
        double total = 0.0;
        for (Double amount : amounts) {
            total += amount;
        }
        return total;
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
