import javax.swing.*;
import java.io.*;

public class DataHandler {

    public static void saveData(String fileName, String[] data) {
        try (PrintWriter writer = new PrintWriter(new FileWriter(fileName))) {
            for (String line : data) {
                writer.println(line);
            }
            JOptionPane.showMessageDialog(null, "Data saved successfully.", "Save Data", JOptionPane.INFORMATION_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(null, "Error saving data.", "Save Data", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
        }
    }

    public static String[] loadData(String fileName) {
        try (BufferedReader reader = new BufferedReader(new FileReader(fileName))) {
            String[] data = new String[6];
            for (int i = 0; i < data.length; i++) {
                data[i] = reader.readLine();
            }
            JOptionPane.showMessageDialog(null, "Data loaded successfully.", "Load Data", JOptionPane.INFORMATION_MESSAGE);
            return data;
        } catch (FileNotFoundException e) {
            JOptionPane.showMessageDialog(null, "Data file not found.", "Load Data", JOptionPane.WARNING_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(null, "Error loading data.", "Load Data", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
        }
        return null;
    }
}
