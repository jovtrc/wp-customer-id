## WP Customer ID

A simple WordPress plugin that generates a unique customer ID for the users registered on the site.

### Table of contents

1. [Installation](#installation)
2. [Usage](#usage)

#### Installation

Download this repository as a ZIP file and add it unzipped to your `wp-content/plugins` directory.
After that, activate the plugin in the Plugins menu inside WordPress Admin.

#### Usage

There are two ways to use the WP Customer ID plugin:

1. Use the `[show_customer_id]` in any post or page to show the Customer ID. You can use the `only_id = "yes"` parameter to show only the Customer ID. Example: `[show_customer_id only_id = "yes"]`.
2. Use the `get_the_customer_id` and `the_customer_id` PHP functions to show the Customer ID on your theme or plugin.