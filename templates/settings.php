<div class="wrap">
    <h2>Job Seeker Settings</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('wp_job_seeker','wp_job_seeker-group'); ?>
        <?php @do_settings_fields('wp_job_seeker','wp_job_seeker-group'); ?>

        <?php do_settings_sections('wp_job_seeker'); ?>

        <?php @submit_button(); ?>
    </form>
</div>