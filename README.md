[![SensioLabsInsight](https://insight.sensiolabs.com/projects/3ad118ec-c1b8-44e1-b92c-c51369a52bc3/mini.png)](https://insight.sensiolabs.com/projects/3ad118ec-c1b8-44e1-b92c-c51369a52bc3)

hashidsBundle
=============

## This is a bundle to use http://www.hashids.org/ as a service

## Installation

`composer require hbryan/hashids-bundle`

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

            new cayetanosoriano\HashidsBundle\cayetanosorianoHashidsBundle(),
    );
}
```

## Configuration

### Add the following to your config.yml
```yaml
cayetanosoriano_hashids:
    salt: "randomsalt" #optional
    min_hash_length: 10 #optional
    alphabet: "abcd..." #optional
```

### Then use the service
```php
$kcy = $this->get('hashids');
```

## Optional features

### Doctrine param converter

The included Doctrine param converter extends the one included in
(SensioFrameworkExtraBundle)[http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html]
to automate decoding of Hashids in routes before fetching the object.

#### Overload the default service to your services.yml

```yaml
sensio_framework_extra.converter.doctrine.orm:
    class: cayetanosoriano\HashidsBundle\Request\ParamConverter\HashidsDoctrineParamConverter
    arguments: ["@hashids", "@doctrine"]
    tags: [{ name: request.param_converter, converter: doctrine.orm }]
```

#### Specify the Hashid in your route

The following two examples are equivalent, using either the raw database `id` or
the Hashid encoded version.

##### Raw `id` (standard SensioFrameworkExtraBundle behaviour)

```php
/**
 * @Route("/user/{id}", requirements={"id"="\d+"}, name="user_view")
 */
public function viewAction(User $user)
{
…
}
```

##### Hashid

The `hashid` request parameter will be automatically recognised as an encoded
version of `id`.

```php
/**
 * @Route("/user/{hashid}", requirements={"hashid"="[A-Za-z0-9_-]+"}, name="user_view")
 */
public function viewAction(User $user)
{
…
}
```

### license
=======
### Twig extension

#### Declare the service to your services.yml
```yaml
twig.hashids_extension:
    class: cayetanosoriano\HashidsBundle\Twig\HashidsExtension
    arguments: ["@hashids"]
    public: false
    tags: [{ name: twig.extension }]
```

#### Use the extension in your Twig templates
```twig
<a href="{{ path('user_profile', {'hashid': user.id|hashid_encode}) }}">View Profile</a>
```

### License
```
Copyright (c) 2015 neoshadybeat[at]gmail.com

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
```
