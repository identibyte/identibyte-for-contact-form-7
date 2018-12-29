=== Identibyte for Contact Form 7 ===
Author: Identibyte
Contributors: Identibyte
Tags: Identibyte, contact form 7, cf7, spam blocker, disposable email
Requires at least: 3.0.1
Tested up to: 5.0.2
Stable tag: 1.0.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Make your forms intelligent. Detect and block signups and emails from
disposable and fake email addresses in your Contact Form 7 forms.

=== Description ===

Identibyte for Contact Forms 7 will detect and block signups and
submissions from disposable email addresses in your forms. Saving
resources for *real* users allows you to spend time and money on the
users that need it most.

Setting up is easy:

1. Install the Identibyte for Contact Form 7 plugin.
2. Enable Identibyte validation on any Contact Form 7 email tag.

You can use Identibyte for Contact Form 7 completely free without an
Identibyte account and make 20 "checks" per hour. If you need more
checks, you just need to sign up for Identibyte and create a free or
upgraded API token. Learn more below.

= How it works =

When you have Identibyte for Contact Form 7 installed and activated,
Identibyte will validate the `[email]` tags in your Contact Form 7
forms. All you need to do is add the `identibyte:true` option to any
`[email]` or `[email*]` tag.

For example, like this: `[email* your-email identibyte:true]`

When the form is submitted, Identibyte will check if the email is a
**disposable email address**. Identibyte has custom technology and
processes for discovering and keeping a highly up-to-date blacklist of
disposable email providers.

And that's it! Now your signup forms are intelligent and can detect
and block users signing up or submitting information that have a
disposable email address.

[Learn more about how Identibyte works here](https://identibyte.com).

= Adding an API token =

If you need to make more than 20 API requests an hour, you can
[sign up for an Identibyte account]((https://identibyte.com/signup)
and [create an API token](https://identibyte.com/dashboard/tokens).
Once you have a token, enter it the Identibyte plugin's admin settings
page.

After the 20 checks per hour are exhausted, if you haven't entered an
API token, Identibyte will be bypassed and will not fail the form
submission validation.

= What you need to know =

Identibyte for Contact Form 7 relies on making HTTP requests to the
[Identibyte API](https://identibyte.com). API calls are made when a
Contact Form 7 form is submitted, for every field that has the
`identibyte:true` option.

Identibyte is an external service and has it's own
[Terms of Service](https://identibyte.com/termsofservice) and
[Privacy Policy](https://identibyte.com/privacypolicy), which you can
review at those links.

= Support =

For any assistance, check out the
[Identibyte website](https://identibyte.com) and
[API documentation](https://identibyte.com/#docs) for helpful
resources, or email us
directly at admin@identibyte.com.

=== Screenshots ===

1. Prevent form submissions when users enter a disposable email address.

2. Easily enable Identibyte on any Contact Form 7 email field.

=== Installation ===

The best way to install Identibyte for Contact Form 7 is through your
Worpress Dashboard. Just search for **Identibyte** or
**Identibyte for Contact Form 7**, and click "Install".

*Note: Contact Form 7 must be installed and active for this plugin to work.*
