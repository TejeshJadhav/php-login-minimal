<?php require 'check_session.php'; ?>
<?php 
    $book_records = $conn->prepare('SELECT * FROM `books` WHERE 1');
    $book_records->execute();
    $book_results = $book_records->fetchAll();

    $books = null;

    if (count($book_results) > 0) {
      $books = $book_results;
    //   echo $books;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Look Books</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['name']; ?>
      <a href="logout.php">
        Logout
      </a>
      <br>
      <a href="sell_book.php">
        Sell Book
      </a>
      <div>
        <div>
          <h3>Books Available</h3>
        </div>
        <div>
            <table align="center" border="1">
                <thead>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Book Description</th>
                    <th>Book Cost</th>
                    <th>Book Image</th>
                </thead>
                <tbody> 
                <?php
                foreach($books as $data)
                {
                    echo "<tr>";
                    echo "<td>";
                    echo $data['book_id'];
                    echo "</td>";
 
                    echo "<td>";
                    echo $data['book_name'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $data['book_desc'];
                    echo "</td>";
                    
                    echo "<td>";
                    echo $data['book_cost'];
                    echo "</td>";

                    echo '<td><img src="data:image/jpg;base64,' . base64_encode( $data['book_image'] ) . '" /></td>';
                    echo "</tr>";
                }
            ?>
            </tbody>
            </table>
        </div>
      </div>
      <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
      <?php endif; ?>
    </body>
</html>