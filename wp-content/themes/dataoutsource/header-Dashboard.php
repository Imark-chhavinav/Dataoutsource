<?php
$user = wp_get_current_user();	if ( !is_user_logged_in() && $user->roles[0] != 'author' ) {  wp_redirect( site_url() );exit;} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Datacloud 365</title>
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.min.css" rel="stylesheet" >
    <link href="<?php echo get_template_directory_uri() ?>/Dashboard/css/style.css" rel="stylesheet">
</head>

<body <?php body_class(); ?> >
    
    
<?php  $current_user = wp_get_current_user();  ?>
    
    <header>
        <div class="container-fluid">
            <div class="logo">
			<?php $fields = get_fields('option'); //print_R($fields); ?>
                <a href="<?php echo site_url(); ?>"><img src="<?php echo $fields['website_logo']['url']; ?>" alt="<?php echo $fields['website_logo']['title']; ?>"></a>
            </div>
            
            <div class="header-right-menu">
                <!--<ul>
                    <li><a href="#"><svg  id="notificationBell" x="0px" y="0px" viewBox="0 0 100 125" ><g><path d="M49,91c5.3,0,9.7-3.9,10.4-9H38.6C39.3,87.1,43.7,91,49,91z"/><path d="M24.5,42.1c0,14.4-2.6,21.4-5.4,24.9h59.9c-2.8-3.4-5.4-10.4-5.4-24.9c0-15.4-9.2-21.7-16.4-24.3c0.6-1.2,0.9-2.5,0.9-3.8   c0-5-4-9-9-9s-9,4-9,9c0,1.3,0.3,2.6,0.9,3.8C33.7,20.4,24.5,26.7,24.5,42.1z M49,9c2.8,0,5,2.2,5,5c0,0.8-0.2,1.6-0.5,2.3l1.8,0.9   c-0.1,0-0.2-0.1-0.4-0.1c-4.8-1.5-9.3-0.6-11-0.2l0.8-0.4C44.2,15.7,44,14.9,44,14C44,11.2,46.2,9,49,9z"/><path d="M14.6,73.5c0,3,2.5,5.5,5.5,5.5h28.7h0.5h28.7c3.1,0,5.5-2.5,5.5-5.5c0-0.9-0.2-1.7-0.6-2.5H15.2   C14.8,71.8,14.6,72.6,14.6,73.5z"/></g></svg>
                            <span>3</span>
                        </a></li>
                    <li><!--<form>
                            <input type="text" placeholder="Search">
                            <input type="submit" class="search-btn">
                        
                        </form></li>
                </ul>-->
            </div>
            
        </div>
    </header>
    
    <aside>
        <div class="profile-area">
            <div>
                <figure style="background-image:url('<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>');"></figure>
                
                <h3><?php echo $user->display_name; ?></small></h3>
                
            </div>
        </div>
        
        <div class="menu-area">
            <ul>
			
			<?php if( $current_user->roles[0] == 'reseller' ): ?>
			
                <li><a href="<?php echo site_url('/market-material/'); ?>"> <svg id="mmIcon" viewBox="0 0 100 125" x="0px" y="0px"><path d="M67.36,30.34a3.16,3.16,0,0,1,.17-4.47l9.33-8.64a3.17,3.17,0,0,1,4.3,4.64l-9.33,8.64A3.17,3.17,0,0,1,67.36,30.34ZM68.26,7A3.12,3.12,0,0,0,63.9,8.39L58.29,20.16a3.12,3.12,0,1,0,5.64,2.69l5.62-11.77A3.12,3.12,0,0,0,68.26,7Zm22.42,24.2a3.12,3.12,0,0,0-4-1.59L74.56,34.33a3.12,3.12,0,0,0,2.26,5.82L89,35.44A3.12,3.12,0,0,0,90.68,31.21ZM17.74,92.5a3.36,3.36,0,0,0,.18-4.75l-1.16-1.25,10.6-4.61,3.06,3.31a14.18,14.18,0,0,0,17.78,2.45,8.17,8.17,0,0,1-.15-.91,8.26,8.26,0,0,1,0-1.51,8.16,8.16,0,0,1-2.53-3.92,7.43,7.43,0,0,1-10.16-.68L33.9,79l9-3.93a8.16,8.16,0,0,1-.54-2.21,8.24,8.24,0,0,1,0-1.5q-.27-.24-.53-.5a8.19,8.19,0,0,1-2.33-6,8.39,8.39,0,0,1,8.4-8H60.7L59.37,47a4.55,4.55,0,0,1,0-.77,7.4,7.4,0,0,1,7-7.15L40.74,11.43A3.36,3.36,0,1,0,35.8,16l1.95,2.1-30.63,58-.75-.81a3.36,3.36,0,1,0-4.93,4.57L13,92.32A3.36,3.36,0,0,0,17.74,92.5Zm32-13.13a3.79,3.79,0,0,0,3.81,3.32h.87a3.7,3.7,0,0,0-1.85,3.59,3.78,3.78,0,0,0,3.81,3.32h1.85l22.16.26a1.16,1.16,0,0,0,1.18-1.16V66.29h0a1.19,1.19,0,0,0-.78-1.15l-2.57-.9L69.57,45.84a2.89,2.89,0,0,0-5.69.56l2,15.06h-18A3.81,3.81,0,0,0,44.08,65a3.7,3.7,0,0,0,3.7,3.82h1a3.7,3.7,0,0,0-1.85,3.59,3.79,3.79,0,0,0,3.81,3.32h.87A3.7,3.7,0,0,0,49.75,79.36ZM99.47,66.12V88a1.9,1.9,0,0,1-1.9,1.9H86.78a1.9,1.9,0,0,1-1.9-1.9V66.12a1.9,1.9,0,0,1,1.9-1.9H97.57A1.9,1.9,0,0,1,99.47,66.12ZM94.05,85a1.69,1.69,0,1,0-1.69,1.69A1.69,1.69,0,0,0,94.05,85Z"/></svg>
                    Marketing Material</a></li>
					
                
                <li><a href="<?php echo site_url('/website-access/'); ?>">
                    <svg id="waIcon" viewBox="0 0 32 40.00000125" version="1.1" x="0px" y="0px"><g transform="translate(0,-1020.3622)"><g transform="translate(-254,-842)"><path style="text-indent:0;text-transform:none;direction:ltr;block-progression:tb;baseline-shift:baseline;color:#000000;enable-background:accumulate;" d="M 3,3 29,3 29,6 3,6 z M 4.5,4 C 4.22386,4 4,4.2239 4,4.5 4,4.7761 4.22386,5 4.5,5 4.77614,5 5,4.7761 5,4.5 5,4.2239 4.77614,4 4.5,4 z m 2,0 C 6.22386,4 6,4.2238 6,4.5 6,4.7761 6.22386,5 6.5,5 6.77614,5 7,4.7761 7,4.5 7,4.2238 6.77614,4 6.5,4 z m 2,0 C 8.22384,4 8,4.2238 8,4.5 8,4.7761 8.22384,5 8.5,5 8.77616,5 9,4.7761 9,4.5 9,4.2238 8.77616,4 8.5,4 z M 3,7 29,7 29,10.28125 29,14.875 29,29 3,29 z m 16.46875,4.96875 c -0.04278,0.005 -0.08491,0.01551 -0.125,0.03125 -0.121199,0.04299 -0.224344,0.134677 -0.28125,0.25 l -7,11.96875 c -0.1309,0.229074 -0.04157,0.5566 0.1875,0.6875 0.229075,0.130899 0.5566,0.04157 0.6875,-0.1875 l 7,-11.96875 c 0.217315,-0.314083 -0.08935,-0.825195 -0.46875,-0.78125 z M 10.5,14 c -0.127615,1.8e-5 -0.245957,0.05846 -0.34375,0.15625 l -3.84375,3.875 c -0.060079,0.02444 -0.1073536,0.0761 -0.15625,0.125 -0.195515,0.195515 -0.195515,0.491985 0,0.6875 0.048879,0.04888 0.096175,0.100561 0.15625,0.125 l 3.84375,3.875 c 0.195586,0.195586 0.491985,0.195515 0.6875,0 0.195586,-0.195586 0.195586,-0.491914 0,-0.6875 L 7.1875,18.5 10.84375,14.84375 c 0.195586,-0.195586 0.195515,-0.491985 0,-0.6875 C 10.745957,14.058457 10.627615,13.999982 10.5,14 z m 11,0 c -0.127606,9e-6 -0.245992,0.05849 -0.34375,0.15625 -0.195586,0.195586 -0.195586,0.491914 0,0.6875 L 24.8125,18.5 21.15625,22.15625 c -0.195515,0.195515 -0.195515,0.491985 0,0.6875 0.195586,0.195586 0.491985,0.195515 0.6875,0 l 3.84375,-3.875 c 0.06008,-0.02445 0.107354,-0.0761 0.15625,-0.125 0.195586,-0.195586 0.195586,-0.491914 0,-0.6875 -0.04888,-0.04888 -0.09618,-0.100555 -0.15625,-0.125 l -3.84375,-3.875 C 21.745957,14.058457 21.627606,13.999991 21.5,14 z" transform="translate(254,1862.3622)"  fill-opacity="1" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></g></g></svg>
                    Website Access</a></li>
                <?php endif; ?>
                <li><a href="<?php echo site_url('/create-ticket/'); ?>">
                    <svg id="ctIcon" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><path d="M79,34v-2H21v2h2v2h-2v2h2v2h-2v3.1c3.4,0.5,6,3.4,6,6.9s-2.6,6.4-6,6.9V60h2v2h-2v2h2v2h-2v2h58v-2h-2v-2h2v-2h-2v-2h2  v-3.1c-3.4-0.5-6-3.4-6-6.9s2.6-6.4,6-6.9V40h-2v-2h2v-2h-2v-2H79z M71,59.5c0,2.5-2,4.5-4.5,4.5h-33C31,64,29,62,29,59.5v-19  c0-2.5,2-4.5,4.5-4.5h33c2.5,0,4.5,2,4.5,4.5V59.5z M70,40.5v19c0,1.9-1.6,3.5-3.5,3.5H40V37h26.5C68.4,37,70,38.6,70,40.5z   M33.5,37H39v26h-5.5c-1.9,0-3.5-1.6-3.5-3.5v-19C30,38.6,31.6,37,33.5,37z"/></svg>
                    Create Ticket</a></li>
                <?php if( $current_user->roles[0] == 'reseller' ): ?>
                <li><a href="<?php echo site_url('/create-customer/'); ?>">
                    <svg id="custIcon" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><path d="M50.8,64.3c5.3,0,10.1-2.1,13.3-5.6c-0.3-3-0.2-5.9-0.1-8.1c1.1-1.3,1.7-4.5,2.7-9.7c7.2-7.5,4-15.8,1.3-15.7  c1.4-8.3,1-16.4-8.3-15.8C60.1,3.3,31.2,0,33.4,25.3c-2.7-0.2-5.9,8.2,1.3,15.7c1.1,5.2,1.6,8.4,2.7,9.7c0.1,1.5-0.1,6.5-0.1,7.9  C40.6,62.2,45.5,64.3,50.8,64.3z"/><path d="M81.1,68.8C78.9,66,69.3,61.6,65.6,60c-2.4,2.6-5.5,4.5-9,5.5l-5.9,7.7l-5.9-7.7c-3.6-1.1-6.9-3.1-9.2-5.8  c-3.8,1.7-12.7,5.8-15.4,9.3C16.8,73.4,16,84.5,16,84.5S27.3,93.9,47.4,95c0,0,0,0,0.1,0c1.3,0.1,2.7,0.1,4.1,0.1  c1.4,0,2.8,0,4.1-0.1c0.1,0,0.2,0,0.3,0c19.8-1.2,29.4-10.5,29.4-10.5S83.8,72.3,81.1,68.8z"/></svg>
                    customers</a></li>
                
                <li><a href="<?php echo site_url('/tco-calculator/'); ?>">
                    <svg id="tcoIcon"  viewBox="0 0 325.80799 582.1261" version="1.1" x="0px" y="0px"><g transform="translate(-273.28575,-236.55318)"><path style="" d="m 529.70675,236.55318 -187.034,0 c -38.318,0 -69.387,31.0689 -69.387,69.387 l 0,326.9269 c 0,38.3182 31.069,69.387 69.387,69.387 l 187.034,0 c 38.318,0 69.387,-31.0688 69.387,-69.387 l 0,-326.9269 c 0,-38.3181 -31.069,-69.387 -69.387,-69.387 z m -148.674,400.5392 -54.516,0 0,-54.5152 54.516,0 0,54.5152 z m 0,-75.7663 -54.516,0 0,-54.5156 54.516,0 0,54.5156 z m 0,-75.7668 -54.516,0 0,-54.5152 54.516,0 0,54.5152 z m 82.435,151.5331 -54.473,0 0,-54.5152 54.473,0 0,54.5152 z m 0,-75.7663 -54.473,0 0,-54.5156 54.473,0 0,54.5156 z m 0,-75.7668 -54.473,0 0,-54.5152 54.473,0 0,54.5152 z m 82.396,151.5331 -54.517,0 0,-54.5152 54.517,0 0,54.5152 z m 0,-75.7663 -54.517,0 0,-54.5156 54.517,0 0,54.5156 z m 0,-75.7668 -54.517,0 0,-54.5152 54.517,0 0,54.5152 z m 0,-105.1781 c 0,6.2965 -5.137,11.4333 -11.434,11.4333 l -196.479,0 c -6.297,0 -11.434,-5.1368 -11.434,-11.4333 l 0,-68.5999 c 0,-6.2969 5.137,-11.392 11.434,-11.392 l 196.479,0 c 6.297,0 11.434,5.0951 11.434,11.392 l 0,68.5999 z" /></g></svg>
                    TCO calculator</a></li>
                <?php endif; ?>
               <!-- <li><a href="#">
                    <svg id="invoIcon" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" ><g><path d="M19,81C19,80.9,19,81.1,19,81L19,81z"/><path d="M81,82C81,82.1,81,81.9,81,82L81,82z"/><path d="M80.5,13c-0.4,0-1.8,0-2.1,0H21.6c-0.5,0-2.2,0-2.6,0c-3.6,0-6.5,2.9-6.5,6.5S15.4,26,19,26v55c-0.1,0.5,0.7,2.2,1.1,2.7   l4.7,6c0.4,0.5,1,0.8,1.6,0.8s1.2-0.3,1.6-0.8l3.2-4l3.2,4c0.4,0.5,1,0.8,1.6,0.8s1.2-0.3,1.6-0.8l3.2-4l3.2,4c0.8,1,2.4,1,3.1,0   l3.2-4l3.2,4c0.8,1,2.4,1,3.1,0l3.2-4l3.2,4c0.4,0.5,1,0.8,1.6,0.8c0,0,0,0,0,0c0.6,0,1.2-0.3,1.6-0.8l3.2-4l3.2,4   c0.8,1,2.4,1,3.1,0l4.7-6c0.4-0.5,1.2-1.2,1.1-1.7V26c3.4-0.3,6-3.1,6-6.5C87,15.9,84.1,13,80.5,13z M19,22c-1.4,0-2.5-1.1-2.5-2.5   S17.6,17,19,17V22z M47,65H33c-1.1,0-2-0.9-2-2s0.9-2,2-2h14c1.1,0,2,0.9,2,2S48.1,65,47,65z M67,65h-6c-1.1,0-2-0.9-2-2s0.9-2,2-2   h6c1.1,0,2,0.9,2,2S68.1,65,67,65z M67,53H33c-1.1,0-2-0.9-2-2s0.9-2,2-2h34c1.1,0,2,0.9,2,2S68.1,53,67,53z M67,41H33   c-1.1,0-2-0.9-2-2s0.9-2,2-2h34c1.1,0,2,0.9,2,2S68.1,41,67,41z M67,29H33c-1.1,0-2-0.9-2-2s0.9-2,2-2h34c1.1,0,2,0.9,2,2   S68.1,29,67,29z M81,21.9v-4.9c1.1,0.2,2,1.2,2,2.4S82.1,21.7,81,21.9z"/></g></svg>
                    Invoices</a></li>-->
                
                <li><a href="<?php echo wp_logout_url( site_url() ); ?> ">
                    <svg id="logIcon" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" ><g><path d="M88.414,51.414l-11,11c-0.782,0.782-2.046,0.782-2.828,0c-0.779-0.78-0.779-2.049,0-2.828L82.172,52H49   c-1.103,0-2-0.896-2-2c0-1.103,0.897-2,2-2h33.172l-7.586-7.586c-0.779-0.78-0.779-2.049,0-2.828c0.782-0.782,2.046-0.782,2.828,0   l11,11C89.196,49.368,89.196,50.632,88.414,51.414z M65,74H31V26h34v20h3.5V23.5c0-0.55-0.45-1-1-1h-39c-0.55,0-1,0.45-1,1v53   c0,0.55,0.45,1,1,1h39c0.55,0,1-0.45,1-1V54H65V74z M49,46h15V27H32v46h32V54H49c-2.21,0-4-1.79-4-4S46.79,46,49,46z"/></g></svg>
                    Logout</a></li>
                
            </ul>
        </div>
        
    </aside>
    