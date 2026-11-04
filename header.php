<?php
/**
 * Use a child-owned York-style header for migrated SPARK pages.
 * Pages outside the Bootstrap 5 migration keep the parent header.
 *
 * @package WordPress
 * @subpackage Glendon ITS SPARK Child
 */

if ( ! glendonits_spark_is_bootstrap5_page() ) {
	require get_template_directory() . '/header.php';
	return;
}

$is_module_page = is_page() && (int) get_post_meta( get_queried_object_id(), 'spark_topic', true ) > 0;
$spark_language = isset( $_SESSION['slang'] ) && 'fr' === $_SESSION['slang'] ? 'fr' : 'en';
$is_french      = 'fr' === $spark_language;
$is_homepage    = is_page_template( 'home-page.php' );

if ( $is_module_page ) :
	?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#ffffff">
	<title><?php echo esc_html( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'spark-child-page spark-child-module' ); ?>>
<?php wp_body_open(); ?>
<a class="spark-skip-link" href="#main-content">
	<?php echo esc_html( $is_french ? 'Passer au contenu principal' : 'Skip to main content' ); ?>
</a>
<header class="spark-module-york-header">
	<div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 py-3">
		<a class="spark-york-logo" href="https://www.yorku.ca/" aria-label="<?php echo esc_attr( $is_french ? 'Université York' : 'York University' ); ?>">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/yorku-logo.jpg' ); ?>" alt="<?php echo esc_attr( $is_french ? 'Université York' : 'York University' ); ?>" width="140">
		</a>

		<div class="spark-york-tools d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
			<div class="dropdown">
				<button class="btn btn-outline-dark dropdown-toggle w-100" type="button" id="spark-module-popular-links-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo esc_html( $is_french ? 'Liens populaires' : 'Popular Links' ); ?>
				</button>
				<ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="spark-module-popular-links-toggle">
					<li><a class="dropdown-item" href="https://futurestudents.yorku.ca/program-search/"><?php echo esc_html( $is_french ? 'Programmes d’études' : 'Programs of Study' ); ?></a></li>
					<li><a class="dropdown-item" href="https://eclass.yorku.ca/">eClass</a></li>
					<li><a class="dropdown-item" href="https://www.yorku.ca/about/email/"><?php echo esc_html( $is_french ? 'Courriel' : 'Email' ); ?></a></li>
					<li><a class="dropdown-item" href="https://www.yorku.ca/about/faculty-staff/"><?php echo esc_html( $is_french ? 'Corps professoral et personnel' : 'Faculty & Staff' ); ?></a></li>
					<li><a class="dropdown-item" href="https://sfs.yorku.ca/"><?php echo esc_html( $is_french ? 'Services financiers' : 'Financial Services' ); ?></a></li>
					<li><a class="dropdown-item" href="https://www.library.yorku.ca/web/"><?php echo esc_html( $is_french ? 'Bibliothèques' : 'Libraries' ); ?></a></li>
					<li><a class="dropdown-item" href="https://atlas.yorku.ca/"><?php echo esc_html( $is_french ? 'Répertoire' : 'Directory' ); ?></a></li>
				</ul>
			</div>

			<form class="spark-york-search d-flex" method="get" action="https://www.yorku.ca/search/">
				<label class="visually-hidden" for="spark-module-york-search-input"><?php echo esc_html( $is_french ? 'Rechercher sur York' : 'Search York' ); ?></label>
				<input class="form-control" id="spark-module-york-search-input" type="search" name="q" placeholder="<?php echo esc_attr( $is_french ? 'Rechercher sur yorku.ca' : 'Search yorku.ca' ); ?>">
				<button class="btn btn-primary" type="submit">
					<svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 16 16" fill="none">
						<circle cx="6.5" cy="6.5" r="5.25" stroke="currentColor" stroke-width="1.5"></circle>
						<path d="m10.5 10.5 4 4" stroke="currentColor" stroke-width="1.5"></path>
					</svg>
					<span class="visually-hidden"><?php echo esc_html( $is_french ? 'Rechercher' : 'Search' ); ?></span>
				</button>
			</form>
		</div>
	</div>
</header>
	<?php
	return;
