package Monthlyexpense;

import javax.swing.*;
import java.awt.*;

public class ThemeSettingsDialog extends JDialog {

    public ThemeSettingsDialog(JFrame parent) {
        super(parent, "Theme Settings", true);
        setSize(300, 200);
        setResizable(false);
        setLocationRelativeTo(parent);

        JPanel panel = new JPanel(new GridLayout(3, 1));
        JLabel label = new JLabel("Choose Theme:");
        panel.add(label);

        // Define your theme colors
        Color backgroundColor = Color.WHITE; 
        Color textColor = Color.BLACK; 
        Color buttonColor = Color.LIGHT_GRAY; 

        // Apply theme colors to components
        panel.setBackground(backgroundColor);
        label.setForeground(textColor);

        // Optionally, you can customize other components as well, such as buttons
        JButton closeButton = new JButton("Close");
        closeButton.setBackground(buttonColor);
        closeButton.setForeground(textColor);
        panel.add(closeButton);

        add(panel);
    }
}
