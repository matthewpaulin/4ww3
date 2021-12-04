<?php $title = 'Rock Review | Search Results'; ?>
<?php $currentPage = 'Search Results'; ?>
<?php include('header.php'); ?>
<script src="index.js"></script>
<body>
<?php 
    include('navbar.php'); 
    require_once 'includes/db.php';
    $search = $_GET["search"];
    !empty($search) ? $search : "";
    $rating = $_GET["rating"];
    !empty($rating) ? $rating : 0;
    $lat = $_GET["lat"];
    $lng = $_GET["lng"];

    if(!empty($lat)){ //get search results based on location
        try{
            $query = "SELECT gyms.title, gyms.details, gyms.lat, gyms.lng, gyms.image_url, gyms.website, gyms.gym_id, average, (
            3959 * acos(
                cos(radians(:mylat)) *
                cos(radians(gyms.lat)) *
                cos(radians(gyms.lng) - radians(:mylng)) +
                sin(radians(:mylatalso)) *
                sin(radians(gyms.lat))
            )
            ) AS distance
            FROM gyms INNER JOIN 
            (SELECT gym_id, AVG(review) as average
                FROM reviews
                GROUP BY gym_id) as subquery
            ON gyms.gym_id=subquery.gym_id
            HAVING distance < 30
            ORDER BY distance
            LIMIT 0, 20";

            $stmt = $conn->prepare($query);
            $stmt->execute(array( 
                'mylat' => $lat,
                'mylatalso' => $lat,
                'mylng' => $lng,
            ));
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
        } catch(PDOException $e) {
            header("location: ../index.php");
            exit();
        }
    } else{ //get search results 
        try{
            $lower = floor($rating);
            $upper = $lower!=0 ? $lower+1 : 6;
            $query = "SELECT gyms.title, gyms.details, gyms.lat, gyms.lng, gyms.image_url, gyms.website, gyms.gym_id, average 
            FROM gyms INNER JOIN 
            (SELECT gym_id, AVG(review) as average
                FROM reviews
                GROUP BY gym_id) as subquery
            ON gyms.gym_id=subquery.gym_id
            WHERE gyms.title LIKE :search AND average >= :lowerbound  AND average < :upperbound
            GROUP BY gyms.gym_id
            ORDER BY average DESC
            LIMIT 30";
            $stmt = $conn->prepare($query);
            $stmt->execute(array( 
                'upperbound' => $upper,
                'lowerbound' => $lower,
                'search' => '%'.$search.'%',
            ));
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
           
           
        } catch(PDOException $e) {
            header("location: ../index.php");
            exit();
        }
    }
    ?> 
    <main class="mountain-bg">
        <?php
        if(!empty($results)){
            ?>
            <h1 class="page-title primary-transparent-bg container"> Results </h1>
            
            <!-- map with search results -->
            <div class="container">
                <div id="result-location"></div>
            </div>

            <!-- data (hidden) -->
            <div id="result-location-data"><?php echo json_encode($results, true); ?></div>

            <!-- results with title, rating, img, and description -->
            <ul class="sample-results container">
            <?php
            foreach ($results as &$result) {
                $title = $result["title"];
                $stars = $result["average"];
                $details = $result["details"];
                $image = $result["image_url"];
                $website = $result["website"];
                $id = $result["gym_id"];
                ?>
                <li class="result-info">
                    <div class="result-title-contaier">
                        <h2 class="result-name">
                            <!-- link to result page -->
                            <?php 
                            print '<a href="/gym.php?id='.$id.'&name='.$title.'">';
                                echo $title;
                            print '</a>';
                        ?>
                        </h2>
                        <!-- link to website -->
                        <?php 
                            print '<a href="'.$website.'">
                                <i class="fas fa-external-link-alt"></i>
                                </a>';
                        ?>
                    </div>
                    <div class="result-review">
                        <?php 
                            while($stars >= 1.0){
                                print '
                                    <span>
                                        <i class="fas fa-star"></i>
                                    </span>';
                                $stars--; 
                            }
                            if($stars > 0.1){
                                print '<span>
                                        <i class="fas fa-star-half"></i>
                                    </span> ';
                            }
                        ?>
                    </div>
                    <p class="result-description">
                        <?php echo $details; ?>
                    </p>
                    <div class="result-image">
                    <?php 
                        print '<img src="'.$image.'" alt="'.$title.'">';
                    ?>
                        
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
        } else{
            ?>
            <h1 class="page-title primary-transparent-bg container"> No results to display </h1>
            <?php
        }
    ?>
    </main> 

<?php include('footer.php'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9fhzvQN-dCsJmqIf7ShehJxlkHfDaQZ8&callback=initDynamicMap&libraries=&v=weekly" async></script>


</body>
</html>
		
