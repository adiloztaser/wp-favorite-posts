<div class="sui-wrap">
	<div class="sui-floating-notices">
		<div role="alert" id="wpfp-status-message" class="sui-notice" aria-live="assertive" tabindex="-1">
			<div class="sui-notice-content">
				<div class="sui-notice-message">
					<span class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></span>
					<p></p>
				</div>
			</div>
		</div>
	</div>

	<div class="sui-header">
		<h1 class="sui-header-title"><?php _e( 'WP Favorite Posts' ); ?></h1>
		<div class="sui-actions-left">
			<span class="sui-tag sui-tag-purple">
				<?php echo WPFP_VERSION; ?>
			</span>
		</div>
	</div>

	<div class="sui-row">

		<div class="sui-col-md-9">

			<form class="wpfp-settings-form">
				<div class="sui-box">

					<div class="sui-box-header">
						<h2 class="sui-box-title">
							<?php _e( 'Options', 'wp-favorite-posts' ); ?>
							<span class="sui-icon-widget-settings-config" aria-hidden="true"></span>
						</h2>
					</div>

					<div class="sui-box-body">

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<label for="opt_only_registered" class="sui-settings-label"><?php _e( 'Only <strong>registered users</strong> can favorite', 'wp-favorite-posts' ); ?></label>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="checkbox" id="opt_only_registered" name="opt_only_registered" <?php checked( $wpfp_options['opt_only_registered'], 1 ); ?> />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Auto show favorite link', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<select class="sui-select" name="autoshow">
										<option value="custom" <?php selected( $wpfp_options['autoshow'], 'custom' ); ?>>Custom</option>
										<option value="custom" <?php selected( $wpfp_options['autoshow'], 'after' ); ?>>After post</option>
										<option value="custom" <?php selected( $wpfp_options['autoshow'], 'before' ); ?>>Before post</option>
									</select>
									<p class="sui-description">* Custom: insert <strong>&lt;?php wpfp_link() ?&gt;</strong> wherever you want to show favorite link.</p>
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Before Link Image', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<?php
									$images   = array();
									$images[] = 'star.png';
									$images[] = 'heart.png';
									$images[] = 'bullet_star.png';
									foreach ( $images as $img ) :
										?>

									<label for="<?php echo $img; ?>">

										<span class="sui-radio">
											<input type="radio" name="before_image" id="<?php echo $img; ?>" value="<?php echo $img; ?>" <?php checked( $wpfp_options['before_image'], $image ); ?> />
											<span aria-hidden="true"></span>
										</span>

										<img src="<?php echo WPFP_DIST_URL; ?>/images/<?php echo $img; ?>" alt="<?php echo $img; ?>" title="<?php echo $img; ?>" class="wpfp-img" />
									</label>
									<br />
									<?php endforeach; ?>

									<label for="custom" class="">
										<span class="sui-radio">
											<input type="radio" name="before_image" id="custom" value="custom" <?php checked( $wpfp_options['before_image'], 'custom' ); ?> />
											<span aria-hidden="true"></span>
										</span>
										<label for="custom">Custom</label>

										<input type="custom_before_image" name="custom_before_image" value="<?php echo stripslashes( $wpfp_options['custom_before_image'] ); ?>" />
									</label>

									<br />

									<span class="sui-radio">
										<input type="radio" name="before_image" id="none" value="none" <?php checked( $wpfp_options['before_image'], 'none' ); ?> />
										<span aria-hidden="true"></span>
									</span>

									<label for="none" >None</label>
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Favorite post per page', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="post_per_page" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['post_per_page'] ); ?>" />
									<p class="sui-description">* This only works with default favorite post list page (wpfp-page-template.php).</p>
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Most favorited posts statistics', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<label for="stats-enabled">
										<input type="radio" name="statistics" id="stats-enabled" value="1" <?php checked( $wpfp_options['statistics'], 1 ); ?> />
										<span aria-hidden="true"></span>
										<span id="label-unique-id">Enabled</span>
									</label>

									<label for="stats-disabled">
										<input type="radio" name="statistics" id="stats-disabled" value="1" <?php checked( $wpfp_options['statistics'], 1 ); ?> />
										<span aria-hidden="true"></span>
										<span id="label-unique-id">Disabled</span>
									</label>
								</div>
							</div>
						</div>

					</div>

					<div class="sui-box-footer">
						<div class="sui-actions-right">
							<button type="button" class="wpf-save-button sui-button sui-button-blue">
								<span class="sui-loading-text">Save Changes</span>
								<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				</div>


				<div class="sui-box">

					<div class="sui-box-header">
						<h2 class="sui-box-title">
							<?php _e( 'Label Settings', 'wp-favorite-posts' ); ?>
							<span class="sui-icon-widget-settings-config" aria-hidden="true"></span>
						</h2>
					</div>

					<div class="sui-box-body">

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for add link', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="add_favorite" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['add_favorite'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for added', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="added" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['added'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for remove link', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="remove_favorite" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['remove_favorite'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for removed', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="removed" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['removed'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for clear link', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="clear" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['clear'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for cleared', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="cleared" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['cleared'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for favorites are empty', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="favorites_empty" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['favorites_empty'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for [remove] link', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<input type="text" name="rem" class="sui-form-control" value="<?php echo stripslashes( $wpfp_options['rem'] ); ?>" />
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for favorites saved to cookies', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<textarea class="sui-form-control" name="cookie_warning" rows="3" cols="35"><?php echo stripslashes( $wpfp_options['cookie_warning'] ); ?></textarea>
								</div>
							</div>
						</div>

						<div class="sui-box-settings-row">
							<div class="sui-box-settings-col-1">
								<span class="sui-settings-label"><?php _e( 'Text for "only registered users can favorite" error message', 'wp-favorite-posts' ); ?></span>
							</div>

							<div class="sui-box-settings-col-2">
								<div class="sui-form-field">
									<textarea class="sui-form-control" name="text_only_registered" rows="2" cols="35"><?php echo stripslashes( $wpfp_options['text_only_registered'] ); ?></textarea>
								</div>
							</div>
						</div>

					</div>

					<div class="sui-box-footer">
						<div class="sui-actions-right">
							<button type="button" class="wpf-save-button sui-button sui-button-blue">
								<span class="sui-loading-text">Save Changes</span>
								<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				</div>
			</form>

		</div>

		<div class="sui-col-md-3">

			<div class="sui-box">
				<div class="sui-box-header">
					<h2 class="sui-box-title">
						<?php _e( 'Help', 'wp-favorite-posts' ); ?>
						<span class="sui-icon-help-support" aria-hidden="true"></span>
					</h2>
				</div>

				<div class="sui-box-body">
					<p>If you need help about WP Favorite Posts plugin you can go <a href="http://wordpress.org/tags/wp-favorite-posts" target="_blank">plugin's wordpress support page</a>. I or someone else will help you.</p>
				</div>
			</div>

		</div>

	</div>
</div>
