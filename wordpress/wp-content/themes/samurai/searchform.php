<?php

?>
<form role="search" method="get" id="search-form" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>" >
	<div class="input-group stylish-input-group">
		<label class="screen-reader-text" for="s"> <?php esc_html__( 'Search for:', 'samurai' ) ?></label>
		<span class="input-group-addon button-group">
		   	<button type="submit" id="searchsubmit" class="submit-btn" value="<?php echo esc_attr__( 'Search', 'samurai' ); ?>">
		   		<i class="fa fa-search"></i>
		   	</button>
		</span>
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr__( 'Search', 'samurai' ); ?>" name="s" id="s" class="form-control" />		
	</div>
</form>