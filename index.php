<?php $title = 'Rock Review'; ?>
<?php $currentPage = 'Home'; ?>
<?php include('header.php'); ?>
<body>
 <?php include('navbar.php'); ?>
<main class="mountain-bg">
    <!-- Intro blurb -->
    <p class="welcome container">
        Welcome to Rock Review where our goal is to provide an easy way to pick
        your next climbing destination. Search by location or by ratings and we
        will provide climbing gyms that match your criteria.
    </p>

    <!-- Search form -->
    <form class="search" action="results.php" method="get" id="searchform">
        <!-- Search bar and search icon -->
        <div class="searchbar">
            <input type="search" placeholder="Search" name="search" autofocus />
            <button type="submit" value="submit" class="search-button">
                <i class="search-icon fas fa-search fa-3x"></i>
                <i class="search-icon fas fa-search fa-2x"></i>
            </button>
        </div>
        <!-- Find gyms near me -->

        <button class="gym-near-me" type="button" onclick="gymsNearMe()">
            Find gyms near me
        </button>

        <!-- Rating filter -->
        <div class="select-dropdown">
            <select name="rating" form="searchform">
                <option value="" selected disabled hidden class="select-dropdown-option">
                    Rating
                </option>
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
    </form>
</main>

<?php include('footer.php'); ?>

<script src="index.js"></script>
</body>
</html>
		
		


