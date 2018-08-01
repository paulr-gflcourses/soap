<html>
<head><title><?php echo TITLE ?></title>

    <style type="text/css" media="all">
        .errors{
            color: #FF0000; 
            font-size: 15px;
        }
    </style>

</head>
<body>

<form action="index.php">
    <div>
        <h2>Temperature converter</h2>
        <p>Converts Celsius degrees to Fahrenheit</p>
    </div>
<p>
<?php
if ($errorCelsius)
{
    echo "<div class='errors'>$errorCelsius</div>";
}

echo "<input type='text' name='celsius' id='celsius' value='$celsius'/>";
?>
    <label for="celsius"> 'C </label>
    <label for="typeSend">Select type sending </label>
<select name="typeSend" id ="typeSend">
   <option selected>soap</option> 
   <option>curl</option> 
</select>
    <button type="submit">Convert</button>
</p>

<p>
<?php
echo "<input type='text' name='fahrenheit' id='fahrenheit' disabled value='$celsToFar'/>";
?>
    <label for="fahrenheit"> 'F </label>
</p>
</form>

<form action="index.php">
    <div>
        <h2>List of countries</h2>
        <p>Gets the country list with codes</p>
    </div>
    <p>
<?php

if ($errorCountries)
{
    echo "<div class='errors'>$errorCountries</div>";
}
?>
    <input type="hidden" name="countryList" value="true" />
    <label for="typeSend">Select type sending </label>
<select name="typeSend" id ="typeSend">
   <option selected>soap</option> 
   <option>curl</option> 
</select>
        <button type="submit">Get list</button>
    </p>
</form>


<?php
if ($countryList){
    echo "<table>
        <tr>
        <th>Name</th>
        <th>ISO Code</th>
        </tr>";
    foreach ($countryList as $country) {
        echo "<tr><td>{$country->sName}</td><td>$country->sISOCode</td></tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
