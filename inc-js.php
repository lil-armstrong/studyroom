<!--All scripts-->
<script type='text/javascript' src='includes/js/jquery/jqueryb8ff.js'></script>
<script type='text/javascript' src='includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<?php

if ($session) {

    ?>
    <script>
        window.onload = function () {


            /*Selects all element for timing*/
            items = document.querySelectorAll('[id*="cntdown"]');

//                                                console.log(items.length);
            for (i = 0; i < items.length; i++) {
                expires = items.item(i).innerHTML;
//                console.log(items.length);
                countDown(items.item(i).id, expires);
            }


            function countDown(id, expires) {
                // Set the date we're counting down to
                var countDownDate = new Date(expires).getTime();

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now an the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="countdown"
                    document.getElementById(id).innerHTML = ftime(days) + " day(s) left | " + ftime(hours) + ":"
                        + ftime(minutes) + ":" + ftime(seconds);

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(id).innerHTML = "EXPIRED";
                    }
                }, 1000);
            }


        };

        function ftime(str, num=10) {
            str = parseInt(str);
            return ((str < num) ? '0' : '') + str;
        }

        //                                                            automatically numbers the tables
        /*Select table*/
        if (table = document.getElementById('stats')) {
            /*Select the table body element*/
            body = table.querySelector('tbody');
            //                                                            Get table rows
            rows = body.querySelectorAll('tr');
            /*Number automatically*/

            for (i = 0; i < rows.length; i++) {
                col = rows.item(i).childNodes.item(1);
                col.innerHTML = i + 1;
//                                                    console.log(col);
            }
        }
//        if (toggles = document.querySelectorAll('[class*="toggler"]')) {
//            console.log(toggles.item.length);
//            for (i = 0; i < toggles.item.length; ++i) {
//                toggles.item(i).addEventListener('click', function (e) {
//                    this.childNodes.item(1).classList.toggle('fa-minus-circle');
//                    console.log(this);
//                });
//            }
//        }

    </script>
    <?php
}
?>


<noscript>
    <style type="text/css">
        .wpb_animate_when_almost_visible {
            opacity: 1;
        }
    </style>
</noscript>

<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt=""
             src="http://googleads.g.doubleclick.net/pagead/viewthroughconversion/970001310/?value=1.00&amp;currency_code=UAH&amp;label=UEhNCPTiuFoQnpfEzgM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>
<script>
    (function (body) {
        'use strict';
        body.className = body.className.replace(/\btribe-no-js\b/, 'tribe-js');
    })(document.body);
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        THEMEREX_GLOBALS["strings"] = {
            bookmark_add: "Add the bookmark",
            bookmark_added: "Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'",
            bookmark_del: "Delete this bookmark",
            bookmark_title: "Enter bookmark title",
            bookmark_exists: "Current page already exists in the bookmarks list",
            search_error: "Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.",
            email_confirm: "On the e-mail address <b>%s</b> we sent a confirmation email.<br>Please, open it and click on the link.",
            reviews_vote: "Thanks for your vote! New average rating is:",
            reviews_error: "Error saving your vote! Please, try again later.",
            error_like: "Error saving your like! Please, try again later.",
            error_global: "Global error text",
            name_empty: "The name can\'t be empty",
            name_long: "Too long name",
            email_empty: "Too short (or empty) email address",
            email_long: "Too long email address",
            email_not_valid: "Invalid email address",
            subject_empty: "The subject can\'t be empty",
            subject_long: "Too long subject",
            text_empty: "The message text can\'t be empty",
            text_long: "Too long message text",
            send_complete: "Send message complete!",
            send_error: "Transmit failed!",
            login_empty: "The Login field can\'t be empty",
            login_long: "Too long login field",
            login_success: "Login success! The page will be reloaded in 3 sec.",
            login_failed: "Login failed!",
            password_empty: "The password can\'t be empty and shorter then 4 characters",
            password_long: "Too long password",
            password_not_equal: "The passwords in both fields are not equal",
            registration_success: "Registration success! Please log in!",
            registration_failed: "Registration failed!",
            geocode_error: "Geocode was not successful for the following reason:",
            googlemap_not_avail: "Google map API not available!",
            editor_save_success: "Post content saved!",
            editor_save_error: "Error saving post data!",
            editor_delete_post: "You really want to delete the current post?",
            editor_delete_post_header: "Delete post",
            editor_delete_success: "Post deleted!",
            editor_delete_error: "Error deleting post!",
            editor_caption_cancel: "Cancel",
            editor_caption_close: "Close"
        };
    });</script>