endif;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#ffffff">
	<title><?php echo esc_html( get_bloginfo( 'name' ) . ' | York University' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( $is_homepage ? 'spark-child-home' : 'spark-child-page' ); ?>>
<?php wp_body_open(); ?>

<a class="spark-skip-link" href="#main-content">
	<?php echo esc_html( $is_french ? 'Passer au contenu principal' : 'Skip to main content' ); ?>
</a>

<header class="spark-york-header">
	<div class="spark-york-branding">
		<div class="container d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 py-3">
			<a class="spark-york-logo" href="https://www.yorku.ca/" aria-label="<?php echo esc_attr( $is_french ? 'Université York' : 'York University' ); ?>">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/yorku-logo.jpg' ); ?>" alt="<?php echo esc_attr( $is_french ? 'Université York' : 'York University' ); ?>" width="140">
			</a>

			<div class="spark-york-tools d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
				<div class="dropdown">
					<button class="btn btn-outline-dark dropdown-toggle w-100" type="button" id="spark-popular-links-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<?php echo esc_html( $is_french ? 'Liens populaires' : 'Popular Links' ); ?>
					</button>
					<ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="spark-popular-links-toggle">
						<li><a class="dropdown-item" href="https://futurestudents.yorku.ca/program-search/"><?php echo esc_html( $is_french ? 'Programmes d’études' : 'Programs of Study' ); ?></a></li>
						<li><a class="dropdown-item" href="https://eclass.yorku.ca/">eClass</a></li>
						<li><a class="dropdown-item" href="https://www.yorku.ca/about/email/"><?php echo esc_html( $is_french ? 'Courriel' : 'Email' ); ?></a></li>
						<li><a class="dropdown-item" href="https://www.yorku.ca/about/faculty-staff/"><?php echo esc_html( $is_french ? 'Corps professoral et personnel' : 'Faculty & Staff' ); ?></a></li>
						<li><a class="dropdown-item" href="https://sfs.yorku.ca/"><?php echo esc_html( $is_french ? 'Services financiers' : 'Financial Services' ); ?></a></li>
						<li><a class="dropdown-item" href="https://www.library.yorku.ca/web/"><?php echo esc_html( $is_french ? 'Bibliothèques' : 'Libraries' ); ?></a></li>
						<li><a class="dropdown-item" href="https://atlas.yorku.ca/"><?php echo esc_html( $is_french ? 'Répertoire' : 'Directory' ); ?></a></li>
					</ul>
				</div>

				<form class="spark-york-search d-flex" method="get" action="https://www.yorku.ca/search/">
					<label class="visually-hidden" for="spark-york-search-input"><?php echo esc_html( $is_french ? 'Rechercher sur York' : 'Search York' ); ?></label>
					<input class="form-control" id="spark-york-search-input" type="search" name="q" placeholder="<?php echo esc_attr( $is_french ? 'Rechercher sur yorku.ca' : 'Search yorku.ca' ); ?>">
					<button class="btn btn-primary" type="submit">
						<svg aria-hidden="true" focusable="false" width="20" height="20" viewBox="0 0 16 16" fill="none">
							<circle cx="6.5" cy="6.5" r="5.25" stroke="currentColor" stroke-width="1.5"></circle>
							<path d="m10.5 10.5 4 4" stroke="currentColor" stroke-width="1.5"></path>
						</svg>
						<span class="visually-hidden"><?php echo esc_html( $is_french ? 'Rechercher' : 'Search' ); ?></span>
					</button>
				</form>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark spark-york-navigation" aria-label="<?php echo esc_attr( $is_french ? 'Navigation York' : 'York navigation' ); ?>">
		<div class="container">
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#spark-york-navigation-menu" aria-controls="spark-york-navigation-menu" aria-expanded="false" aria-label="<?php echo esc_attr( $is_french ? 'Afficher ou masquer la navigation' : 'Toggle navigation' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="spark-york-navigation-menu">
				<ul class="navbar-nav me-auto">
					<li class="nav-item"><a class="nav-link" href="https://futurestudents.yorku.ca/programsearch"><?php echo esc_html( $is_french ? 'Programmes d’études' : 'Programs of Study' ); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="https://about.yorku.ca/"><?php echo esc_html( $is_french ? 'À propos de York' : 'About York U' ); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="https://campuslife.yorku.ca/"><?php echo esc_html( $is_french ? 'Vie sur le campus' : 'Campus Life' ); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="https://futurestudents.yorku.ca/"><?php echo esc_html( $is_french ? 'Admissions' : 'Admissions' ); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="https://teachingandlearning.yorku.ca/"><?php echo esc_html( $is_french ? 'Enseignement et apprentissage' : 'Teaching & Learning' ); ?></a></li>
					<li class="nav-item"><a class="nav-link" href="https://www.yorku.ca/research/"><?php echo esc_html( $is_french ? 'Recherche' : 'Research' ); ?></a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
