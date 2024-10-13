<?php
require_once 'User.php';
class Profile extends User {
    private $pdo;

    public function __construct($pdo, $id) {
        $this->pdo = $pdo;
        $this->loadProfile($id);
    }

    private function loadProfile($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, username, email FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    //set User properties
                    $this->id = $row["id"];
                    $this->username = $row["username"];
                    $this->email = $row["email"];
                } else {
                    echo "There was a problem fetching your profile information.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>


<?php
session_start();

//check if user is logged in if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once '../../includes/db.php';
$pdo = get_connection();
$username = $email = "";

//get user information from the database using session ID
try {
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = :id");
    $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
            //get result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //get individual field value
            $username = $row["username"];
            $email = $row["email"];
        } else {
            echo "There was a problem fetching your profile information.";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

include '../../includes/header.php';
?>

<link rel="stylesheet" type="text/css" href="../../css/styles.css">

<div>
    <h2>Profile</h2>
    <p><b>Username:</b> <?php echo htmlspecialchars($username); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
</div>

<?php
include '../../includes/footer.php';
?>