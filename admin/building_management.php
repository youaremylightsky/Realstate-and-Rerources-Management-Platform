<?php
include("../connection/connect.php");
include("../includes/seller_header.php");
include("../includes/footer.php");

// Initialize search query
$search_query = "";

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = $_GET['search'];
    $sql = "SELECT * FROM propertylist WHERE title LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM propertylist";
}

$query = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Houses you Want to Sell</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <form class="form-inline" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $search_query; ?>">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <a href="addproperty.php" class="btn btn-primary">Add Property</a>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <?php
            while($check = mysqli_fetch_assoc($query)){
                $pic = $check['image1'];
                $title = $check['title'];
                $price = $check['price'];
                $property_id = $check['id'];
            ?>
            <div class="col-md-3">
                <div class="card" style="width: 17rem; height: 27rem; margin: 20px;  box-shadow: 0 4px 8px rgba(4, 4, 4, 1.1);">
                    <img src="<?php echo $pic; ?>" class="card-img-top" style="height: 250px; width: 271px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title; ?></h5>
                        <h5 class="card-title">$ <?php echo $price; ?></h5>
                            <div class="opt">
                                <div class="sec1">
                                <a href="viewinfo.php?id=<?php echo $property_id; ?>" class="btn btn-info" style = "width: 230px;">More Information</a>
                                </div>
                                <div class="sec2">
                                <a href="editproperty.php?id=<?php echo $property_id; ?>" class="btn btn-success" style = "width: 110px; margin-top: 5px;">Edit</a>
                                  <a href="delete.php?id=<?php echo $property_id; ?>" class="btn btn-danger" style = "width: 110px; margin-top: 5px;" >delete</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

           
            <?php } ?>
        </div>
    </div>


    <div class="div" style = "margin-top: 60px;"></div>

    <!-- Bootstrap JS and jQuery (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
