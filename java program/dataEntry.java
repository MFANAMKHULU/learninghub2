import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class dataEntry extends JFrame {
    private JTextField firstNameEntry;
    private JTextField lastNameEntry;
    private JComboBox<String> titleComboBox;ss
    private JCheckBox registeredCheckBox;
    private JSpinner numSemestersSpinner;
    private JCheckBox termsCheckBox;

    public dataEntry() {
        setTitle("Data Entry Form");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        JPanel userInfoFrame = new JPanel(new GridLayout(5, 2));
        firstNameEntry = new JTextField();
        lastNameEntry = new JTextField();
        titleComboBox = new JComboBox<>(new String[]{"Mr.", "Mrs.", "Ms."});

        userInfoFrame.add(new JLabel("First Name"));
        userInfoFrame.add(firstNameEntry);
        userInfoFrame.add(new JLabel("Last Name"));
        userInfoFrame.add(lastNameEntry);
        userInfoFrame.add(new JLabel("Title"));
        userInfoFrame.add(titleComboBox);

        // Course info
        JPanel courseInfoFrame = new JPanel(new GridLayout(3, 2));
        registeredCheckBox = new JCheckBox("Currently Registered");
        numSemestersSpinner = new JSpinner(new SpinnerNumberModel(0, 0, 10, 1));
        courseInfoFrame.add(new JLabel("Registration Status"));
        courseInfoFrame.add(registeredCheckBox);
        courseInfoFrame.add(new JLabel("Number of Semesters"));
        courseInfoFrame.add(numSemestersSpinner);

        // Terms and Conditions
        JPanel termsFrame = new JPanel();
        termsCheckBox = new JCheckBox("I accept the terms and conditions.");
        termsFrame.add(termsCheckBox);

        // Button
        JButton button = new JButton("Enter Data");
        button.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                enterData();
            }
        });

        userInfoFrame.add(button);  // Add button to userInfoFrame

        add(userInfoFrame);  // Add userInfoFrame to JFrame
        add(courseInfoFrame);  // Add courseInfoFrame to JFrame
        add(termsFrame);  // Add termsFrame to JFrame

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

    