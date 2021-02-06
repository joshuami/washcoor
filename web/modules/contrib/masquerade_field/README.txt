Masquerade Field
================

This module extends Masquerade (https://www.drupal.org/project/masquerade)
by providing a user field referring other accounts that the user is able to
masquerade as.

Administrators, granted with `administer users` and `edit masquerade field`
permission, are able to edit any user profile and select target accounts that
the user being edited will be able to masquerade.

Users granted with `view own masquerade field` are able to see this field in
their account. The module provides a formatter that allows the user to
masquerade, by clicking on the target user link.
