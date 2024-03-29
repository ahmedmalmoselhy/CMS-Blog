<?php
function showAllUsers()
{
    global $connection;
    $query = "SELECT * FROM users";
    $all_users = mysqli_query($connection, $query);
    if (!$all_users) {
        die("QUERY FAILED! " . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($all_users)){
        $id = $row['user_id'];
        $username = $row['user_name'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $image = $row['image'];
        $role = $row['role'];
        // Display Data in Rows
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td><a href='../user.php?u_id={$id}'>{$username}</a></td>";
        echo "<td>{$first_name}</td>";
        echo "<td>{$last_name}</td>";
        echo "<td>{$email}</td>";
        echo "<td><img width='100' src='../images/{$image}' alt=''></td>";
        echo "<td>{$role}</td>";
        echo "<td><a href='users.php?promote={$id}'>Promote to Admin</a></td>";
        echo "<td><a href='users.php?demote={$id}'>Demote to Member</a></td>";
        echo "<td><a href='users.php?delete={$id}'>Delete User</a></td>";
        echo "<td><a href='users.php?source=edit_user&id={$id}'>Update User</a></td>";
        echo "</tr>";
    }
}

function createUser(){
    global $connection;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $email = $_POST['email'];
    $role = $_POST['role'];

    // preventing sql injection
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);
    $user_name = mysqli_real_escape_string($connection, $user_name);
    $password = mysqli_real_escape_string($connection, $password);
    $email = mysqli_real_escape_string($connection, $email);

    // move image
    move_uploaded_file($image_temp, "../images/$image");

    $query = "INSERT INTO users (user_name, password, first_name, last_name, email, image, role) ";
    $query .= "VALUES ('{$user_name}', '{$password}', '{$first_name}', '{$last_name}', '{$email}', '{$image}', '{$role}')";

    $add_user = mysqli_query($connection, $query);
    if(!$add_user){
        die("QUERY FAILED! " . mysqli_error($connection));
    }

    header("Location: users.php");
}

function deleteUser(){
    global $connection;
    $id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$id}";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location: users.php");
}

function promoteUser(){
    global $connection;
    $id = $_GET['promote'];
    $query = "UPDATE users SET role = 'admin' WHERE user_id = {$id}";
    $approval = mysqli_query($connection, $query);
    if(!$approval){
        die(mysqli_error($connection));
    }
    header("Location: users.php");
}

function demoteUser(){
    global $connection;
    $id = $_GET['demote'];
    $query = "UPDATE users SET role = 'member' WHERE user_id = {$id}";
    $approval = mysqli_query($connection, $query);
    if(!$approval){
        die(mysqli_error($connection));
    }
    header("Location: users.php");
}

function updateUser(){
    global $connection;
    global $user_id;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $email = $_POST['email'];
    $role = $_POST['role'];

    // preventing sql injection
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);
    $user_name = mysqli_real_escape_string($connection, $user_name);
    $password = mysqli_real_escape_string($connection, $password);
    $email = mysqli_real_escape_string($connection, $email);

    // move image
    move_uploaded_file($image_temp, "../images/$image");

    $query = "UPDATE users SET ";
    $query .= "first_name = '{$first_name}', ";
    $query .= "last_name = '{$last_name}', ";
    $query .= "user_name = '{$user_name}', ";
    $query .= "password = '{$password}', ";
    $query .= "image = '{$image}', ";
    $query .= "email = '{$email}', ";
    $query .= "role = '{$role}' ";
    $query .= "WHERE user_id = {$user_id}";

    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED! " . mysqli_error($connection));
    }
    header("Location: users.php");
}

function updateProfile(){
    global $connection;
    global $s_user_name;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $email = $_POST['email'];
    $role = $_POST['role'];

    // preventing sql injection
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);
    $user_name = mysqli_real_escape_string($connection, $user_name);
    $password = mysqli_real_escape_string($connection, $password);
    $email = mysqli_real_escape_string($connection, $email);

    // move image
    move_uploaded_file($image_temp, "../images/$image");

    $query = "UPDATE users SET ";
    $query .= "first_name = '{$first_name}', ";
    $query .= "last_name = '{$last_name}', ";
    $query .= "user_name = '{$user_name}', ";
    $query .= "password = '{$password}', ";
    $query .= "image = '{$image}', ";
    $query .= "email = '{$email}', ";
    $query .= "role = '{$role}' ";
    $query .= "WHERE user_name = '{$s_user_name}'";

    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED! " . mysqli_error($connection));
    }
    header("Location: profile.php");
}

function counterUsers(){
    global $connection;
    $counter = 0;
    $query = "SELECT * FROM users";
    $all_users = mysqli_query($connection, $query);
    if(!$all_users){
        die(mysqli_error($connection));
    }
    while(mysqli_fetch_assoc($all_users)){
        $counter = $counter + 1;
    }
    echo $counter;
}