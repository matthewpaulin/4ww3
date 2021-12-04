<?php 
    $gymName = !empty($_GET["name"]) ? $_GET["name"] : "Gym";
    $title = 'Rock Review | '.$gymName;
    $currentPage = $gymName; 
    include('header.php'); 
?>
<script src="index.js"></script>
<body>

<?php 
    include('navbar.php'); 
    require_once 'includes/db.php';
    if (isset($_GET["id"])){
        try{
            $query = "SELECT * FROM gyms WHERE gym_id = :gym_id";
            $stmt = $conn->prepare($query);
            $stmt->execute([ 'gym_id' => $_GET["id"] ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            if($result){ // gym exists => get reviews
                $query = "SELECT reviews.review, reviews.details, users.fname, users.lname
                    FROM reviews INNER JOIN users 
                    ON users.uid=reviews.uid
                    WHERE reviews.gym_id = :gym_id";
                $stmt = $conn->prepare($query);
                $stmt->execute([ 'gym_id' => $_GET["id"] ]);
                $reviews = $stmt->fetchAll();
                $stmt->closeCursor();
                // get overall rating
                $avg = 0;
                foreach ($reviews as &$review) {
                    $avg = $avg + $review['review'] / count($reviews);
                }
                $avg = number_format($avg, 1);
                ?> 
                <main class="mountain-bg">
                    <!-- Title and rating -->
                    <div class="primary-transparent-bg container">
                        <h1 class="page-title"> <?php echo $result['title']; ?> </h1>
                        <div class="object-rating">
                            <span class="rating-value">
                                <?php echo $avg; ?>
                            </span>
                            <?php 
                                while($avg >= 1.0){
                                    print '<span><i class="fas fa-star"></i></span>';
                                    $avg--; 
                                }
                                if($avg > 0.1){
                                    print '<span><i class="fas fa-star-half"></i></span> ';
                                }
                            ?>
                            <p class="rating-count">
                                based on <?php echo count($reviews); ?> reviews
                            </p>
                        </div>
                    </div>
                    <!-- location image and map -->
                    <div class="object-image">
                        <img src="<?php echo $result['image_url']; ?>" alt="<?php echo $result['title']; ?>.' image'">
                    </div>
                    <div class="primary-transparent-bg container">
                        <p>
                            <?php echo $result['details']; ?>
                        </p>
                    </div>
                    <div class="object-image map-container">
                        <div id="gym-location"></div>
                    </div>

                    <!-- map data (hidden) -->
                    <div id="object-data"><?php echo json_encode($result, true); ?></div>

                    <!-- location reviews -->
                    <?php
                    if(!empty($reviews)){
                        ?>
                        <div>
                            <ul class="sample-reviews">
                            <?php
                            foreach ($reviews as &$review) {
                                $full_name = $review['fname'] . ' ' . $review['lname']; 
                                $stars = $review["review"];
                                $details = $review["details"];
                                ?>
                                <li class="review">
                                    <div class="person">
                                        <i class="fas fa-user-circle fa-3x"></i>
                                        <p><?php echo $full_name; ?></p>
                                    </div>
                                    <div class="rating">
                                    <?php 
                                    while($stars >= 1.0){
                                        print '<i class="fas fa-star"></i>';
                                        $stars--; 
                                    }
                                    if($stars > 0.1){
                                        print '<i class="fas fa-star-half"></i>';
                                    }
                                    ?>
                                    </div>
                                    <p class="comment"><?php echo $details; ?></p>
                                </li>
                                <?php
                            }
                            ?>
                            </ul>
                        </div> 
                        <?php
                    } 
                    ?>
                    
			    <?php
				if(isset($_SESSION['user'])){
                    $_SESSION['gym_id'] = $_GET["id"];
                    $_SESSION['gym_title'] = $result['title'];
                    ?>
                    <form class="submission-form mt2" action="/includes/review.php" method="post" id="ratingform" enctype="multipart/form-data">
                        <?php
                            if(isset($_SESSION['review_message']) && !empty($_SESSION['review_message'])){
                                if($_SESSION['review_message']!=="success"){
                                    ?>
                                    <div id="errors">
                                        <?php
                                            echo $_SESSION['review_message']. "</div>";
                                            $_SESSION['review_message'] = '';
                                } else {
                                    ?>
                                    <div id="success">
                                        <?php
                                            echo "Review added successfully". "</div>";
                                            $_SESSION['review_message'] = '';
                                }
                            }
                        ?>
                        <!-- Rating filter -->
                        <div class="select-dropdown">
                            <select name="rating" form="ratingform">
                                <option value="1" id="one_star" class="select-dropdown-option">
                                    1 Star
                                </option>
                                <option value="2" id="two_star" class="select-dropdown-option">
                                    2 Star
                                </option>
                                <option
                                    value="3"
                                    id="three_star"
                                    class="select-dropdown-option"
                                >
                                    3 Star
                                </option>
                                <option
                                    value="4"
                                    id="four_star"
                                    class="select-dropdown-option"
                                >
                                    4 Star
                                </option>
                                <option
                                    value="5"
                                    id="five_star"
                                    class="select-dropdown-option"
                                >
                                    5 Star
                                </option>
                            </select>
                        </div>

                        <div class="form-input gym-description">
                            <label>Review Text</label>
                            <textarea name="review-text"></textarea>
                        </div>

                        <input type="submit" name="review" value="Submit Review" />
                    </form>
					<?php
				}
            ?>
            
                </main>
                <?php
            } else { //gym with this id doesn't exist
                header("location: /");
                exit();  
                echo "asdasdasdsa";
            }
        } catch(PDOException $e) {
            echo "sql error here";
            header("location: /");
            exit();
        }
    } else { //no id provided
        header("location: /");
        exit();  
    }
    
?>

<?php include('footer.php'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9fhzvQN-dCsJmqIf7ShehJxlkHfDaQZ8&callback=initDynamicGymMap&libraries=&v=weekly" async></script>

</body>
</html>
		
