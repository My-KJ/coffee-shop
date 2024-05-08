<?php    
    session_start();
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomended</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/product.css">
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
            <div class="col-12">         
                <div class="text-left">
                    <button class="btn btn-secondary" type="submit" onclick="window.location.href='c-product.php'">Previous</button>           
                </div>    
            </div>
        </div>
    </div>  
        <div class="container mt-5">
            <h1><i>Recomend !!</i></h1> 
            <br>
            <h3>Beverage</h3>
            <hr>
            <div class="row"> 
                                 
            <?php
            // Connect to database (code not shown)

            $sql = "SELECT p.name, p.image, p.price_h, p.price_c, p.price_f,p.type_1,p.type_2, t.total_qty
            FROM (
                SELECT id_product, SUM(qty) AS total_qty
                FROM order_detail
                WHERE status = 'Yes'
                GROUP BY id_product
            ) AS t
            INNER JOIN products p ON t.id_product = p.id_product
            WHERE p.type_1 = 'Beverage' 
            ORDER BY t.total_qty DESC
            LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="<?= $row["image"] ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                        <h6 style="font-size: 15px;" class="card-title"><?= $row["name"] ?></h6>
                        <select class="custom-select mb-3" required>
                            <?php if ($row["price_h"] != 0): ?>
                            <option data-type="price_h" value="<?= $row["price_h"] ?>">Hot : <?= $row["price_h"] ?> Bath</option>
                            <?php endif; ?>
                            <?php if ($row["price_c"] != 0): ?>
                            <option data-type="price_c" value="<?= $row["price_c"] ?>">Cold : <?= $row["price_c"] ?> Bath</option>
                            <?php endif; ?>
                            <?php if ($row["price_f"] != 0): ?>
                            <option data-type="price_f" value="<?= $row["price_f"] ?>">Fleppe : <?= $row["price_f"] ?> Bath</option>
                            <?php endif; ?>
                        </select>
                        <label for="Comment">Option</label>
                        <select class="custom-select mb-3" name="comment">
                            <option value="">Normal sweet 50%</option>
                            <optgroup label="Sweet">
                                    <option value="No Sweet">No Sweet</option>
                                    <option value="Low sweet 25%">Low sweet 25%</option>
                                    <option value="add sweet 25%">add sweet 25%</option>
                                    <option value="add sweet 50%">add sweet 50%</option>
                            <?php if ($row['type_2'] == 'Coffee'): ?>
                            <optgroup label="Shot">
                                <option value="Single Shot +20 Bath">Single Shot +20 Bath</option>
                                <option value="Double Shot +40 Bath">Double Shot +40 Bath</option>
                                <option value="Triple Shot +60 Bath">Triple Shot +60 Bath</option>
                            </optgroup>
                            <?php endif; ?>
                            <?php if ($row['type_2'] == 'Tea'): ?>
                            <optgroup label="Topping">
                                <option value="Bubble +5 Bath">Bubble +5 Bath</option>
                                <option value="Milk Pudding +10 Bath">Milk Pudding +10 Bath</option>
                                <option value="Wip Cheese +20 Bath">Wip Cheese +20 Bath</option>
                            </optgroup>
                                <?php endif; ?>
                        </select>
                        </div>
                    </div>                   
                </div>
                <?php
                }
            }
            ?>           
            </div>
            
            <h1>Baked</h1>
            <div class="row">
                <?php
                // Connect to database (code not shown)

                $sql = "SELECT p.name, p.image, p.price_h, p.price_c, p.price_f,p.type_1, t.total_qty
                FROM (
                    SELECT id_product, SUM(qty) AS total_qty
                    FROM order_detail
                    WHERE status = 'Yes'
                    GROUP BY id_product
                ) AS t
                INNER JOIN products p ON t.id_product = p.id_product
                WHERE p.type_1 = 'Baked' 
                ORDER BY t.total_qty DESC
                LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-3 col-md-6 mb-4">                        
                        <div class="card">
                            <img src="<?= $row["image"] ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                            <h6 style="font-size: 15px;" class="card-title"><?= $row["name"] ?></h6>
                            <p class="card-text">Price: <?= $row["price_h"] ?> Bath</p>
                            </div>  
                        </div>                      
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
            <h1>Dished</h1>
            <div class="row">
                <?php
                // Connect to database (code not shown)

                $sql = "SELECT p.name, p.image, p.price_h, p.price_c, p.price_f,p.type_1, t.total_qty
                FROM (
                    SELECT id_product, SUM(qty) AS total_qty
                    FROM order_detail
                    WHERE status = 'Yes'
                    GROUP BY id_product
                ) AS t
                INNER JOIN products p ON t.id_product = p.id_product
                WHERE p.type_1 = 'Dished' 
                ORDER BY t.total_qty DESC
                LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card">
                            <img src="<?= $row["image"] ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                            <h6 style="font-size: 15px;" class="card-title"><?= $row["name"] ?></h6>
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