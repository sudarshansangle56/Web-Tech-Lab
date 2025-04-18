import jakarta.servlet.http.*;  
import jakarta.servlet.*;  
import java.io.*; 
import java.sql.*;  

public class DemoServlet extends HttpServlet {  

    public void doGet(HttpServletRequest req, HttpServletResponse res)  
    throws ServletException, IOException {  
        res.setContentType("text/html");  
        PrintWriter pw = res.getWriter();  
        
        pw.println("<html><body>");
        pw.println("<h2>Welcome to Pragati eBookShop</h2>");  
        
        // Form to Add Book
        pw.println("<h3>Add a New Book</h3>");
        pw.println("<form method='post' action='it'>");
        pw.println("Book Name: <input type='text' name='name' required><br>");
        pw.println("Author: <input type='text' name='author' required><br>");
        pw.println("Price: <input type='number' step='0.01' name='price' required><br>");
        pw.println("Quantity: <input type='number' name='quantity' required><br>");
        pw.println("<input type='submit' name='action' value='Add Book'>");
        pw.println("</form>");

        // Form to Delete Book
        pw.println("<h3>Delete a Book by Name</h3>");
        pw.println("<form method='post' action='it'>");
        pw.println("Book Name: <input type='text' name='name' required><br>");
        pw.println("<input type='submit' name='action' value='Delete Book'>");
        pw.println("</form>");

        pw.println("<h3>Book List</h3>");
        pw.println("<table border='1'>");  
        pw.println("<tr><th>Book Name</th><th>Author</th><th>Price</th><th>Quantity</th></tr>");
        
        try { 
            Class.forName("com.mysql.jdbc.Driver"); 
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/pragati", "root", ""); 
            Statement stmt = con.createStatement(); 
            ResultSet rs = stmt.executeQuery("SELECT * FROM ebookshop"); 
            
            while (rs.next()) {    
                pw.println("<tr><td>" + rs.getString("name") + "</td><td>" + rs.getString("author") + "</td><td>" + rs.getDouble("price") + "</td><td>" + rs.getInt("quantity") + "</td></tr>");
            }
        } catch(Exception e) { 
            pw.println("<p style='color:red;'>Error: " + e.getMessage() + "</p>"); 
        } 
        
        pw.println("</table>");
        pw.println("</body></html>");    
        pw.close();  
    }  

    public void doPost(HttpServletRequest req, HttpServletResponse res)  
    throws ServletException, IOException {  
        res.setContentType("text/html");  
        PrintWriter pw = res.getWriter();  

        String action = req.getParameter("action");

        try { 
            Class.forName("com.mysql.jdbc.Driver"); 
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/pragati", "root", ""); 
            PreparedStatement ps;
            
            if ("Add Book".equals(action)) {
                String name = req.getParameter("name");
                String author = req.getParameter("author");
                double price = Double.parseDouble(req.getParameter("price"));
                int quantity = Integer.parseInt(req.getParameter("quantity"));
                
                ps = con.prepareStatement("INSERT INTO ebookshop (name, author, price, quantity) VALUES (?, ?, ?, ?)");
                ps.setString(1, name);
                ps.setString(2, author);
                ps.setDouble(3, price);
                ps.setInt(4, quantity);
                ps.executeUpdate();
                pw.println("<p>Book added successfully!</p>");
            } else if ("Delete Book".equals(action)) {
                String name = req.getParameter("name");
                
                ps = con.prepareStatement("DELETE FROM ebookshop WHERE name = ?");
                ps.setString(1, name);
                int rowsDeleted = ps.executeUpdate();
                if (rowsDeleted > 0) {
                    pw.println("<p>Book deleted successfully!</p>");
                } else {
                    pw.println("<p style='color:red;'> No book found with that name.</p>");
                }
            }
        } catch(Exception e) { 
            pw.println("<p style='color:red;'>Error: " + e.getMessage() + "</p>"); 
        }

        // Refresh the page to show updated list
        doGet(req, res);
    }
}
