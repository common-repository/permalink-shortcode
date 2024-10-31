=== Permalink Shortcode ===
Contributors: rlange
Tags: permalink, shortcode
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode that allows you to insert permalinks into your content.

== Description ==

Permalink Shortcode is a relatively simple plugin that implements a shortcode that you can use to link to existing posts and pages on your site. The shortcode also supports a number of HTML attributes (see below).

While WordPress does include a feature that allows you to link to existing content, this feature only inserts a "static" link. If you were to change the slug for that post or page, previously inserted links would no longer be valid.

The permalink shortcode can be used in two forms:

1. Standard: `<a href="[permalink wpid='123']">link text</a>`
2. Enclosing: `[permalink wpid="123"]link text[/permalink]`

(Note the single quotes used in the standard form example above. Using double quotes in this situation will not work.)

= Supported Attributes =

The following attributes are available in both the shortcode's standard form and its enclosing form:

* `wpid`: The ID number of the post or page to which you want a link.
* `query`: The part of a URL that comes after the '?' (e.g. "?foo=bar"). The '?' is optional and will be added automatically if not included.
* `fragment`: The part of the URL that comes after the '#' (e.g. "#comments"). The '#' is optional and will be added automatically if not included.

The following HTML attributes are available only in the shortcode's enclosing form:

* `accesskey`
* `charset`
* `class`
* `dir`
* `hreflang`
* `id`
* `lang`
* `media`
* `rel`
* `rev`
* `style`
* `target`
* `title`
* `type`

Things to be aware of with some of the above attributes:

* In the enclosing form, the CSS class name `permalink-shortcode` is always added to the `class` attribute, even if you don't specify any class names yourself.
* In the enclosing form, if no value is given for the `title` attribute, the post or page title will be used.

= Usage Examples =

**Simple link (standard form):**

> `<a href="[permalink wpid='123']">link text</a>`

*Result:*

> `<a href="http://www.example.com/hello-world/">link text</a>`

**Simple link (enclosing form):**

> `[permalink wpid="123"]link text[/permalink]`

*Result:*

> `<a href="http://www.example.com/hello-world/" class="permalink-shortcode" title="Hello, world!">link text</a>`

**Linking to the Comments section of a post (standard form):**

> `<a href="[permalink wpid='123']#comments">link text</a>`

> ...or...

> `<a href="[permalink wpid='123' fragment='comments']">link text</a>`

*Result:*

> `<a href="http://www.example.com/hello-world/#comments">link text</a>`

**Adding a custom CSS class and title (enclosing form):**

> `[permalink wpid="123" class="my-class" title="Some Other Page"]link text[/permalink]`

*Result:*

> `<a href="http://www.example.com/hello-world/" class="permalink-shortcode my-class" title="Some Other Page">link text</a>`

== Installation ==

1. Unzip the downloaded .zip file.
2. Upload the `permalink-shortcode` folder to your `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I find the ID of the post or page? =

The ID for a post or page can be found in just about any Edit link for that content. All you need to do is hover your mouse over the link and look at the tooltip that displays the URL (where this appears depends on the browser you're using). An example:

> `http://www.example.com/wp-admin/post.php?post=123&action=edit`

In the above example, `123` is the ID of the post. This is the number you want to use for the shortcode's `wpid` attribute, like so:

> `[permalink wpid="123"]`

== Changelog ==

= 1.0.0 =

* Initial release.
