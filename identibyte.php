<?php
/*
Plugin Name: Identibyte for Contact Form 7
Plugin URI: https://identibyte.com/wordpress-plugin
Description: Detect and block disposable email addresses in your Contact 7 Forms.
Author: Identibyte
Author URI: https://identibyte.com
Version: 1.0.0
*/

/* Ensure Contact Form 7 is installed and activated. */
add_action('admin_init', 'cf7_identibyte_validate_install');
function cf7_identibyte_validate_install() {
    if (is_admin() &&
        current_user_can('activate_plugins') &&
        !is_plugin_active('contact-form-7/wp-contact-form-7.php')) {

        add_action('admin_notices', 'cf7_identibyte_validate_install_no_cf7');
        deactivate_plugins(plugin_basename(__FILE__));

        if (isset($_GET['active'])) {
            unset($_GET['active']);
        }
    }
}

function cf7_identibyte_validate_install_no_cf7() {
?>
    <div class="error">
        <p>
            Contact form 7 must be installed and active for Identibyte to work.
            <a href="<?php admin_url('plugin-install.php?tab=search&s=contact+form+7')?>">
                Install here
            </a>
        </p>
    </div>
<?php
}


/* Validate cf7 email and email* fields with Identibyte */
add_filter('wpcf7_validate_email*', 'cf7_identibyte_validate_email_filter', 20, 2);
add_filter('wpcf7_validate_email', 'cf7_identibyte_validate_email_filter', 20, 2);

/**
 * Validation for email, email*, url, and url* tags.  A check to
 * Identibyte is made if the tag has the option: `identibyte:true`. If
 * the email or URL is disposable, the form validation fails.
 */
function cf7_identibyte_validate_email_filter($result, $tag) {

    $should_validate = in_array("identibyte:true", $tag->options);

    if($should_validate) {
        $value_ = $_POST[$tag->name];
        $value = trim($value_);

        $check = cf7_identibyte_make_check($value);
        $disposable = $check->email->disposable;

        if($disposable === true) {
            $result->invalidate($tag, "Please check your email address and try again.");
        }
    }

    return $result;
}


/**
 * Make a check to the Identibyte API.  Return the full response.
 */
function cf7_identibyte_make_check($data) {
    $ua = cf7_identibyte_user_agent();
    $token = get_option("cf7_identibyte_token", "");
    $api_token = !empty($token) ? "?api_token={$token}" : "";

    $options = array("http" => array(
        "method" => "GET",
        "header" => "User-Agent: " . $ua
    ));
    $context = stream_context_create($options);

    $url = "https://identibyte.com/check/" . $data . $api_token;
    $request = file_get_contents($url, false, $context);
    $response = json_decode($request);

    return $response;
}

function cf7_identibyte_user_agent() {
    $plugin_version = "1.0.0";
    $blog_name = get_bloginfo('name');
    $blog_url = get_bloginfo('url');
    $user_agent = "cf7-identibyte/{$plugin_version} ({$blog_name} {$blog_url})";

    return $user_agent;
}

/* Register admin page and settings */
if (is_admin()) {
    add_action('admin_init', 'cf7_identibyte_register_admin_settings');
    add_action('admin_menu', 'cf7_identibyte_add_to_admin_menu');
}

function cf7_identibyte_register_admin_settings() {
    register_setting("cf7_identibyte_settings", "cf7_identibyte_token");
}

function cf7_identibyte_add_to_admin_menu() {
    add_options_page(
        'Identibyte Settings',
        'Identibyte',
        'manage_options',
        'identibyte.php',
        'cf7_identibyte_render_admin_page'
    );
}

function cf7_identibyte_render_admin_page() {
?>
    <div class="wrap">
        <div class="message"></div>
        <br/>
        <h1>
            <img
                src="https://identibyte.com/static/img/logo-120x120.png"
                width="35"
                title="Identibyte logo"
                alt="Identibyte logo"
                style="vertical-align:middle;margin-right:10px"
            />
            Identibyte for Contact Form 7 &middot Admin settings
        </h1>
        <br/>
        <div style="padding-left:50px">
            <a href="https://identibyte.com" target="_blank">Website</a>
            &middot
            <a href="https://identibyte.com" target="_blank">Developer API</a>
            &middot
            <a href="https://identibyte.com" target="_blank">Plans</a>
        </div>
        <hr/>
        <div>
            <form method="post" action="options.php">
                <?php settings_fields( 'cf7_identibyte_settings'); ?>
                <h2>Account Credentials</h2>
                <p>
                    You can use Identibyte for free without an API
                    token. Entering an API token <br/> allows you to
                    use Identibyte more often. You can get an API
                    token in your
                    <a href="https://identibyte.com/dashboard" target="_blank">
                        your <br/> dashboard
                    </a>.
                    Learn more about what free and paid options are
                    available
                    <a href="https://identibyte.com/signup" target="_blank">
                        here
                    </a>.
                </p>
                <div>
                    <label for="cf7_identibyte_token">
                        <strong>Your User-Agent: </strong>
                    </label>
                    <br/>
                    <p>
                        <code>
                            <?php echo cf7_identibyte_user_agent(); ?>
                        </code>
                    </p>
                </div>
                <div>
                    <label for="cf7_identibyte_token">
                        <strong>API token: </strong>
                    </label>
                    <br/>
                    <input
                        value="<?php echo get_option("cf7_identibyte_token") ?>"
                        type="text"
                        name="cf7_identibyte_token"
                    />
                </div>
                <?php submit_button(); ?>
            </form>
        </div>
    </div>
<?php
}
