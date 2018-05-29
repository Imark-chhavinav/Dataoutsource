<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!-- Slider -->
<?php 
	/* Slider Post */
	$args = array( 'order' => 'ASC', 'post_type' => 'slider');
	$my_query = new WP_Query( $args );
	$count = $my_query->post_count;
?>

<div class="banner">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
				for($y=1;$y<=$count;$y++) {
					if($y == 1) {
						echo'<li data-target="#carousel-example-generic" data-slide-to="'.$y.'" class="active"></li>';
					} else {
						echo'<li data-target="#carousel-example-generic" data-slide-to="'.$y.'"></li>';
					}
				}
			?>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<?php
				$x = 1;
				while ( $my_query->have_posts() ) : $my_query->the_post();
					if($x == 1):
						?><div class="item active" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');"></div><?php
					else:
						?><div class="item" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');"></div><?php
					endif;
					$x++;
				endwhile;
			?>
			<?php wp_reset_query(); ?>
		</div>
	</div>

	<div class="outer-text">
		<?php $image = get_field('banner_logo','option'); ?>
		<div class="inr-box">
			<span>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
				<strong><?php the_field('banner_text','option'); ?></strong>
			</span>
		</div>
	</div>
</div>
<section class="aboutus">
	<span class="arowdiv"><i class="fa fa-angle-down" aria-hidden="true"></i></span>

	<div class="container">
		<div class="row">
			<div class="about-div">
				<?php
					$about =  get_field('second_section_page_select');
					$about_img =  get_field('home_page_image',$about->ID);
					$about_link = get_the_permalink($about->ID);
				?>

				<span class="backimg"><img src="<?php echo $about_img['url'] ?>" alt="<?php echo $about_img['title'] ?>"/></span>

				<div class="col-md-9">
					<h1><?php echo wpautop($about->post_title); ?></h1>
					<?php echo wpautop($about->post_content); ?>
					<a href="<?php echo $about_link; ?>" class="defaultbtn">
						Read More
						<span class="arowicon">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow-01.svg" alt="image"/>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="horizontal-tab">
	<div class="container">
		<div class="row">
			<div class="col-md-12 basic-tab">
				<h1>Our services</h1>
				<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
					<?php 
						/* Service Post */
						$Service_args = array( 'order' => 'ASC', 'post_type' => 'services');
						$Service_query = new WP_Query( $Service_args );
					?>
					<ul class="nav nav-tabs"  role="tablist">
						<?php
							$content = array();
							$Serv = 1;
							while ( $Service_query->have_posts() ) : $Service_query->the_post();
								if( $Serv == 1 ):
									?>
										<li role="presentation" class="active">
												<a href="#<?php echo $Serv; ?>" id="<?php echo $Serv; ?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $Serv; ?>" aria-expanded="false"><?php
									else:
										?>
										<li role="presentation" class="">
											<a href="#<?php echo $Serv; ?>" id="<?php echo $Serv; ?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $Serv; ?>" aria-expanded="false">
												<?php
													endif;

													$svg = home_svg(get_the_ID());
													echo $svg;
												?>
												<?php the_title(); ?>
											</a>
											<?php
												if( $Serv == 1 ):
													?><span id="triangle-up"></span><?php
												endif;
												$content[] = array(wpautop(get_the_content()),get_the_permalink());
											?>
										</li>
									<?php
								$Serv++;
							endwhile;
						?>
					</ul>

					<div class="tab-content" >
						<?php
							$z = 1;
							foreach($content as $keys=>$value):
								if($z == 1):
									?><div class="tab-pane fade active in" role="tabpanel" id="<?php echo $z; ?>" aria-labelledby="<?php echo $z; ?>-tab">
										<div class="panel-content">
											<?php echo substr($value[0], 0, 550).'...'; ?>
										</div>
										<a href="<?php echo  site_url('/services/#'.$z); ?>" class="defaultbtn">Read More<span class="arowicon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow-01.svg" alt="image"></span></a>
										</div><?php
								else:
									?><div class="tab-pane fade" role="tabpanel" id="<?php echo $z; ?>" aria-labelledby="<?php echo $z; ?>-tab">
										<div class="panel-content">
											<?php echo substr($value[0], 0, 550).'...'; ?>
										</div>
										<a href="<?php echo  site_url('/services/#'.$z); ?>" class="defaultbtn">Read More<span class="arowicon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow-01.svg" alt="image"></span></a>	
										</div><?php
								endif;
							$z++;
							endforeach;
						?>
					</div>
				</div>			
			</div>
		</div>
	</div>
</section>

