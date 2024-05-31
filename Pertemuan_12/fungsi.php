<!DOCTYPE html>
<html lang="en">
<body>
    <?php 
    function withoutArgument(){
        echo "Ini tanpa argumen<br>";
    }
    function yourName($name,$age){
        echo "My name is $name, i am $age year old<br>";
    }
    withoutArgument();
    yourName("Bob",18);
    yourName("Dob",20);
    ?>
</body>
</html>