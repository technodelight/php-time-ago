# What is TimeAgo?

  TimeAgo is a tiny and dynamic library, which has the ability of displaying `DateTime` objects as a neat "ago" string.

```
  0 <-> 29 secs                                                             # => less than a minute
  30 secs <-> 1 min, 29 secs                                                # => 1 minute
  1 min, 30 secs <-> 44 mins, 29 secs                                       # => [2..44] minutes
  44 mins, 30 secs <-> 89 mins, 29 secs                                     # => about 1 hour
  89 mins, 29 secs <-> 23 hrs, 59 mins, 29 secs                             # => about [2..24] hours
  23 hrs, 59 mins, 29 secs <-> 47 hrs, 59 mins, 29 secs                     # => 1 day
  47 hrs, 59 mins, 29 secs <-> 29 days, 23 hrs, 59 mins, 29 secs            # => [2..29] days
  29 days, 23 hrs, 59 mins, 30 secs <-> 59 days, 23 hrs, 59 mins, 29 secs   # => about 1 month
  59 days, 23 hrs, 59 mins, 30 secs <-> 1 yr minus 1 sec                    # => [2..12] months
  1 yr <-> 2 yrs minus 1 secs                                               # => about 1 year
  2 yrs <-> max time or date                                                # => over [2..X] years
```

  Above example is using the default `RuleSet`, but you can define your own when you want:

```
$ruleSet = new Technodelight\TimeAgo\Translation\RuleSet;
$ruleSet->add(
  new Rule(
    'aboutOneDay', // rule name, which would be used as a translation key
    '23hour' // timespan, as a limit, without spaces between numerics and time. Check DefaultRuleSet for examples
  ),
  new Formatter(
    'day', // duration type, according to durations in \Technodelight\TimeAgo\Translation\SecondsDurationMap
    'floor' // strategy (function) to use for calculating the amount. In this example "days" are calculated with floor()
  )
);
$timeAgo = new Technodelight\TimeAgo(
    new DateTime('-1 hour'),
    new Technodelight\TimeAgo\Translator(
        new Technodelight\TimeAgo\Translation( // this only needs an array as an input
            [
                'aboutOneDay' => 'About one day'
            ]
        ),
        $ruleSet
    )
);

$timeAgo->inWords(); // => About one day
```

The example below shows how customisable is TimeAgo:

```
// with all dependencies injected:
$translationLoader = new Technodelight\TimeAgo\TranslationLoader; // can load built-in translations
$timeAgo = new Technodelight\TimeAgo(
    new DateTime('-1 hour'), // static datetime
    new Technodelight\TimeAgo\Translator(
        $translationLoader->load('hu') // use a fixed translation
    )
);

// or simply:
$timeAgo = Technodelight\TimeAgo::withTranslation(new \DateTime('-1 hour'), 'hu');

$timeAgo->inWords(); // => körülbelül 1 órája

```
  In the above example you can pass any of the translations supplied with this repository. All credits goes to Jimmi Westerberg and to the contributors of his repository.

  By default, the `TimeAgo` uses the current system language as a guide to determine the required translation file, and it defaults to english if this information was not successfully resolved.
  Of course, you can pass your own translation when required:

```
$timeAgo = new Technodelight\TimeAgo(
    new DateTime('-1 hour'),
    new Technodelight\TimeAgo\Translator(
        ['aboutOneHour' => 'Happened an hour ago! Arrr! Arrr!']
    )
);

$timeAgo->inWords(); // => Happened an hour ago! Arrr! Arrr!
```

# Credits

  This repository is inspired by the original work made by Jimmi Westerberg (http://westsworld.dk), his repository could be found at https://github.com/jimmiw/php-time-ago .

# License

The MIT License (MIT)

Copyright (c) 2018 Zsolt Gál

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

# Original License

The MIT License

Copyright © 2014 Jimmi Westerberg (http://westsworld.dk)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the “Software”), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
