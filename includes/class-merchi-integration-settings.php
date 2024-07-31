<?php
class MerchiSettings {

    public function __construct() {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_init', [$this, 'registerSettings']);
    }

    public function addAdminMenu() {
        add_menu_page(
            'Merchi Settings',
            'Merchi',
            'manage_options',
            'merchi-settings',
            [$this, 'settingsPageHtml'],
            '',
            20
        );
    }

	public static function get($key) {
        return get_option($key);
    }

    public function registerSettings() {
        $settings = [
            ['merchi_url', 'Merchi URL'],
            ['merchi_api_secret', 'Merchi API Secret'],
            ['staging_merchi_url', 'Staging Merchi URL'],
            ['staging_merchi_api_secret', 'Staging Merchi API Secret'],
            ['merchi_staging_mode', 'Merchi Staging Mode'],
        ];

        foreach ($settings as $setting) {
            register_setting('merchi_options_group', $setting[0], [$this, 'sanitizeInput']);
            add_settings_field(
                $setting[0],
                $setting[1],
                [$this, $setting[0] . 'FieldHtml'],
                'merchi-settings',
                'merchi_general_settings',
                ['label_for' => $setting[0]]
            );
        }

        add_settings_section(
            'merchi_general_settings',
            'General Settings',
            [$this, 'sectionDescription'],
            'merchi-settings'
        );
    }

    public function sectionDescription() {
        echo '<p>Enter your settings below:</p>';
    }

    public function sanitizeInput($input) {
        return sanitize_text_field($input);
    }

    public function merchi_urlFieldHtml() {
        $value = get_option('merchi_url');
        echo '<input type="text" id="merchi_url" name="merchi_url" value="' . esc_attr($value) . '" />';
    }

    public function merchi_api_secretFieldHtml() {
        $value = get_option('merchi_api_secret');
        echo '<input type="text" id="merchi_api_secret" name="merchi_api_secret" value="' . esc_attr($value) . '" />';
    }

    public function staging_merchi_urlFieldHtml() {
        $value = get_option('staging_merchi_url');
        echo '<input type="text" id="staging_merchi_url" name="staging_merchi_url" value="' . esc_attr($value) . '" />';
    }

    public function staging_merchi_api_secretFieldHtml() {
        $value = get_option('staging_merchi_api_secret');
        echo '<input type="text" id="staging_merchi_api_secret" name="staging_merchi_api_secret" value="' . esc_attr($value) . '" />';
    }

    public function merchi_staging_modeFieldHtml() {
        $value = get_option('merchi_staging_mode');
        $checked = checked(1, $value, false);
        echo '<input type="checkbox" id="merchi_staging_mode" name="merchi_staging_mode" value="1"' . $checked . '/>';
    }

    public function merchi_api_session_tokenFieldHtml() {
        $value = get_option('merchi_api_session_token');
        echo '<input type="text" id="merchi_api_session_token" name="merchi_api_session_token" value="' . esc_attr($value) . '" />';
    }

    public function settingsPageHtml() {
        ?>
        <div class="wrap">
            <h1>Merchi Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('merchi_options_group');
                do_settings_sections('merchi-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

// Instantiate the settings class
new MerchiSettings();