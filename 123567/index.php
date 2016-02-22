<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}

//show message from add / edit page
if (isset($_GET['delpost'])) {

    $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['delpost']));

    header('Location: index.php?action=deleted');
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script language="JavaScript" type="text/javascript">
        function delpost(id, title) {
            if (confirm("Are you sure you want to delete '" + title + "'")) {
                window.location.href = 'index.php?delpost=' + id;
            }
        }
    </script>
</head>
<body>

<div id="wrapper">

    <?php include('menu.php'); ?>

    <?php
    //show message from add / edit page
    if (isset($_GET['action'])) {
        echo '<h3>Post ' . $_GET['action'] . '.</h3>';
    }
    $state = 'ASC';
    if (isset($_GET['sort'])) {
        if ($_GET['sort'] == 'ASC') {
            $state = 'ASC';

        } else {
            $state = 'DESC';

        }
    };

    ?>

    <table>
        <tr>
            <th>Title</th>
            <th><a href="?sort=<?php echo(($state == "ASC") ? "DESC" : "ASC"); ?>" data-toggle="tooltip"
                   title="Сортировка">Date</a></th>
            <th>Action</th>
        </tr>
        <?php

        try {

//       $string_1 = "SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID ASC";
            $string_1 = "SELECT postID,";
            $string_2 = "postTitle,";
            $string_3 = "postDate FROM blog_posts ORDER BY postID ";


            $stmt = $db->query($string_1 . $string_2 . $string_3 . $state);

            while ($row = $stmt->fetch()) {
                echo '<pre>';
                echo '</pre>';
                echo '<tr>';
                echo '<td>' . $row['postTitle'] . '</td>';
                echo '<td>' . date('jS M Y', strtotime($row['postDate'])) . '</td>';
                ?>

                <td>
                    <a href="edit-post.php?id=<?php echo $row['postID']; ?>">Edit</a> |
                    <a href="javascript:delpost('<?php echo $row['postID']; ?>','<?php echo $row['postTitle']; ?>')">Delete</a>
                </td>

                <?php
                echo '</tr>';

            }

        } catch
        (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>

    <p><a href='add-post.php'>Add Post</a></p>

</div>

</body>
</html>
