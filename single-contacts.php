<?php if ((isset($_POST['dt_contacts_noonce']) && wp_verify_nonce( $_POST['dt_contacts_noonce'], 'update_dt_contacts' ))) { dt_save_contact($_POST); } // Catch and save update info ?>
<?php if ( ! empty($_POST['response'] )) { dt_update_overall_status($_POST); } ?>
<?php if ( ! empty($_POST['comment_content'] )) { dt_update_required_update($_POST); } ?>

<?php get_header(); ?>

    <div id="content">

        <div id="inner-content">

            <!-- Breadcrumb Navigation-->
            <nav aria-label="You are here:" role="navigation" class="hide-for-small-only">
                <ul class="breadcrumbs">

                    <li><a href="<?php echo home_url('/'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo home_url('/'); ?>contacts/">Contacts</a></li>
                    <li>
                        <span class="show-for-sr">Current: </span> <?php the_title(); ?>
                    </li>
                </ul>
            </nav>


            <main id="main" class="large-8 medium-8 columns" role="main">

                <section id="contact-details" class="bordered-box medium-12 columns">
                    <?php get_template_part( 'parts/loop', 'single-contact' ); ?>
                </section>

                <section id="faith" class="bordered-box medium-6 columns">
                    <h1>Faith</h1>
                    <p>yah</p>
                    <p>yah</p>
                    <p>yah</p>
                    <p>yah</p>
                    <p>yah</p>
                    <p>yah</p>
                </section>

                <section id="relationships" class="bordered-box medium-6 columns">
                    <?php
                    global $wp_query, $post_id;

                    // Find connected pages (for all posts)
                    p2p_type( 'contacts_to_contacts' )->each_connected( $wp_query, array(), 'disciple' );
                    p2p_type( 'contacts_to_groups' )->each_connected( $wp_query, array(), 'groups' );
                    p2p_type( 'contacts_to_locations' )->each_connected( $wp_query, array(), 'locations' );
                    ?>

                    <section class="bordered-box">

                        <form method="get" action="<?php echo get_permalink(); ?>">
                            <span class="float-right">
                                <input type="hidden" name="action" value="edit"/>
                                <input type="submit" value="Add" class="button" />
                            </span>
                        </form>

                        <h3>Relationships</h3>

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php foreach ( $post->disciple as $post ) : setup_postdata( $post ); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                            <?php endforeach; ?>

                            <?php  wp_reset_postdata(); // set $post back to original post ?>

                        <?php endwhile; ?>

                    </section>

                    <section class="bordered-box">

                        <form method="get" action="<?php echo get_permalink(); ?>">
                        <span class="float-right">
                            <input type="hidden" name="action" value="edit"/>
                            <input type="submit" value="Add" class="button" />
                        </span>
                        </form>

                        <h3>Groups</h3>

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php foreach ( $post->groups as $post ) : setup_postdata( $post ); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </li>

                            <?php endforeach; ?>

                            <?php  wp_reset_postdata(); // set $post back to original post ?>

                        <?php endwhile; ?>


                    </section>

                    <section class="bordered-box">

                        <form method="get" action="<?php echo get_permalink(); ?>">
                            <span class="float-right">
                                <input type="hidden" name="action" value="edit"/>
                                <input type="submit" value="Add" class="button" />
                            </span>
                        </form>

                        <h3>Locations</h3>

                        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                            <?php foreach ( $post->locations as $post ) : setup_postdata( $post ); ?>

                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                            <?php endforeach; ?>

                            <?php  wp_reset_postdata(); // set $post back to original post ?>

                        <?php endwhile; ?>



                    </section>
                </section>

            </main> <!-- end #main -->

            <aside class="medium-4 columns">
                <?php get_template_part( 'parts/loop', 'activity-comment' ); ?>
            </aside>

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>