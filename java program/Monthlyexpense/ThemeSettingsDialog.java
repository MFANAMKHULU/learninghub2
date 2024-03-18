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

        // Add more components or settings for the theme settings dialog

        add(panel);
    }

    // Add more methods or settings for the theme settings dialog if needed
}