<script type="text/javascript">jQuery(document).ready(function () {
        THEMEREX_GLOBALS['ajax_url'] = 'wp-admin/admin-ajax.html';
        THEMEREX_GLOBALS['ajax_nonce'] = 'b13664516e';
        THEMEREX_GLOBALS['ajax_nonce_editor'] = 'cac5b25383';
        THEMEREX_GLOBALS['ajax_login'] = true;
        THEMEREX_GLOBALS['site_url'] = 'index.html';
        THEMEREX_GLOBALS['site_protocol'] = 'http';
        THEMEREX_GLOBALS['vc_edit_mode'] = false;
        THEMEREX_GLOBALS['theme_font'] = '';
        THEMEREX_GLOBALS['theme_skin'] = 'education';
        THEMEREX_GLOBALS['theme_skin_bg'] = '';
        THEMEREX_GLOBALS['slider_height'] = 630;
        THEMEREX_GLOBALS['system_message'] = {message: '', status: '', header: ''};
        THEMEREX_GLOBALS['user_logged_in'] = false;
        THEMEREX_GLOBALS['toc_menu'] = 'fixed';
        THEMEREX_GLOBALS['toc_menu_home'] = false;
        THEMEREX_GLOBALS['toc_menu_top'] = false;
        THEMEREX_GLOBALS['menu_fixed'] = true;
        THEMEREX_GLOBALS['menu_relayout'] = 960;
        THEMEREX_GLOBALS['menu_responsive'] = 800;
        THEMEREX_GLOBALS['menu_slider'] = true;
        THEMEREX_GLOBALS['demo_time'] = 0;
        THEMEREX_GLOBALS['media_elements_enabled'] = true;
        THEMEREX_GLOBALS['ajax_search_enabled'] = true;
        THEMEREX_GLOBALS['ajax_search_min_length'] = 3;
        THEMEREX_GLOBALS['ajax_search_delay'] = 200;
        THEMEREX_GLOBALS['css_animation'] = true;
        THEMEREX_GLOBALS['menu_animation_in'] = 'bounceIn';
        THEMEREX_GLOBALS['menu_animation_out'] = 'fadeOut';
        THEMEREX_GLOBALS['popup_engine'] = 'pretty';
        THEMEREX_GLOBALS['popup_gallery'] = true;
        THEMEREX_GLOBALS['email_mask'] = '^([a-zA-Z0-9_\-]+\.)*[a-zA-Z0-9_\-]+@[a-z0-9_\-]+(\.[a-z0-9_\-]+)*\.[a-z]{2,6}$';
        THEMEREX_GLOBALS['contacts_maxlength'] = 1000;
        THEMEREX_GLOBALS['comments_maxlength'] = 1000;
        THEMEREX_GLOBALS['remember_visitors_settings'] = false;
        THEMEREX_GLOBALS['admin_mode'] = false;
        THEMEREX_GLOBALS['isotope_resize_delta'] = 0.3;
        THEMEREX_GLOBALS['error_message_box'] = null;
        THEMEREX_GLOBALS['viewmore_busy'] = false;
        THEMEREX_GLOBALS['video_resize_inited'] = false;
        THEMEREX_GLOBALS['top_panel_height'] = 0;
    });</script>
<!--<script type="text/javascript">jQuery(document).ready(function () {-->
<!--        if (THEMEREX_GLOBALS['theme_font'] == '') THEMEREX_GLOBALS['theme_font'] = 'Roboto';-->
<!--        THEMEREX_GLOBALS['link_color'] = '#1eaace';-->
<!--        THEMEREX_GLOBALS['menu_color'] = '#1dbb90';-->
<!--        THEMEREX_GLOBALS['user_color'] = '#ffb20e';-->
<!--    });</script>-->
<script type='text/javascript'> /* <![CDATA[ */
    var tribe_l10n_datatables = {
        "aria": {
            "sort_ascending": ": activate to sort column ascending",
            "sort_descending": ": activate to sort column descending"
        },
        "length_menu": "Show _MENU_ entries",
        "empty_table": "No data available in table",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "info_empty": "Showing 0 to 0 of 0 entries",
        "info_filtered": "(filtered from _MAX_ total entries)",
        "zero_records": "No matching records found",
        "search": "Search:",
        "all_selected_text": "All items on this page were selected. ",
        "select_all_link": "Select all pages",
        "clear_selection": "Clear Selection.",
        "pagination": {"all": "All", "next": "Next", "previous": "Previous"},
        "select": {"rows": {"0": "", "_": ": Selected %d rows", "1": ": Selected 1 row"}},
        "datepicker": {
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "nextText": "Next",
            "prevText": "Prev",
            "currentText": "Today",
            "closeText": "Done"
        }
    };
    /* ]]> */ </script>

<script type='text/javascript' src='assets/fw/js/superfish.min.js'></script>
<script type='text/javascript' src='assets/fw/js/core.utils.js'></script>
<script type='text/javascript' src='assets/fw/js/core.init.js'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var mejsL10n = {
        "language": "en-US",
        "strings": {
            "Close": "Close",
            "Fullscreen": "Fullscreen",
            "Turn off Fullscreen": "Turn off Fullscreen",
            "Go Fullscreen": "Go Fullscreen",
            "Download File": "Download File",
            "Download Video": "Download Video",
            "Play": "Play",
            "Pause": "Pause",
            "Captions\/Subtitles": "Captions\/Subtitles",
            "None": "None",
            "Time Slider": "Time Slider",
            "Skip back %1 seconds": "Skip back %1 seconds",
            "Video Player": "Video Player",
            "Audio Player": "Audio Player",
            "Volume Slider": "Volume Slider",
            "Mute Toggle": "Mute Toggle",
            "Unmute": "Unmute",
            "Mute": "Mute",
            "Use Up\/Down Arrow keys to increase or decrease volume.": "Use Up\/Down Arrow keys to increase or decrease volume.",
            "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.": "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds."
        }
    };
    var _wpmejsSettings = {"pluginPath": "\/includes\/js\/mediaelement\/"};
    /* ]]> */
</script>
<script type='text/javascript' src='includes/js/mediaelement/mediaelement-and-player.min51cd.js?ver=2.22.0'></script>
<script type='text/javascript' src='includes/js/mediaelement/wp-mediaelement.min4a41.js?ver=4.8.2'></script>
<script type='text/javascript' src='assets/fw/shortcodes/shortcodes.min.js'></script>
<script type='text/javascript'
        src='assets/plugins/sfwd-lms/templates/learndash_template_script4a41.js?ver=4.8.2'></script>
<script type='text/javascript' src='assets/fw/js/hover/jquery.hoverdir.min.js'></script>
<script type='text/javascript' src='assets/fw/js/swiper/idangerous.swiper-2.7.min.js'></script>
<script type='text/javascript' src='assets/fw/js/swiper/idangerous.swiper.scrollbar-2.4.min.js'></script>
