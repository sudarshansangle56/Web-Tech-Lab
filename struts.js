<%@ taglib prefix="s" uri="/struts-tags" %>
<html>
<head>
    <title>Hello Struts2</title>
</head>
<body>
    <h2>Enter your name:</h2>
    <s:form action="hello">
        <s:textfield name="name" label="Name"/>
        <s:submit value="Submit"/>
    </s:form>
</body>
</html>
