# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

#### Version 1.5.1

- FIX: Adjusted markup and styles for category hero disply in `templates-global/category-header`. Addresses broken layout and missing overlay layer due to changes in the expected markup from the Unity project.

#### Version 1.5

This release coincides with the actual relaunch of the website at [https://innercircle.engineering.asu.edu](https://innercircle.engineering.asu.edu)

- Removed image formats from the attached flyer metabox.
- Child theme now includes a less generic default image for the **post-column** and **post-group** blocks.
- Posts with four or more calendar cards will now have the cards display in a separate section below the post content. This prevents the need for super long sidebar columns.

#### Version 1.4.1

- Minor UI adjustments to location and attached flyer ACF fields in the post editor.
- Added display of location fields in event cards within `calendar.php`
- Locations now display with a link pointing to their entry on maps.asu.edu

#### Version 1.4

- Incorporates new design for single.php title area.
- Moves featured image selection back into the body of the post.

#### Version 1.3

- Adjustments to block styles for better presentation on constructed pages (like the home page.)
- Introduction of error handling proceedures due to lack of availability of ACF form validation within the block editor. Resolves several scenarios in which fatal errors could be produced on single.php and calendar.php pages.

#### Version 1.2

- Converted theme to work with Pitchfork as the parent theme as opposed to UDS-WordPress. Better for page creation, better integration with Pitchfork Docs.

#### Version 1.1

- Stable version released to Pantheon, pre-production, for testing.
