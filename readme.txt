=== Identibyte for Contact Form 7 ===
Author: Identibyte
Contributors: Identibyte
Tags: Identibyte, contact form 7, cf7, spam blocker, disposable email
Requires at least: 3.0.1
Tested up to: 4.9.7
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Make your forms intelligent. Detect and block signups and emails from
disposable and fake email addresses in your Contact Form 7 forms.

=== Description ===

Identibyte for Contact Forms 7 will detect and block signups and
submissions from disposable email addresses in your forms. Saving
resources for your *real* users allows you to spend time and money on
the users that need it.

Setting it up is easy:

1. Install the Identibyte for Contact Form 7 plugin
2. Enter your Identibyte token ([from your dashboard](https://identibyte.com/dashboard)).
3. Enable Identibyte validation on any Contact Form 7 email tag.


= How it works =

When you have Identibyte for Contact Form 7 installed and activated,
Identibyte will validate the `[email]` tags in your Contact Form 7
forms. All you need to do is add the `identibyte:true` option to any
`[email]` or `[email*]` tag.

For example, like this: `[email* your-email identibyte:true]`

When the form is submitted, Identibyte will check if the email is a
**disposable email address**. A disposable email address is an email
that matches an entry in Identibyte's blacklist.

And that's it! Now your signup forms are intelligent and can detect
and block users signing up or submitting information that have a
disposable email address.

=== Screenshots ===

1. Prevent form submissions when users enter a disposable email address.

2. Easily enable Identibyte on any Contact Form 7 email field.

=== Installation ===

The best way to install Identibyte for Contact Form 7 is through your
Worpress Dashboard. Just search for **Identibyte** or
**Identibyte for Contact Form 7**, and click "Install".

*Note: Contact Form 7 must be installed and active for this plugin to work.*
