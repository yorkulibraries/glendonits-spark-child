<?php
/**
 * Template Name: Home page
 *
 * Responsive SPARK homepage template.
 *
 * @package WordPress
 * @subpackage Glendon ITS SPARK Child
 */

if ( isset( $_GET['l'] ) ) {
	$requested_language = sanitize_key( wp_unslash( $_GET['l'] ) );
	if ( in_array( $requested_language, array( 'en', 'fr' ), true ) ) {
		$_SESSION['slang'] = $requested_language;
	}
}

$spark_language = isset( $_SESSION['slang'] ) && is_string( $_SESSION['slang'] )
	? sanitize_key( $_SESSION['slang'] )
	: 'en';
$spark_language = in_array( $spark_language, array( 'en', 'fr' ), true ) ? $spark_language : 'en';
$is_french      = 'fr' === $spark_language;
$page_id        = get_queried_object_id();
$parent_uri     = get_template_directory_uri();
$switch_language = $is_french ? 'en' : 'fr';
$switch_label    = $is_french ? 'English' : 'Français';
$switch_url      = add_query_arg( 'l', $switch_language, get_permalink( $page_id ) );

get_header();
?>

<div class="container wrapper spark-homepage" lang="<?php echo esc_attr( $spark_language ); ?>">
	<main id="main-content" class="py-4 py-lg-4">
		<header class="spark-homepage-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-4">
			<div>
				<h1 class="visually-hidden">SPARK</h1>
				<img
					class="spark-homepage-logo img-fluid"
					src="<?php echo esc_url( $parent_uri . '/img/spark_logo' . ( $is_french ? '_fr' : '' ) . '.png' ); ?>"
					alt="<?php echo esc_attr( $is_french ? 'Trousse académique pour étudiants' : 'SPARK is the student papers and academic research kit.' ); ?>"
					width="735"
					height="111"
				>
			</div>
			<div class="d-flex flex-wrap gap-2">
				<?php if ( ! $is_french ) : ?>
					<a class="btn btn-outline-primary" href="<?php echo esc_url( home_url( '/faculty-teaching-with-spark-what-is-spark/' ) ); ?>">
						Faculty Guide
					</a>
				<?php endif; ?>
				<a class="btn btn-outline-secondary" href="<?php echo esc_url( $switch_url ); ?>" lang="<?php echo esc_attr( $switch_language ); ?>">
					<?php echo esc_html( $switch_label ); ?>
				</a>
			</div>
		</header>

		<?php
		$primary_location = $is_french ? 'homepage-fr' : 'homepage';
		if ( has_nav_menu( $primary_location ) ) :
			?>
			<nav class="spark-homepage-primary mb-4 mb-lg-5" aria-label="<?php echo esc_attr( $is_french ? 'Navigation principale' : 'Main navigation' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => $primary_location,
						'container'      => false,
						'menu_class'     => 'spark-primary-menu',
						'depth'          => 2,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<section class="spark-homepage-content row g-4 align-items-start px-2" aria-labelledby="spark-homepage-content-title">
			<h2 id="spark-homepage-content-title" class="visually-hidden">
				<?php echo esc_html( $is_french ? 'Présentation de SPARK' : 'About SPARK' ); ?>
			</h2>
			<?php
			$video_language = $is_french ? 'fr' : 'en';
			$video_file     = get_field( 'video_file_' . $video_language, $page_id );
			$caption_file   = get_field( 'video_file_captions_' . $video_language, $page_id );
			$mp4_file       = get_field( 'video_file_mac_' . $video_language, $page_id );
			$transcript     = spark_get_transcript( $page_id, $video_language );
			$has_media      = $video_file || '' !== trim( wp_strip_all_tags( $transcript ) );
			?>
			<div class="spark-homepage-copy <?php echo esc_attr( $has_media ? 'col-12 col-lg-7' : 'col-12' ); ?>">
				<?php if ( $is_french ) : ?>
					<?php
					$french_content = get_field( 'content_fr', $page_id );
					if ( $french_content ) {
						echo apply_filters( 'the_content', $french_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				<?php else : ?>
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							the_content();
						endwhile;
					endif;
					?>
				<?php endif; ?>
			</div>

			<?php if ( $has_media ) :
				?>
				<div class="spark-homepage-media col-12 col-lg-5">
					<div class="card text-bg-primary h-100">
						<!-- <div class="card-header">
							<h2 class="h5 mb-0"><?php echo esc_html( $is_french ? 'Vidéo SPARK' : 'SPARK video' ); ?></h2>
						</div> -->
						<div class="card-body">
					<?php
					if ( $video_file ) {
						echo spark_video_widget( $page_id, $parent_uri, $video_file, $caption_file, $mp4_file, ! is_null( $transcript ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					echo $transcript; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<?php
		$red_location  = $is_french ? 'homepage-bottom-navbar-red-fr' : 'homepage-bottom-navbar-red';
		$grey_location = $is_french ? 'homepage-bottom-navbar-grey-fr' : 'homepage-bottom-navbar-grey';
		?>

		<?php if ( has_nav_menu( $red_location ) ) : ?>
			<nav class="spark-homepage-links spark-homepage-links-primary mt-4 mt-lg-5" aria-label="<?php echo esc_attr( $is_french ? 'Liens principaux' : 'Featured links' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => $red_location,
						'container'      => false,
						'menu_class'     => 'spark-link-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<div class="spark-homepage-footer d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mt-3">
			<?php if ( has_nav_menu( $grey_location ) ) : ?>
				<nav class="spark-homepage-links-secondary" aria-label="<?php echo esc_attr( $is_french ? 'Autres liens' : 'Additional links' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => $grey_location,
							'container'      => false,
							'menu_class'     => 'spark-link-menu spark-link-menu-secondary',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>
			<a class="spark-learning-commons" href="https://learningcommons.yorku.ca/" target="_blank" rel="noopener noreferrer">
				<img
					src="<?php echo esc_url( $parent_uri . '/img/learning_commons_logo' . ( $is_french ? '_fr' : '' ) . '.jpg' ); ?>"
					alt="<?php echo esc_attr( $is_french ? 'Carrefour d’apprentissage' : 'Learning Commons' ); ?>"
					width="117"
					height="36"
				>
				<span class="visually-hidden"><?php echo esc_html( $is_french ? '(ouvre dans un nouvel onglet)' : '(opens in a new tab)' ); ?></span>
			</a>
		</div>

		<footer class="spark-homepage-license border-top mt-4 pt-3">
			<a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">
				<img
					class="spark-license-badge"
					src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png"
					alt="<?php echo esc_attr( $is_french ? 'Licence Creative Commons' : 'Creative Commons License' ); ?>"
					width="88"
					height="31"
				>
			</a>
			<?php if ( $is_french ) : ?>
				<p>Cette œuvre est mise à disposition selon les termes de la <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Licence Creative Commons Attribution - Pas d’Utilisation Commerciale - Partage dans les Mêmes Conditions 4.0 International</a>.</p>
			<?php else : ?>
				<p>This work is licensed under a <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</p>
			<?php endif; ?>
		</footer>
	</main>
</div>

<?php
get_footer();
