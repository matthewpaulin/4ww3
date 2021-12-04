<?php $title = 'Sample Gym | Rock Review'; ?>
<?php $currentPage = 'Sample Gym'; ?>
<?php include('header.php'); ?>
<body>
 <?php include('navbar.php'); ?>
<main class="mountain-bg">
    <!-- Title and rating -->
    <div class="primary-transparent-bg container">
        <h1 class="page-title"> Impact Climbing </h1>
        <div class="object-rating">
            <span class="rating-value">
                4.2
            </span>
            <span>
                <i class="fas fa-star"></i>
            </span>
            <span>
                <i class="fas fa-star"></i>
            </span>
            <span>
                <i class="fas fa-star"></i>
            </span>
            <span>
                <i class="fas fa-star"></i>
            </span>
            <span>
                <i class="fas fa-star-half"></i>
            </span>
            <p class="rating-count">
                based on 45 reviews
            </p>
        </div>
    </div>
    <!-- location image and map -->
    <div class="object-image">
        <img src="/assets/images/impact.jpeg" alt="Result Image">
    </div>
    <div class="object-image map-container">
        <div id="gym-location"></div>
    </div>
    <!-- location reviews -->
    <div>
        <ul class="sample-reviews">
            <li class="review">
                <div class="person">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>Michael Kipper</p>
                </div>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <!-- [2]M. Kipper, 2020. -->
                <p class="comment">Great facility - plenty of room, things to do and routes to climb. Staff is
                    friendly and helpful.
                    Very kid friendly.</p>
            </li>

            <li class="review">
                <div class="person">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>Jessica Cheung</p>
                </div>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <!-- [4]J. Cheung, 2018. -->
                <p class="comment">This place is epic. Just. Epic. Friendly staff, great routes of all levels of
                    both bouldering and
                    climbing. Family friendly atmosphere with a lounge area to just kick it. Highly recommend!!!</p>
            </li>

            <li class="review">
                <div class="person">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>Noah David</p>
                </div>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half"></i>
                </div>
                <!-- [3]N. David, 2019. -->
                <p class="comment">Wonderful climbing gym. Lots of variety of top rope, lead and bouldering for all
                    levels from
                    beginner to expert. Very friendly environment with great staff. Route setters make adjustments
                    almost every day so there's always new stuff to try. Tons of parking, great location. Couldn't
                    ask for much more!</p>
            </li>
        </ul>
    </div>
</main>

<?php include('footer.php'); ?>
<script src="index.js"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9fhzvQN-dCsJmqIf7ShehJxlkHfDaQZ8&callback=initGymMap&libraries=&v=weekly"
async
></script>
</body>
</html>
