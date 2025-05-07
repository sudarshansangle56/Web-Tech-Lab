<%@ page import="java.sql.*" %> 
<html>
<head>
    <style>

        h1, h2 {
            text-align: center;
         
        }

        p {
            text-align: center;
            font-size: 18px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf4f8a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #433c3c;
            text-align: center;
        }

      
    </style>
</head>
<body>  

<% out.print("Hello World !! Welcome to JSP"); %>
<p>Hello World !! Welcome to JSP</p>
<h1>Welcome to Sanjivani College of Engineering, IT Department</h1>

<!-- Form to insert data -->
<h2>Insert Student Data</h2>
<form method="post">
    <label>Stud_id:</label><input type="text" name="stud_id"><br>
    <label>Name:</label><input type="text" name="name"><br>
    <label>Class:</label><input type="text" name="class"><br>
    <label>Division:</label><input type="text" name="division"><br>
    <input type="submit" value="Insert">
</form>

<%
try {
    Class.forName("com.mysql.jdbc.Driver"); 
    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/firsJSP", "root", "");

    // Insert logic
    String id = request.getParameter("stud_id");
    String name = request.getParameter("name");
    String cls = request.getParameter("class");
    String div = request.getParameter("division");
    
    if(id != null && name != null && cls != null && div != null &&
       !id.isEmpty() && !name.isEmpty() && !cls.isEmpty() && !div.isEmpty()) {
       
        PreparedStatement ps = con.prepareStatement("INSERT INTO studentp (Stud_id, Name, Class, Division) VALUES (?, ?, ?, ?)");
        ps.setString(1, id);
        ps.setString(2, name);
        ps.setString(3, cls);
        ps.setString(4, div);
        ps.executeUpdate();
        out.println("<p class='message success'>Data inserted successfully!</p>");
    }

    // Display table
    Statement stmt = con.createStatement(); 
    ResultSet rs = stmt.executeQuery("SELECT * FROM studentp"); 
%>

<h2>Student Data</h2>
<table>
<tr><th>Stud_id</th><th>Name</th><th>Class</th><th>Division</th></tr>
<%
    while(rs.next()) {
        out.println("<tr><td>" + rs.getObject(1) + "</td><td>" 
                             + rs.getString(2) + "</td><td>" 
                             + rs.getString(3) + "</td><td>" 
                             + rs.getString(4) + "</td></tr>");
    }
    con.close();
} catch(Exception e) { 
    out.print("<p class='message error'>Error: " + e + "</p>");
}
%>
</table>

</body>  
</html>
