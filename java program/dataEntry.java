import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class DataEntry extends JFrame {
    private JTextField firstNameEntry;
    private JTextField lastNameEntry;
    private JComboBox<String> titleComboBox;
    private JCheckBox registeredCheckBox;
    private JSpinner numSemestersSpinner;
    private JCheckBox termsCheckBox;

    public DataEntry() {
        setTitle("Data Entry Form");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        JPanel mainPanel = new JPanel();
        mainPanel.setLayout(new BoxLayout(mainPanel, BoxLayout.Y_AXIS));

        JPanel userInfoFrame = new JPanel(new GridLayout(3, 2));
        firstNameEntry = new JTextField();
        lastNameEntry = new JTextField();
        titleComboBox = new JComboBox<>(new String[]{"Mr.", "Mrs.", "Ms."});

        userInfoFrame.add(new JLabel("First Name"));
        userInfoFrame.add(firstNameEntry);
        userInfoFrame.add(new JLabel("Last Name"));
        userInfoFrame.add(lastNameEntry);
        userInfoFrame.add(new JLabel("Title"));
        userInfoFrame.add(titleComboBox);

        mainPanel.add(userInfoFrame);

        // Course info
        JPanel courseInfoFrame = new JPanel(new GridLayout(2, 2));
        registeredCheckBox = new JCheckBox("Currently Registered");
        numSemestersSpinner = new JSpinner(new SpinnerNumberModel(0, 0, 10, 1));
        courseInfoFrame.add(new JLabel("Registration Status"));
        courseInfoFrame.add(registeredCheckBox);
        courseInfoFrame.add(new JLabel("Number of Semesters"));
        courseInfoFrame.add(numSemestersSpinner);

        mainPanel.add(courseInfoFrame);

        // Terms and Conditions
        termsCheckBox = new JCheckBox("I accept the terms and conditions.");
        mainPanel.add(termsCheckBox);

        // Button
        JButton button = new JButton("Enter Data");
        button.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                enterData();
            }
        });

        mainPanel.add(button);  // Add button to mainPanel

        add(mainPanel);  // Add mainPanel to JFrame

        pack();
        setLocationRelativeTo(null);
    }

    public void enterData() {
        // Retrieve data and perform actions
        String firstName = firstNameEntry.getText();
        String lastName = lastNameEntry.getText();
        String title = (String) titleComboBox.getSelectedItem();

        boolean isRegistered = registeredCheckBox.isSelected();
        int numSemesters = (int) numSemestersSpinner.getValue();

        boolean acceptedTerms = termsCheckBox.isSelected();

        System.out.println("First Name: " + firstName + ", Last Name: " + lastName);
        System.out.println("Title: " + title);
        System.out.println("Registration Status: " + (isRegistered ? "Registered" : "Not registered"));
        System.out.println("Semesters: " + numSemesters);
        System.out.println("Terms and Condition: " + (acceptedTerms ? "Accepted" : "Not Accepted"));
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            DataEntry form = new DataEntry();
            form.setVisible(true);
        });
    }
}