<section class="tabdiv">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
					<?php
						/* Data Center Post */
						$Data_args = array( 'order' => 'ASC', 'post_type' => 'datacenter' , 'posts_per_page' => 6);
						$Data_query = new WP_Query( $Data_args );
					?>

					<ul class="nav nav-tabs "  role="tablist">
						<?php
							$D = 1;
							$Dcontent = array();
							while ( $Data_query->have_posts() ) : $Data_query->the_post();
								$icon = get_field( 'front_end_icon' ); 
								if($D == 1):
									?>
										<li role="presentation" class="active">
											<a href="#<?php echo $D.'_data'; ?>" id="<?php echo $D.'_data'; ?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $D.'_data'; ?>" aria-expanded="true">
												<img src="<?php echo $icon['url']; ?>" alt="<?php the_title(); ?>">
												<?php
													//$svgs = home_svg(get_the_ID());
													//echo $svgs;
													the_title();
												?>
											</a>
										</li>
									<?php
								else:
									?>
										<li role="presentation">
											<a href="#<?php echo $D.'_data'; ?>" id="<?php echo $D.'_data'; ?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $D.'_data'; ?>" aria-expanded="false">
												<img src="<?php echo $icon['url']; ?>" alt="<?php the_title(); ?>">
												<?php 
													//$svgs = home_svg(get_the_ID());
													//echo $svgs;
													the_title();
												?>
											</a>
										</li>
									<?php
								endif;

								$Dcontent[] = array(get_the_title(),get_the_content(),get_the_permalink());
								$D++;
							endwhile;
						?>						
					</ul>

					<div class="tab-content">
						<?php
							$Dc = 1;
							foreach($Dcontent as $Dcont):
								if($Dc == 1):
									?>
										<div class="tab-pane fade active in" role="tabpanel" id="<?php echo $Dc.'_data'; ?>" aria-labelledby="<?php echo $Dc.'_data'; ?>-tab">
											<h1><?php echo $Dcont[0]; ?></h1>
											<?php echo wpautop($Dcont[1]); ?>
											<a href="<?php echo $Dcont[2]; ?>" class="btn-border">View detail</a>
										</div>
									<?php
								else:
									?>
										<div class="tab-pane fade" role="tabpanel" id="<?php echo $Dc.'_data'; ?>" aria-labelledby="<?php echo $Dc.'_data'; ?>-tab">
											<h1><?php echo $Dcont[0]; ?></h1>
											<?php echo wpautop($Dcont[1]); ?>
											<a href="<?php echo $Dcont[2]; ?>" class="btn-border">View detail</a>
										</div>
									<?php
								endif;
								$Dc++;
							endforeach;
						?>
					</div> 
				</div>
			</div>
		</div>
	</div>
</section>

<section class="latestdata-div">
	<div class="container">
		<div class="row cRow">
			<div class="col-md-5 ">
				<h1>LATEST DATA <br>OUTSOURCE GROUP NEWS</h1>

				<div class="twitter">
					<a class="twitter-timeline" href="https://twitter.com/DataCloudAUS?ref_src=twsrc%5Etfw">Tweets by DataCloudAUS</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
			<div class="col-md-7">
				<?php 
					/* Service Post */
					/*$blog_args = array( 'posts_per_page'=>1,'order' => 'DESC', 'post_type' => 'post');
					$blog_query = new WP_Query( $blog_args );
					while ( $blog_query->have_posts() ) : $blog_query->the_post();
						?>
							<div class="leftdiv">
								<h2><?php the_title(); ?></h2>
								<?php the_excerpt(); ?>		
							</div>
							<div class="rytdiv">
								<img src="<?php echo get_the_post_thumbnail_url(null,'full'); ?>" alt="latestjob"/>
							</div>
						<?php
					endwhile;*/
				?>
				<div id="testimonials" class="owl-carousel owl-theme">
					<?php
						/* Data Center Post */
						$Test_args = array( 'order' => 'ASC', 'post_type' => 'testimonials' , 'posts_per_page' => 6);
						$Test_query = new WP_Query( $Test_args );
						while ( $Test_query->have_posts() ) : $Test_query->the_post(); 
						$Image = get_the_post_thumbnail_url( get_the_ID() , 'full' );	
						$content = wpautop(get_the_content());
						$Title = wpautop(get_the_title());
							?>

					<div class="testimonialItem">
						<div class="avatarContainer">
							<figure style="background-image: url(<?php echo $Image; ?>)"></figure>
						</div>
						<div class="testCon">
							<?php echo $content; ?>
							<div class="author-name"><?php echo $Title; ?></div>
						</div>
					</div>

					<?php	endwhile;	?>
				</div>
			</div>
		</div>

		<h1></h1>

	</div>
</section>

<div class="newsletr">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">   
				<form class="form-inline">
				<label>JOIN OUR NEWSLETTER</label>
				<div class="form-group newslettr-form">   
				<input type="text" class="form-control" placeholder="Enter your email ">
				<span class="iconcls"><i class="fa fa-envelope-o" aria-hidden="true"></i></span> <button type="submit" class="btn btn-default">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer();	?>