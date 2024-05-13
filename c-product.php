<?php    
    session_start();
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only Customer// Product Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/c-product.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="c-product.php">
            <?php
                $sql = "SELECT * FROM data_common";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $image_url = $row["pic1"];
                ?>
                <img src="<?= $image_url ?>" alt="Product Image" style="width: 40px; height: auto; border-radius: 10px;">
                <?php
                } else {
                    echo "No image found.";
                }
                ?>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <main>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-primary" onclick="window.location.href='c-product-rec.php'">Recomend</button>
            <form action="c-product-fill.php" method="get">
                <div class="btn-group">
                <button class="btn btn-primary" type="submit" name="type_1" value="Beverage">Beverage</button>
                <button class="btn btn-primary" type="submit" name="type_1" value="Baked">Dessert</button>
                <button class="btn btn-primary" type="submit" name="type_1" value="Dished">Dished</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    <div class="container mt-5">
    <h1>Beverage</h1> 
        <div class="row">                        
            <?php
            // Connect to database (code not shown)

            $sql = "SELECT * FROM products WHERE type_1 = 'Beverage'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] !== 'Quit selling') {
                    ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="<?= $row["image"] ?>" class="card-img-top<?= ($row['status'] === 'Out of raw materials') ? ' grayscale' : '' ?>" alt="Product Image" style="height: 270px;">
                    <div class="card-body">
                    <h6 style="font-size: 15px;" class="card-title">
                        <?= $row["name"] ?>
                        <?php if ($row['status'] === 'Out of raw materials'): ?>
                            <span style="color: red;">(Out of stock)</span>
                        <?php endif; ?>
                    </h6>
                        <?php if ($row["price_h"] != 0): ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="hotCheckbox" name="hotCheckbox" data-type="price_h" value="<?= $row["price_h"] ?>" disabled>
                                <label class="custom-control-label" for="hotCheckbox">Hot : <?= $row["price_h"] ?> Bath</label>
                            </div>
                        <?php endif; ?>
                        <?php if ($row["price_c"] != 0): ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="coldCheckbox" name="coldCheckbox" data-type="price_c" value="<?= $row["price_c"] ?>" disabled>
                                <label class="custom-control-label" for="coldCheckbox">Cold : <?= $row["price_c"] ?> Bath</label>
                            </div>
                        <?php endif; ?>
                        <?php if ($row["price_f"] != 0): ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="fleppeCheckbox" name="fleppeCheckbox" data-type="price_f" value="<?= $row["price_f"] ?>" disabled>
                                <label class="custom-control-label" for="fleppeCheckbox">Fleppe : <?= $row["price_f"] ?> Bath</label>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="comment"><b>Options</b></label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="noSweetCheckbox" name="comment[]" value="Normal sweet 50%"disabled>
                                <label class="custom-control-label" for="noSweetCheckbox">Normal sweet 50%</label>
                            </div>
                            <?php if ($row['type_2'] == 'Coffee'): ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="singleShotCheckbox" name="comment[]" value="Single Shot +20 Bath"disabled>
                                    <label class="custom-control-label" for="singleShotCheckbox">Single Shot +20 Bath</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="doubleShotCheckbox" name="comment[]" value="Double Shot +40 Bath"disabled>
                                    <label class="custom-control-label" for="doubleShotCheckbox">Double Shot +40 Bath</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="tripleShotCheckbox" name="comment[]" value="Triple Shot +60 Bath" disabled>
                                    <label class="custom-control-label" for="tripleShotCheckbox">Triple Shot +60 Bath</label>
                                </div>
                            <?php elseif ($row['type_2'] == 'Tea'): ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="bubbleCheckbox" name="comment[]" value="Bubble +5 Bath" disabled>
                                    <label class="custom-control-label" for="bubbleCheckbox">Bubble +5 Bath</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="milkPuddingCheckbox" name="comment[]" value="Milk Pudding +10 Bath" disabled>
                                    <label class="custom-control-label" for="milkPuddingCheckbox">Milk Pudding +10 Bath</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="whipCheeseCheckbox" name="comment[]" value="Whip Cheese +20 Bath"disabled>
                                    <label class="custom-control-label" for="whipCheeseCheckbox">Whip Cheese +20 Bath</label>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
                <?php
                }
            }
        }
            ?>           
        </div>
        </div>
        
        <div class="container mt-5">
            <h1>Baked</h1>
            <hr>
            <div class="row">
                <?php
                // Connect to database (code not shown)

                $sql = "SELECT * FROM products WHERE type_1 = 'Baked'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                            <img src="<?= $row["image"] ?>" class="card-img-top<?= ($row['status'] === 'Out of raw materials') ? ' grayscale' : '' ?>" alt="Product Image" style="height: 270px;">
                                <div class="card-body">
                                    <h6 style="font-size: 15px;" class="card-title">
                                        <?= $row["name"] ?>
                                        <?php if ($row['status'] === 'Out of raw materials'): ?>
                                            <span style="color: red;">(Out of stock)</span>
                                        <?php endif; ?>
                                    </h6>
                                    <p class="card-text">Price: <?= $row["price_h"] ?> Bath</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

            <div class="container mt-5">
            <h1>Dished</h1>
            <hr>
            <div class="row">
                <?php
                // Connect to database (code not shown)

                $sql = "SELECT * FROM products WHERE type_1 = 'Dished'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                            <img src="<?= $row["image"] ?>" class="card-img-top<?= ($row['status'] === 'Out of raw materials') ? ' grayscale' : '' ?>" alt="Product Image" style="height: 270px;">
                                <div class="card-body">
                                    <h6 style="font-size: 15px;" class="card-title">
                                        <?= $row["name"] ?>
                                        <?php if ($row['status'] === 'Out of raw materials'): ?>
                                            <span style="color: red;">(Out of stock)</span>
                                        <?php endif; ?>
                                    </h6>
                                    <p class="card-text">Price: <?= $row["price_h"] ?> Bath</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            </div>
        
        
    </main>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>