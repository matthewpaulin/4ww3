<?php $title = 'Sample Results | Rock Review'; ?>
<?php $currentPage = 'Sample Results'; ?>
<?php include('header.php'); ?>
<body>
 <?php include('navbar.php'); ?>
<main class="mountain-bg">
    <h1 class="page-title primary-transparent-bg container"> Results </h1>

    <!-- map with search results -->
    <div class="container">
        <div id="result-location"></div>
    </div>
    

    <!-- sample results with title, rating, img, and description -->
    <ul class="sample-results container">
        <li class="result-info">
            <div class="result-title-contaier">
                <h2 class="result-name">
                    <a href="/individual_sample.html">
                        Impact Climbing
                    </a>
                </h2>
                <a href="https://www.impactclimbing.com/">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
            <div class="result-review">
                <span>
                    <i class="fas fa-star"></i>
                </span>
                <span>
                    <i class="fas fa-star"></i>
                </span>
                <span>
                    <i class="fas fa-star-half"></i>
                </span>
            </div>
            <p class="result-description">
                IMPACT is Canada’s number one climbing wall, ninja warrior course and adventure play structure
                manufacturer.
                From inception to execution, we make your dreams a reality. With over a decade of building and
                developing experience, we are your climbing wall experts.
                IMPACT is climbing, adventure, design and development. We offer complete turn-key solutions in
                the climbing and fitness industry to get your business geared for success.
            </p>
            <div class="result-image">
                <img src="/assets/images/impact.jpeg" alt="Impact climbing gym">
            </div>
        </li>

        <li class="result-info">


            <div class="result-title-contaier">
                <h2 class="result-name">
                    <a href="#">
                        True North Climbing
                    </a>
                </h2>
                <a href="https://www.truenorthclimbing.com/">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
            <div class="result-review">
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
            </div>
            <p class="result-description">
                I would call myself a hard-core recreational climber – hard-core because of how much I love it,
                not because I’m very good at it. I started climbing when I was 45, not in the best of shape, but
                I kept climbing because it made me feel tremendous joy. I want to share that same joy and love
                that I have for climbing with as many people as I can.
                John Gross - Owner
            </p>
            <div class="result-image">
                <img src="/assets/images/trueNorth.jpeg" alt="True North Climbing">
            </div>
        </li>
    </ul>
</main>

<?php include('footer.php'); ?>
<script src="index.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9fhzvQN-dCsJmqIf7ShehJxlkHfDaQZ8&callback=initResultsMap&libraries=&v=weekly"
    async
></script>
		
</body>
</html>
