<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <!-------------Q1---------------->

    <form  method="GET">
        <h5>------------------------------------------Q1------------------------------------------ </h5>
        Email: <input type="email" name="email"><br>
<br>        
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Submit">

        
    </form>

    <?php
     echo "<br>";
     echo "<br>"; 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['email']) && isset($_GET['password'])) {
        $email = htmlspecialchars($_GET['email']);
        $password = htmlspecialchars($_GET['password']);
        
        echo "Data received by GET method:<br>";
        echo "Email: " . $email . "<br>";
        echo "Password: " . $password . "<br>";
    } else {
        echo "No data received.";
    }
} else {
    echo "Data was not sent using GET method.";
}
?>

<!--------------------------------------Q2------------------------------------>
<h5>------------------------------------------Q2------------------------------------------ </h5>

    
    <h5>Search Engine</h5>
    
    <form  method="POST">
        <label for="url">Enter URL:</label><br>
        <input type="text" id="url" name="search" required><br><br>
        <input type="submit" value="GO">
    </form>

    <?php
        $url = $_POST['search'];
        header("Location: $url");



?>

<!--------------------------------------Q3------------------------------------>
<h5>------------------------------------------Q3------------------------------------------ </h5>


    <h5>Simple Calculator</h5>
    <form method="post">
        <label for="num1">Number 1:</label><br>
        <input type="number" id="num1" name="num1" required><br><br>
        
        <label for="num2">Number 2:</label><br>
        <input type="number" id="num2" name="num2" required><br><br>
        
        <label for="operation">Operation:</label><br>
        <select id="operation" name="operation" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>
        
        <input type="submit" value="Calculate">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operation = $_POST['operation'];
            
            switch ($operation) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = "Error: Division by zero!";
                    }
                    break;
                default:
                    $result = "Invalid operation!";
                    break;
            }

            echo "<h3>Result: $result</h3>";
        } else {
            echo "<h3>Please fill in all fields.</h3>";
        }
    }
    ?>


<!--------------------------------------Q4------------------------------------>
<h5>------------------------------------------Q4------------------------------------------ </h5>


<?php
session_start();

if (!isset($_SESSION['todo_list'])) {
    $_SESSION['todo_list'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = htmlspecialchars($_POST['task']);
    if (!empty($task)) {
        $_SESSION['todo_list'][] = $task;
    }
}

if (isset($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    if (is_numeric($removeIndex) && isset($_SESSION['todo_list'][$removeIndex])) {
        array_splice($_SESSION['todo_list'], $removeIndex, 1);
    }
}
?>

  
    <h2>To-Do List</h2>
    <form method="post">
        <label for="task">New Task:</label><br>
        <input type="text" id="task" name="task" required><br><br>
        <input type="submit" value="Add Task">
    </form>

    <h3>Your Tasks:</h3>
    <ul>
        <?php
        if (!empty($_SESSION['todo_list'])) {
            foreach ($_SESSION['todo_list'] as $index => $task) {
                echo "<li>$task <a href=\"?remove=$index\">Remove</a></li>";
            }
        } else {
            echo "<li>No tasks added yet.</li>";
        }
        ?>
    </ul>

<!--------------------------------------Q5------------------------------------>
<h5>------------------------------------------Q5------------------------------------------ </h5>

    <h5>Project and Script Information</h5>

    <?php
    $projectName = basename(dirname($_SERVER['PHP_SELF']));

    $scriptName = basename($_SERVER['PHP_SELF']);

    echo "<p>Project Name: $projectName</p>";
    echo "<p>Script Name: $scriptName</p>";
    ?>


<!--------------------------------------Q6------------------------------------>
<h5>------------------------------------------Q6----------------------------------------- </h5>

    <h5>Page Request Information</h5>

    <?php
    $requestTime = $_SERVER['REQUEST_TIME'];

    $formattedTime = date("Y-m-d H:i:s", $requestTime);

    echo "<p>Page requested on: $formattedTime</p>";
    
    ?>




<!--------------------------------------Q7------------------------------------>
<h5>------------------------------------------Q7----------------------------------------- </h5>
<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

$_SESSION['counter']++;
echo "<h4>This page has been refreshed {$_SESSION['counter']} times during this session.</h4>";

?>



    
<!--------------------------------------Q8------------------------------------>
<h5>------------------------------------------Q8----------------------------------------- </h5>


<?php
$counter_file = 'visitor_count.txt';

function updateVisitorCount($counter_file) {
    if (file_exists($counter_file)) {
        $count = file_get_contents($counter_file);
        $count = intval($count) + 1;
    } else {
        $count = 1;
    }
    
    file_put_contents($counter_file, $count);

    return $count;
}

$visitor_count = updateVisitorCount($counter_file);
?>


    <h5>Visitor Counter</h5>
    <p>You are visitor number: <?php echo $visitor_count; ?></p>



<!--------------------------------------Q9------------------------------------>
<h5>------------------------------------------Q9----------------------------------------- </h5>

<?php
$cookie_name = "example_cookie";
$cookie_value = "Hello, Cookie!";
$expiry_time = time() + (86400 * 30); 
$cookie_path = "/";
$domain = ""; 
$secure = false; 
$httponly = true; 

setcookie($cookie_name, $cookie_value, $expiry_time, $cookie_path, $domain, $secure, $httponly);

$all_cookies = $_COOKIE;

foreach ($_COOKIE as $cookie_name => $cookie_value) {
    setcookie($cookie_name, '', time() , $cookie_path, $domain, $secure, $httponly);
}
?>

    
    <h5>Created Cookie:</h5>
    <p>Name: <?php echo $cookie_name; ?></p>
    <p>Value: <?php echo $cookie_value; ?></p>
    <p>Expiry Time: <?php echo date('Y-m-d H:i:s', $expiry_time); ?></p>
    <p>Path: <?php echo $cookie_path; ?></p>
    <p>Domain: <?php echo $domain; ?></p>
    <p>Secure: <?php echo $secure ? 'Yes' : 'No'; ?></p>
    <p>HttpOnly: <?php echo $httponly ? 'Yes' : 'No'; ?></p>

    <h3>All Cookies:</h3>
    <?php if (!empty($all_cookies)): ?>
        <ul>
            <?php foreach ($all_cookies as $name => $value): ?>
                <li><?php echo "$name: $value"; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No cookies set.</p>
    <?php endif; ?>
    


    
</body>
</html>
