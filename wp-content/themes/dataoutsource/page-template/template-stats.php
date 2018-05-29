<?php
/**
 * Template Name: Stats Page
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
	<p><?php the_title(); ?></p>
</div>  

<div class="status-page">
    <div class="container">
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="status-table">
            <table>
                <tr class="main-heading">
                    <td>services</td>
                    <td>status</td>
                </tr>
                
                <tr class="heading">
                    <td>Exchange Services</td>
                    <td>active/degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>active</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr class="heading">
                    <td>Internet Services</td>
                    <td>active/degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>active</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                 <tr class="heading">
                    <td>Infrastructure Services</td>
                    <td>active/degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>active</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr class="heading">
                    <td>Monitoring Services</td>
                    <td>active/degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>active</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
                <tr class="heading">
                    <td>Portals</td>
                    <td>active/degraded</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>active</td>
                </tr>
                
                <tr>
                    <td>Lorem Ipsum</td>
                    <td>degraded</td>
                </tr>
                
               
                
            </table>
        </div>
        
            </div>
        
        </div>
        
        
    </div>

</div>
 
<?php get_footer(); ?>