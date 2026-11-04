<?php
/** Native page links keep keyboard behavior and tab order. */
$is_french    = isset( $_SESSION['slang'] ) && 'fr' === $_SESSION['slang'];
$previous_page = get_field( 'previous_page' );
$next_page     = get_field( 'next_page' );
$home_page     = add_query_arg( 'l', $is_french ? 'fr' : 'en', home_url( '/' ) );
?>
<nav class="content-bottom-navigation-page-controls" aria-label="<?php echo esc_attr( $is_french ? 'Navigation du module' : 'Module page navigation' ); ?>"<?php echo $is_french ? ' lang="fr"' : ''; ?>>
	<?php if ( $previous_page ) : ?>
		<a href="<?php echo esc_url( $previous_page ); ?>" class="content-bottom-back-button" rel="prev" aria-label="<?php echo esc_attr( $is_french ? 'Page précédente' : 'Previous page' ); ?>">
			<svg class="spark-page-control-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24">
				<path d="M19 12H5m7 7-7-7 7-7" />
			</svg>
			<span><?php echo esc_html( $is_french ? 'Précédent' : 'Previous' ); ?></span>
		</a>
	<?php else : ?>
		<span class="content-bottom-back-button-x" aria-hidden="true"></span>
	<?php endif; ?>
	<?php if ( $next_page ) : ?>
		<a href="<?php echo esc_url( $next_page ); ?>" class="content-bottom-next-button" rel="next" aria-label="<?php echo esc_attr( $is_french ? 'Page suivante' : 'Next page' ); ?>">
			<svg class="spark-page-control-icon" aria-hidden="true" focusable="false" viewBox="0 0 24 24">
				<path d="M5 12h14m-7-7 7 7-7 7" />
			</svg>
			<span><?php echo esc_html( $is_french ? 'Suivant' : 'Next' ); ?></span>
		</a>
	<?php else : ?>
		<a href="<?php echo esc_url( $home_page ); ?>" class="content-bottom-home-button" aria-label="<?php echo esc_attr( $is_french ? 'Accueil SPARK' : 'SPARK Home' ); ?>">
			<svg class="spark-page-control-icon spark-page-control-icon-home" aria-hidden="true" focusable="false" viewBox="0 0 24 24">
				<path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z" />
			</svg>
			<span><?php echo esc_html( $is_french ? 'Accueil' : 'Home' ); ?></span>
		</a>
	<?php endif; ?>
</nav>
