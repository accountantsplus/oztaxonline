<!DOCTYPE html> <!-- This declaration defines the document type as HTML5 -->

<html lang="en"> <!-- The opening <html> tag defines the beginning of the HTML document. "lang" attribute specifies the language of the document. -->


<head>
    <title>Center Select Box with CSS</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>


<body>

   <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        select {
            /* Add any additional styling for your select box here */
        }
    </style>
    <main>
       <h1>Select Hours</h1>
    <select name="fruit" class="container">
        <option value="apple">1</option>
        <option value="banana">2</option>
        <option value="cherry">3</option>
        <option value="grape">4</option>
        <option value="orange">5</option>
              <option value="apple">6</option>
        <option value="banana">7</option>
        <option value="cherry">8</option>
        <option value="grape">9</option>
        <option value="orange">10</option>
    </select>
    </main>

   
</body>

</html>