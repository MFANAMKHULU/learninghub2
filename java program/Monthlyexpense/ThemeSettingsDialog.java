import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ThemeSettingsDialog extends JDialog {

    public ThemeSettingsDialog(JFrame parent) {
        super(parent, "Theme Settings", true);
        setSize(300, 200);
        setResizable(false);
        setLocationRelativeTo(parent);

        JPanel panel = new JPanel(new GridLayout(3, 1));
        JLabel label = new JLabel("Choose Theme:");
        panel.add(label);

        

        add(panel);
    }

    
}
