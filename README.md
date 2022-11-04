# Inner Circle (a [Pitchfork](https://github.com/asuengineering/pitchfork) child theme)

**Find us online at [https://innercircle.engineering.asu.edu](https://innercircle.engineering.asu.edu)**

The Inner Circle child theme for ASU Engineering is our web solution to provide community-driven events information to the engineering students at-large.

It contains features and documentation allowing end users the ability to provide a complete landing page for their event or post as well as a unique mechanism to integrate that information into the central Inner Circle calendar. 

All submissions to Inner Circle are currated by members of the ASU MarComm team. Without their tireless efforts, this site wouldn't be possible.

This plugin adds blocks and block patterns for the new block editor. Designs are consistent with the ASU Unity Design system for web standards. 

<hr>

### Contributors ### 

- Steve Ryan (ASU Engineering)

<hr>

### Developers ### 

- TODO

<hr>

### Release Notes

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