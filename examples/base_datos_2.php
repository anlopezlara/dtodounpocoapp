<form method="post" action="yourFileName.php">
    <input type="text" name="studentname">
    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->
</form>

<?php
function display()
{
    echo "hello ".$_POST["studentname"];
}
if(isset($_POST['submit']))
{
   display();
} 
?>