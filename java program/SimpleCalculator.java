import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class SimpleCalculator extends JFrame implements ActionListener {

    JTextField tf;
    JLabel label;
    String operator;
    double num1, num2, result;

    DefaultListModel<String> listModel;
    JList<String> numberList;

    JTextField selectedNumberDisplay; // JTextField

    private JButton createStyledButton(String text) {
        JButton button = new JButton(text);
        button.setFont(new Font("Times New Roman", Font.PLAIN, 18)); // Setting font
        button.setForeground(Color.blue); // Setting text color
        button.setPreferredSize(new Dimension(50, 50)); // for button size
        return button;
    }

    SimpleCalculator() {
        JFrame f = new JFrame("Calculator");

        tf = new JTextField();
        label = new JLabel();
        label.setFont(new Font("Arial", Font.PLAIN, 14));

        tf.setText("");

        JButton b0, b1, b2, b3, b4, b5, b6, b7, b8, b9;
        JButton add, subtract, multiply, divide, equal, clear, decimal;
        JButton clearList;

        // adding styled buttons
        b0 = createStyledButton("0");
        b1 = createStyledButton("1");
        b2 = createStyledButton("2");
        b3 = createStyledButton("3");
        b4 = createStyledButton("4");
        b5 = createStyledButton("5");
        b6 = createStyledButton("6");
        b7 = createStyledButton("7");
        b8 = createStyledButton("8");
        b9 = createStyledButton("9");

        add = createStyledButton("+");
        subtract = createStyledButton("-");
        multiply = createStyledButton("*");
        divide = createStyledButton("/");
        equal = createStyledButton("=");
        clear = createStyledButton("C");
        decimal = createStyledButton(".");
        clearList = createStyledButton("Clear List");

        JPanel p = new JPanel(new GridLayout(5, 4)); // Use GridLayout

        selectedNumberDisplay = new JTextField(10);
        selectedNumberDisplay.setEditable(false);

        // Add action listeners
        b0.addActionListener(this);
        b1.addActionListener(this);
        b2.addActionListener(this);
        b3.addActionListener(this);
        b4.addActionListener(this);
        b5.addActionListener(this);
        b6.addActionListener(this);
        b7.addActionListener(this);
        b8.addActionListener(this);
        b9.addActionListener(this);
        add.addActionListener(this);
        subtract.addActionListener(this);
        multiply.addActionListener(this);
        divide.addActionListener(this);
        equal.addActionListener(this);
        clear.addActionListener(this);
        decimal.addActionListener(this);
        clearList.addActionListener(this);

        // Add buttons to panel
        p.add(b7);
        p.add(b8);
        p.add(b9);
        p.add(divide);
        p.add(b4);
        p.add(b5);
        p.add(b6);
        p.add(multiply);
        p.add(b1);
        p.add(b2);
        p.add(b3);
        p.add(subtract);
        p.add(b0);
        p.add(decimal);
        p.add(equal);
        p.add(add);
        p.add(clear);
        p.add(clearList);

        listModel = new DefaultListModel<>(); // Creating list model
        numberList = new JList<>(listModel); // Creating JList with the list model
        JScrollPane scrollPane = new JScrollPane(numberList); // Add a scroll pane for the list

        f.setLayout(new FlowLayout());
        f.add(label);
        f.add(tf);
        f.add(scrollPane); // Add the list with scroll pane
        f.add(p);

        f.setSize(250, 250); // Adjusted size for better visibility
        f.setVisible(true);

        f.setLayout(new FlowLayout());
        f.add(label);
        f.add(selectedNumberDisplay); // Add the selectedNumberDisplay
    }

    public void actionPerformed(ActionEvent e) {
        String s = e.getActionCommand();

        if (s.equals("Clear List")) {
            listModel.removeAllElements();
        } else if ((s.charAt(0) >= '0' && s.charAt(0) <= '9') || s.charAt(0) == '.') {
            tf.setText(tf.getText() + s);
        } else if (s.charAt(0) == 'C') {
            tf.setText("");
        } else if (s.charAt(0) == '=') {
            try {
                String text = tf.getText();
                String[] tokens = text.split(" ");
                num1 = Double.parseDouble(tokens[0]);
                operator = tokens[1];
                num2 = Double.parseDouble(tokens[2]);

                listModel.addElement(text); // Add the expression to the list

                switch (operator) { // for calcuations
                    case "+":
                        result = num1 + num2;
                        break;
                    case "-":
                        result = num1 - num2;
                        break;
                    case "*":
                        result = num1 * num2;
                        break;
                    case "/":
                        result = num1 / num2;
                        break;
                }

                tf.setText(Double.toString(result));
            } catch (Exception exception) {
                tf.setText("Error");
            }
        } else {
            tf.setText(tf.getText() + " " + s + " ");
        }
    }

    public static void main(String[] args) {
        SimpleCalculator calc = new SimpleCalculator();
    }
}