# TwigModifyBundle

TwigModify is a twig tag that can modifies everythink you want eg. `cssmin`, `jsmin` and more.


## Installing

Installing via `composer` is
recommended.

```yaml
"require": {
  "phpmob/twig-modify-bundle": "~1.0"
}
```

## Enabling

And then enable bundle in `AppKernel.php`

```php
public function registerBundles()
{
    $bundles = [
        ...
        new \PhpMob\TwigModifyBundle\PhpMobTwigModifyBundle(),
    ];
}
```

## Usage

In order to modify your twig is simple just wrap `{% modify modifier %}...{% modify %}` like this:

```twig
{% modify jsmin %}
    <script type="text/javascript">
        $(function() {
                ....
        });
    </script>
{% endmodify %}
```

That was it!

## Build-in Modifiers
There are supported modifiers in this bundle.

#### JSMin
A wrapped modifier for `\JShrink\Minifier::minify`, Thanks [tedivm/jshrink](https://github.com/tedious/JShrink)
```twig
{% modify jsmin %}
    <script type="text/javascript">
        $(function() {
                ....
        });
    </script>
{% endmodify %}
```

#### CSSMin
A wrapped modifier for `\tubalmartin\CssMin\Minifier::minify`, Thanks [tubalmartin/cssmin](https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port)
```twig
{% modify cssmin %}
    <style type="text/css">
        body {
            color: red;
        }
    </style>
{% endmodify %}
```

#### HtmlPurify
A wrapped modifier for `\HTMLPurifier::purify`, Thanks [ezyang/htmlpurifier](https://github.com/ezyang/htmlpurifier)
```twig
{% modify htmlpurify %}
    <SCRIPT »
    SRC=http://ha.ckers.org/xss. »
    js></SCRIPT>
{% endmodify %}
```

## Cache
TwigModifyBundle use local cache folder by default, however you can use any cache that implemented `\Doctrine\Common\Cache\Cache` interface and then change the confiuration for your cache servie:

```yaml
phpmob_twig_modify:
    cache: "my_cache_service_id"
```

You can also use doctrine cache.
```yaml

doctrine_cache:
    providers:
        modifier_cache:
            type: file_system

phpmob_twig_modify:
    cache: "doctrine_cache.providers.modifier_cache"
```

Don't fogot enable `DoctrineCacheBundle` in your `AppKernel.php` - See https://symfony.com/doc/current/bundles/DoctrineCacheBundle/index.html

## Your own modifiers
You can add/override modifiers by easy configuration:

```yaml
phpmob_twig_modify:
    modifiers:
        xss: # a modifier name
            enabled: true # default true, toggle enable/disable this modifier.
            class: \PhpMob\TwigModifyBundle\Modifier\HTMLPurify # static class or any service
            method: purify # service method that's allowed to accept `[$content, (array) $options]
            options: # are array options you want to past into your modifier method - `\PhpMob\TwigModifyBundle\Modifier\HTMLPurify::purify` in this case.
                Cache.SerializerPath: "%kernel.cache_dir%/htmlpurify"
```

After that you already to use your new modifier.
```twig
 {% modify xss %}
     <SCRIPT »
     SRC=http://ha.ckers.org/xss. »
     js></SCRIPT>
 {% endmodify %}
 ```

## Configuration
TwigModifyBundle use local cache folder by default, however you can use any cache that implemented `\Doctrine\Common\Cache\Cache` interface and then change the confiuration for your cache servie:

```yaml
phpmob_twig_modify:
    # cache serivce implemented `\Doctrine\Common\Cache\Cache` interface.
    cache: "my_cache_service_id"
    # application wide toggle enable/disable all modifiers
    enabled: true
    # custom/override modifiers (same key of modifier will override other previous defined)
    modifiers:
        name:
            class: ModifierClassOrService
            method: ModifierMethod
            options: ArrayOfSecondModifierMethod
            enabled: ToggleDisableEnable
```

## Thanks
    - https://github.com/nibsirahsieu/SalvaJshrinkBundle to nice demonstration.
    - https://github.com/Exercise/HTMLPurifierBundle to nice demonstration.
    - https://github.com/ezyang/htmlpurifier
    - https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port
    - https://github.com/tedious/JShrink

## License

[MIT](/LICENSE)
